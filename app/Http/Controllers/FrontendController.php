<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class FrontendController extends Controller
{
    public function index() {
        return view('customer.index');
    }

    public function about() {
        return view('customer.about');
    }

    public function blog() {
        return view('customer.blog');
    }

    public function contact() {
        return view('customer.contact');
    }

    public function favorite() {
        $data['menu'] = Product::all();

        return view('customer.favorite', $data);
    }

    public function menu() {
        $data['menu'] = Product::all();

        return view('customer.menu', $data);
    }

    public function menuDetail($id) {
        $data['item'] = Product::find($id);

        return view('customer.menuDetail', $data);
    }

    public function cart(Request $request) {
        $data['total'] = 0;
        $data['cart']  = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('id','DESC')->get();
        foreach ($data['cart'] as $item){
            $data['total'] += $item->product->price*$item->qty;
        }

        return view('customer.cart', $data);
    }

    public function post_cart(Request $request) {
        $data     = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $new      = false;
        if (!$data){
            $data = new Cart();
            $new  = true;
        }

        $qty = $request->qty <= 1 ? 1 : $request->qty;

        if ($new) {
            $data->qty         = $qty;
            $data->customer_id = Auth::user()->id;
        }else{
            $data->qty = $data->qty + $qty;
        }

        $data->product_id  = $request->product_id;
        $data->save();

        return redirect()->back();
    }

    public function plus_cart(Request $request)
    {
        $data       = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        $data->qty  = $data->qty + 1;
        $data->save();

        return redirect()->back();
    }

    public function minus_cart(Request $request)
    {
        $data       = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        if ($data->qty > 0) {
            $data->qty  = $data->qty - 1;
            $data->save();
        } else {
            $data->delete();
        }

        return redirect()->back();
    }

    public function delete_cart(Request $request)
    {
        $data = Cart::where('customer_id', Auth::user()->id)->where('id', $request->id)->first();
        $data->delete();

        return redirect()->back();
    }

    public function checkout($id) {
        $data['total']  = 0;
        $data['order']  = Order::where('customer_id', Auth::user()->id)->where('id',$id)->get();
        
        $data['snapToken'] = $data['order']->snap_token;
        if (is_null($data['snapToken'])) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database
            
            $midtrans = new CreateSnapTokenService($data['order']);
            $data['snapToken'] = $midtrans->getSnapToken();
            
            $data['order']->snap_token = $data['snapToken'];
            $data['order']->save();
        }
        dd($data);

        return view('customer.checkout', $data);
    }

    public function post_checkout(Request $request)
    {
        // dd($request->all());
        $order      = new Order;
        $orderProd  = new OrderProduct;
        $total      = 0;

        // calculate total price
        $cart       = Cart::with('product')->where('customer_id', Auth::user()->id)->get();
        foreach ($cart as $item){
            $total  += $item->product->price*$item->qty;
        }
        $total_price = $total+5000;

        // insert to table order
        $order->code_order  = 'TRX-'.mt_rand(1000,9999).time();
        $order->customer_id = auth()->user()->id;
        $order->total       = (int)$total_price;
        $order->status      = Str::lower('paid');
        $order->phone       = (int)$request->phone;
        $order->address     = Str::ucfirst($request->address);
        $order->save();

        // insert to table order product
        foreach ($cart as $item){
            $orderProd->order_id    = $order->id;
            $orderProd->product_id  = $item->id;
            $orderProd->qty         = $item->qty;
            $orderProd->save();

            Cart::destroy($item->id);
        }

        return redirect()->route('checkout', $order->id);
    }

    public function payment(Request $request, $id)
    {
        $trx    = Order::with('user')->find($id);
        $orders = OrderProduct::where('order_id',$trx->id)->get();
        $user   = Auth::user()->id;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $trx_details = array(
            'transaction_details' => array(
                'order_id' => $trx->code_order,
                'gross_amount' => round($trx->total),
            )
        );

        $item_details = [];
        foreach($orders as $order) {
            $data = $order->product;
            $item = array(
                'id'        => $data->id,
                'price'     => $data->price,
                'quantity'  => 1,
                'name'      => $data->name
            );
            array_push($item_details, $item);
        }
        // dd($item_details);

        $user_details = array(
            'first_name'    => $user->name,
            'last_name'     => '',
            'email'         => $trx->email,
            'phone'         => $trx->phone
        );
        // dd($user_details);

        $params = [
            'transaction_details'   => $trx_details,
            'item_details'          => $item_details,
            'customer_details'      => $user_details,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        dd($snapToken);
        return view('customer.payment', $data);
    }
}
