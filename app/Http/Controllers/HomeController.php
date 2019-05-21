<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featured_med = Products::get();
        // dd($featured_med);
        return view('index', compact('featured_med'));
    }

    public function addToCart(Request $request) {
        // dd($request->all());
        // $count = array_count_values(request('ids'));
        if(!empty(request('ids'))) {
            $ids = array_unique(array_filter(request('ids')));
        } else {
            $ids = [0];
        }
        
        return $this->getProductsFromIds($request, $ids);

    }

    public function getCart(Request $request){
        $productsInCartFromSession = $request->session()->get('cart');
        // dd($productsInCartFromSession);
        // $request->session()->flush();
        return view("cart", compact('productsInCartFromSession'));
    }

    public function removeFromCart(Request $request) {
        
        $allProd = session('cart');
        $removeProd = array();
        foreach ($allProd['products'] as $key => $value) {
            $removeProd[] = $value['product_id'];
        }

        // dd($removeProd, request('id'));
        $index = array_search(request('id'),$removeProd);
        if($index !== FALSE){
            unset($removeProd[$index]);
        }

        return $this->getProductsFromIds($request, $removeProd);
    }

    public function getProductsFromIds($request, $ids) {
        $products = Products::whereIn('product_id', $ids)->get();
        $all = array();
        $sum = 0;
        $subtotal = 0;
        foreach ($products as $key => $value) {
            $subtotal += $value->price; 
            $all[] = [
                        'id' => $value->id,
                        'product_id' => $value->product_id,
                        'name' => $value->name,
                        'price' => $value->price,
                        'image' => $value->image,
                        'created_at' => $value->created_at,
                        'updated_at' => $value->updated_at,
                        'deleted_at' => $value->deleted_at
                    ];
        }
        
        $data['products'] = $all;
        $data['subtotal'] = $subtotal;
        // dd($data);
        $data['count'] = count($data['products']); //cart count
        $request->session()->put('cart', $data); // cart products
        $data['status'] = 1;
        $data['yourCart'] = $request->session()->get('cart');

        return $data;
    }
}
