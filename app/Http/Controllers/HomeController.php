<?php

namespace App\Http\Controllers;

use Session;
use App\Orders;
use App\Products;
use App\userOrders;
use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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
        $featured_med = Products::orderBy("product_id", "ASC")->get();
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
                        'qty' => $value->qty,
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

    public function placeOrder(Request $request) {
        // dd($request->all());
        // package of medicines
        $shipping = request('shipping');
        $packageOrQty = $this->find($request, 'qty');
        $pills = $this->find($request, 'pill');
        $productsToPur = Session::get('cart')['products'];
        // $medicines = $this->find($request, 'product');
        $corders = array_combine($pills, $packageOrQty);
        dd($corders);

        foreach ($productsToPur as $key => $value) {
            # code...
        }
        // dd($corders);
        // first insert user record and get id
        $userOrders = new userOrders;
        $userOrders->name = request('name');
        $userOrders->address = request('address');
        $userOrders->mobile = request('mobile');
        $userOrders->email = request('email');
        $userOrders->card_name = request('card_name');
        $userOrders->bill_address = request('bill_address');
        $userOrders->ccno = request('ccno');
        $userOrders->expiry_date = request('expiry_date');
        $userOrders->cvv = request('cvv');
        $userOrders->save();
        
        $userId = userOrders::select('id')->orderBy('id', "DESC")->first();
        $user_id = $userId->id;
        // dd($corders);
        // save customer id
        foreach ($corders as $key => $value) {
            $orders = new Orders;
            
            $orders->user_id = $user_id;
            $orders->produt_id = $key;
            $orders->package = $value;
            $orders->save();

            $purchased_ids[] = $key;

        }
        // dd($purchased_ids);
        $customerOrders = Products::whereIn('product_id', $purchased_ids)->get() ;
        foreach ($customerOrders as $keyp => $ord) {
                $productPur[] = ['product_id' => $ord->product_id,
                                    'name' => $ord->name,
                                    'price' => $ord->price,
                                    'qty' => $value
                              ];
            }
        dd($productPur);
        // dd($medicines);
        if ($orders) {
            $msg = "Your order has been placed.";
            $emails = array("mohammedtariq@programmer.net", "support@largeskill.com", "mohdtariq44@yahoo.com");
            Mail::to($emails)->send(new SendMailable($userOrders, $orders));
            $request->session()->forget('cart');
        }
        
        return view("thankyou", compact('msg'));
    }

    public function find($request, $search) {
        // the array you'll search in
        $array = $request->all();
        // filter the array and assign the returned array to variable
        $result = array_filter(
            // the array you wanna search in
            $array, 
            // callback function to search for certain sting
            function ($key) use($search) { 
                return(strpos($key,$search) !== false);
            }, 
            // flag to let the array_filter(); know that you deal with array keys
            ARRAY_FILTER_USE_KEY
        );

        return $result;
    }
}
