<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // session内容確認
        // $cart = session()->get('cart', []);
        // print_r($cart);
        $products = Product::all();
        return view('sneakers.index')->with('products', $products);
        // return view('sneakers.index')->with('products', $products)->with('cart', $cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('sneakers.product')->with('product', $product);
    }

    /**
     * Move to cart
     *
     * @return response()
     */
    public function cart()
    {
        return view('sneakers.cart');
    }
  
    /**
     * Add product to cart
     *
     * @param  int  $id
     * @return response()
     */
    public function addCart($id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        // カートにidがあると数量が＋
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

        // カートにidがないと新しく＋
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price
            ];
        }
        
        // sessionセーブ
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update product qunatity in cart
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Remove the specified resource from session.
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        $request->session()->forget('cart' . $request->id);
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully.');
        }else{
            session()->flash('error', 'Product removed failed.');
        }
    }
}
