<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products   = Product::all();
        $orders     = Order::with('customer')->get();
        return view('products.index', compact('products','orders'));
    }

    /**
     * Menampilkan formulir untuk membuat produk baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan produk baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ratione, temporibus cum laboriosam sunt eligendi.';

        $data = new Product;

        if($thumbnail        = $request->file('thumbnail')){
            $destinationPath = 'product/';
            $nameImage       = $request->name.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath,$nameImage);
            $data->thumbnail = $nameImage;
        } else {
            $data->thumbnail = $data->thumbnail;
        }

        $data->category_id  = $request->category_id;
        $data->name         = $request->name;
        $data->price        = $request->price;
        $data->desc         = $request->desc == NULL ? $desc : $request->desc;

        $data->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Menampilkan detail produk.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Menampilkan formulir untuk mengedit produk.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Memperbarui produk yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $desc = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias ratione, temporibus cum laboriosam sunt eligendi.';

        $data = Product::find($request->product_id);

        if($thumbnail        = $request->file('thumbnail')){
            $destinationPath = 'product/';
            $nameImage       = $request->name.'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath,$nameImage);
            $data->thumbnail = $nameImage;
        }

        $data->category_id  = $request->category_id;
        $data->name         = $request->name;
        $data->price        = $request->price;
        $data->desc         = $request->desc == NULL ? $desc : $request->desc;

        $data->save();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Menghapus produk dari database.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
