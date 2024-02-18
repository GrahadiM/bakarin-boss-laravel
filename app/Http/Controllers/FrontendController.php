<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Helper\SettingHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Services\Midtrans\CreateSnapTokenService;

class FrontendController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function about()
    {
        return view('customer.about');
    }

    public function blog()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'sources' => 'bbc-news',
            'apiKey' => 'c870899a748c4c2094754d6a43653c3e',
        ]);

        $data['articles'] = $response->json()['articles'];

        return view('customer.blog', $data);
    }

    public function contact(Request $request)
    {
        // $name = $request->input('name');
        // $email = $request->input('email');
        // $whatsappNumber = $request->input('whatsapp_number');
        // $description = $request->input('description');

        // $url = 'https://wa.me/6285767113554?text=';
        // $message = "Halo Bakarin Boss, saya $name\nEmail: $email\nNomor Telepon: $whatsappNumber\nDeskripsi: $description";
        // $encodedMessage = urlencode($message);
        // $finalUrl = $url . $encodedMessage;

        // return view('customer.contact', compact('finalUrl'));
        return view('customer.contact');
    }

    public function favorite()
    {
        $data['menu'] = OrderProduct::select('product_id', DB::raw('SUM(qty) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(4)
            ->get();

        $data['products'] = collect();
        foreach ($data['menu'] as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $data['products']->push($product);
            }
        }
        // $data['menu'] = OrderProduct::orderByDesc('qty')->take(4)->get();

        return view('customer.favorite', $data);
    }

    public function menu()
    {
        $data['menu'] = Product::all();

        return view('customer.menu', $data);
    }

    public function menuDetail($id)
    {
        $data['item'] = Product::find($id);

        return view('customer.menuDetail', $data);
    }

    public function cart(Request $request)
    {
        $data['total'] = 0;
        $data['cart']  = Cart::with('product')->where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        foreach ($data['cart'] as $item) {
            $data['total'] += $item->product->price * $item->qty;
        }

        return view('customer.cart', $data);
    }

    public function post_cart(Request $request)
    {
        $data     = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
        $new      = false;
        if (!$data) {
            $data = new Cart();
            $new  = true;
        }

        $qty = $request->qty <= 1 ? 1 : $request->qty;

        if ($new) {
            $data->qty         = $qty;
            $data->customer_id = Auth::user()->id;
        } else {
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

    public function checkout($id)
    {
        $data['total']  = 0;
        $data['order']  = Order::where('customer_id', Auth::user()->id)->where('id', $id)->first();
        $data['orderP'] = OrderProduct::where('order_id', $id)->get();

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
        $total  = 0;
        $carts  = Cart::with('product')->where('customer_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $total  += $cart->product->price * $cart->qty;
        }
        $total_price = $total;

        $order              = new Order;
        $order->code_order  = 'TRX-' . mt_rand(1000, 9999) . time();
        $order->customer_id = auth()->user()->id;
        $order->total       = (int)$total_price;
        $order->status      = Str::lower('paid');
        $order->first_name  = Str::ucfirst($request->first_name);
        $order->last_name   = Str::ucfirst($request->last_name);
        $order->phone       = (int)$request->phone;
        // $order->address     = Str::ucfirst($request->address);
        $order->save();

        foreach ($carts as $cart) {
            $orderProd              = new OrderProduct;
            $orderProd->order_id    = $order->id;
            $orderProd->product_id  = $cart->id;
            $orderProd->qty         = $cart->qty;
            $orderProd->save();

            Cart::destroy($cart->id);
            // $cart_id = Cart::find($cart->id);
            // $cart_id->delete();
        }

        return redirect()->route('payment', $order->id);
    }

    public function payment(Request $request, $id)
    {
        $atr    = Order::find($id);
        $atr->snap_token = $request->snap_token == NULL ? mt_rand(00000, 99999) . time() : $request->snap_token;
        $atr->update();
        $orders = OrderProduct::where('order_id', $atr->id)->get();
        $customer = Auth::user();

        //Set Your server key
        Config::$serverKey = SettingHelper::midtrans_api();
        // Uncomment for production environment
        // Config::$isProduction = true;
        Config::$isSanitized = Config::$is3ds = true;
        Config::$overrideNotifUrl = route('midtrans_notify');

        $transaction_details = array(
            'order_id'     => $atr->code_order,
            'gross_amount' => round($atr->total),
        );

        $item_details = [];
        foreach ($orders as $order) {
            $product = Product::where('id', $order->product_id)->first();
            $item = array(
                'id'       => $order->id,
                'price'    => $order->qty * $product->price,
                'quantity' => $order->qty,
                'name'     => $product->name
            );
            array_push($item_details, $item);
        }

        // Optional
        // $billing_address = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'address'       => "Mangga 20",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16602",
        //     'phone'         => "081122334455",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        $customer_details = array(
            'first_name'    => $customer->name,
            'last_name'     => '',
            'email'         => $customer->email,
            'phone'         => $customer->phone,
        );

        // Optional, remove this to display all available payment methods
        // $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

        $params = [
            'transaction_details' => $transaction_details,
            'item_details'        => $item_details,
            'customer_details'    => $customer_details,
            'callbacks'           => [
                'finish'          => route('index')
                // 'finish'          => route('payments_finish')
            ]
        ];
        dd($params);

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            $atr->link_pembayaran = $paymentUrl;
            $atr->update();
            // dd($paymentUrl);
            return redirect($paymentUrl);
        } catch (Exception $e) {
            return dd($e->getMessage());
        }
    }

    public function invoice(Request $request, $id)
    {
        $data['transaksi'] = Order::with('customer')->where([
            ['customer_id', Auth::user()->id],
            ['id', $id],
        ])->latest('id')->first();
        $data['items'] = OrderProduct::where('transaction_id', $data['transaksi']->id)->get();

        return view('frontend.invoice', $data);
    }
}
