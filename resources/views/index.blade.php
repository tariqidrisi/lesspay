@extends('layouts.app')

@section('content')

@include('header')

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Address</h1>
        <p class="lead text-muted mb-0">"PARTICULATE health service" - 2441 Roan Ridge Rd.  Grand Junction  Co  81505</p><br/>
        <p>Contact Us : 1-925-953-8773, 1-925-953-8672</p>
    </div>
</section>

<div class="container">
  <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
      </div>
  </div>
</div>

<div class="container">
    <div class="row">        
        <div class="col">          
            <div class="row">
              @foreach($featured_med as $med)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top prod-image" src="{{ env('APP_URL') }}{{ Storage::url("$med->image") }}" alt="{{ $med->product_id }}">
                        <div class="card-body">
                            <h4 class="card-title" ><span style="font-size: 25px;color:#007bff" class="prod-name">{{ $med->product_id }}</a></h4>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-primary btn-block prod-price">{{$med->price}} $</p>
                                </div>
                                <div class="col" id="{{ $med->product_id }}">
                                  <input type="hidden" name="prod_id" value="{{ $med->product_id }}" class="prod-id">
                                    <?php
                                      // check product exist in cart or not
                                      $allProd = session('cart');
                                      // dd($allProd);
                                      if($allProd) {

                                        $exist = array();
                                        foreach ($allProd['products'] as $key => $value) {
                                            $exist[] = $value['product_id'];
                                        } 
                                      } else {
                                        $exist = [];
                                      }
                                      $index = array_search($med->product_id,$exist);
                                      
                                      if($index !== FALSE){ ?>
                                        <button class="btn btn-success btn-block gotoCart" disabled="">Already in Cart</button>
                                    <?php   
                                      } else { ?>
                                        <button class="btn btn-success btn-block gotoCart">Add to cart</button>
                                    <?php
                                      }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>          
        </div>

        <!-- check product already added to cart -->
        @if(session()->has('cart'))
          <?php
            $session_product_in_cart = session('cart')['products'];
            if(!empty($session_product_in_cart)) {              
              foreach ($session_product_in_cart as $prod) {
                $existing_product_in_cart[] = $prod['product_id'];
              }
            } else {
              $existing_product_in_cart = array();
            }
            // convert array to string
            $sess_arr = implode(",", $existing_product_in_cart);
            // dd($sess_arr);
          ?>
        @else 
          <?php $sess_arr = ""; ?>
        @endif
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('body').css("padding-top", "0px");
    
    // add product to cart
    var arrOne = [];
    $(".gotoCart").on("click", function(){
      // i = i+1;
      // $(".cartCount").html(i);
      $(this).html('Go to cart');
      $(this).removeClass('gotoCart');
      $(this).attr("disabled", true);
      arrOne.push($(this).parent().attr("id"));

      var strVale = "{{ $sess_arr }}";
      var arrTwo = strVale.split(',');
      // merge session product and newly added product
      var myarray = $.merge( arrOne, arrTwo );
      console.log(myarray);
      $.post("{{ route('addToCart') }}", { "ids": myarray, "_token": "{{ csrf_token() }}", }, function(data){
        $(".cartCount").html(data.count);
      });
      
    });
    
  });
</script>
@endsection
