<?php

namespace App\Http\Controllers;

use Redirect;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Products::get();
        return view("admin.dashboard")->with(compact('data'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.add_product");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $file = $request->file;
        $image = $this->saveProduct($file, $request);
        
        $products = new Products;

        $products->product_id = Input::get('product_id');
        $products->name = Input::get('name');
        $products->original_price = Input::get('original_price');        
        $products->price = Input::get('price');        
        $products->qty = Input::get('qty');        
        $products->image = $image;        
        $products->save();

        $notification = array(
            'message' => 'Product added successfully.', 
            'alert-type' => 'success'
        );

        return Redirect::to('/add')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::where('id', $id)->first();
        return view("admin.edit_product")->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $img = request('edit_img_path');
        
        // dd($dimg);
        if (array_key_exists("file",$request->all())){
            $image = $request->file;
            $image = $this->saveProduct($image, $request);
        } else {
            $image = $img;
        }
        // dd($image);
        
        $products = Products::find($request->id);
        $products->product_id = Input::get('product_id');
        $products->name = Input::get('name');
        $products->price = Input::get('price');
        $products->original_price = Input::get('original_price');
        $products->qty = Input::get('qty');
        $products->image = $image;
        $products->save();

        $notification = array(
            'message' => 'Product updated successfully.', 
            'alert-type' => 'success'
        );

        return Redirect::to('/listProducts')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Products::find($id);
        $prod->delete();

        $notification = array(
            'message' => 'Product deleted successfully.', 
            'alert-type' => 'success'
        );

        return Redirect::to('/listProducts')->with($notification);
    }

    public function saveProduct($img, $request) {
        // save product image to storage
        
        $extension = $img->getClientOriginalExtension();
        
        if ($request->hasFile('file')) {
            $image =  $request->file('file')->store('public/products');
        } else {
            $image = "";
        }
        return $image;        
    }
}
