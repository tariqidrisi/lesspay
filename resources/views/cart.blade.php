@extends('layouts.app')
@section('content')
@include('header')

	<section class="jumbotron text-center">
	    <div class="container">
	        <h1 class="jumbotron-heading"><span class="glyphicon glyphicon-shopping-cart"></span> YOUR CART</h1>
	     </div>
	</section>
		
	<div class="container mb-4">
		<form name="personal" method="POST" action="{{ route('placeOrder') }}">
			@csrf
			<div class="row">
	        <div class="col-12">
	            <div class="table-responsive">
	            	@if(!empty($productsInCartFromSession['products']))
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <!-- <th scope="col"> </th> -->
	                            <th> </th>
	                            <th scope="col">Product Id</th>
	                            <th scope="col">Product Name (Package)</th>
	                            <th scope="col">Available</th>
	                            <th scope="col" class="text-center">Package</th>
	                            <th scope="col" class="text-right">Price</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $ctr = 0; $tot = 0; ?>
	                        @foreach($productsInCartFromSession['products'] as $product)

	                        <input type="hidden" name="product_id{{ $ctr }}" class="product_id" id="product_id" value="{{ $product['product_id'] }}">
	                        
	                        <tr>
	                            <td class="text-right"><button class="btn btn-sm btn-danger removeFromCart" id="{{ $product['product_id'] }}"><i class="fa fa-trash"></i> </button> </td>
	                        	<td>{{ $product['product_id'] }}</td>
	                        	<td>{{ $product['name'] }}</td>
	                            <td>In stock</td>
	                            <td><div style="float: left;width: 40%;"><input class="form-control text-right qty" type="number" name="qty{{ $ctr }}" value="1" /> </div>
	                            <div style="float: left;width: 5%;margin-left: 8px;"> <b style="color:red">X</b> </div> 
	                            	<div style="float: left;width: 40%;"><input class="form-control text-right" type="number" name="pill" value="{{ $product['qty'] }}" readonly="" /></div></td>
	                            <input type="hidden" name="basePrice{{ $ctr }}" class="basePrice" id="basePrice" value="{{ $product['price'] }}">
	                            <td class="text-right price" id="price">{{ $product['price'] }} $</td>
	                        </tr>
	                        <?php $ctr++; $total = $tot + $product['price']; ?>
	                        @endforeach
	                    	<tr>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td>Sub-Total</td>
	                            <td class="text-right sub_total"></td>
	                        </tr>
	                        <tr>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td>
	                            	Shipping   
	                            	<select name="shipping" id="shipping" 
	                            	 required="">
	                            		<option value="" disabled selected>Please select shipping type</option>
	                            		<option value="Standard">Standard (Delivery 25-27 days)</option>
	                            		<option value="Express">Express (Delivery 13-15 days)</option>
	                            	</select>
	                            	<span class="err-msg" style="display:none;color: red;font-size: 12px;">Please select shipping type.</span>
	                            </td>
	                            <td class="text-right shipping-price">20 $</td>
	                        </tr>
	                        <tr>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <input type="hidden" name="total" class="total" id="total" value="{{ $total }}">
	                            <td><strong>Total</strong></td>
	                            <td class="text-right"><strong class="total"></strong></td>
	                        </tr>
	                        
	                    </tbody>
	                </table>
	                @else 
	                <table class="table table-striped">
	                	<tr class="text-center">Your <span class="glyphicon glyphicon-shopping-cart"></span> cart is empty. <a href="/">Buy Something</a></tr>
	                </table>
	                @endif
	            </div>
	        </div>

	        @if(!empty($productsInCartFromSession['products']))
	        	<div class="accordion col-md-12" id="accordionExample">
  
				  	<div class="">
					    <div class="" id="headingTwo">
					      <h5 class="mb-0">
					        <button class="btn btn-block btn-light collapsed text-uppercase place-order" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: darkgray;    margin-bottom: 15px;color: #dc3545">
					          <b><span class="glyphicon glyphicon-arrow-down"></span> Place an Order</b>
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse orderdiv" aria-labelledby="headingTwo" data-parent="#accordionExample">
					      <div class="card-body">
					        
					        <div class="form-group">
							  <label for="usr">Name:</label>
							  <input type="text" class="form-control" id="name" name="name" value="" required="">
							</div>
							<div class="form-group">
							  <label for="pwd">Shippping Address:</label>
							  <textarea class="form-control" name="address" id="address" required=""></textarea>
							</div>
					        <div class="form-group">
							  <label for="usr">Mobile:</label>
							  <input type="text" class="form-control" id="mobile" name="mobile" required="" maxlength="10">
							</div>
							<div class="form-group">
							  <label for="usr">Email:</label>
							  <input type="text" class="form-control" id="email" name="email" required="">
							</div>
							<div class="form-group">
							  <label for="usr">Name on Card:</label>
							  <input type="text" class="form-control" id="card_name" name="card_name" required="">
							</div>
							<div class="form-group">
							  <label for="usr">Billing Address:</label>
							  <textarea class="form-control" name="bill_address" id="bill_address" required=""></textarea>
							</div>
							<div class="form-group">
							  <label for="usr">Credit Card Number:</label>
							  <input type="number" class="form-control" id="ccno" name="ccno" required="">
							</div>
							<div class="form-group">
							  <label for="usr">Expiry Date:</label>
							  <input type="date" class="form-control" id="expiry_date" name="expiry_date" required="">
							</div>
							<div class="form-group">
							  <label for="cvv">CVV:</label>
							  <input type="number" class="form-control" id="cvv" name="cvv" required="" maxlength="4">
							</div>
					      </div>

					      <div class="col-sm-12 col-md-3 text-right">
		                    <button type="submit" class="btn btn-lg btn-block btn-success text-uppercase" id="placeOrder" style="margin-bottom: 15px">Submit</button>
		                  
		                    <span class="err-msg" style="display: none;position: absolute;bottom: 10px;width: 100%;color: red;    font-size: 20px;">Please select shipping type.</span>
		                  
		                  </div>
					    </div>
				  	</div>
			  	</div>

		        <div class="col mb-2">
		            <div class="row">
		                <div class="col-sm-12  col-md-12">
		                    <a href="/" class="btn btn-block btn-light btn-success text-uppercase " style="background-color: darkgray;    margin-bottom: 15px;color: #dc3545"><b><span class="glyphicon glyphicon-arrow-right"></span> Continue Shopping</b></a>
		                </div>
		                
		            </div>
		        </div>
	        @endif
			</div>
		</form>
	</div>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $('body').css("padding-top", "0px");
	    $('.cartCount').html("{{ $productsInCartFromSession['count'] }}");
	    $('.sub_total').html("{{ $productsInCartFromSession['subtotal'] }} $");
	    calculateShipping();
	    calculatePrice();

	    $(".removeFromCart").on("click", function(){

	      var idToRemove = $(this).attr("id");
	      $(this).closest('tr').remove();

	      $.post("{{ route('removeFromCart') }}", { "id": idToRemove, "_token": "{{ csrf_token() }}", }, function(data){
	        $(".cartCount").html(data.count);
	        $(".qty").trigger("keyup");
	        calculateShipping();
	        // calculatePrice();
	      });
	      
	    });

	    // calculate shipping charges
	    $("#shipping").change(function(){
	    	calculateShipping();
	    	$(".qty").trigger("keyup");
	    });

	    // calculate price
	    $("table .qty").on("keyup", function(){
	    	var qty = $.trim($(this).val()); // remove space
	    	if(qty == "") {
	    		var qty = 1;
	    	}
	    	
	    	var price = $(this).closest('tr').find('#basePrice').val();
	    	var totalPrice = parseInt(qty) * parseInt(price);
	    	
	    	$(this).closest('tr').find('.price').text(totalPrice+" $");

	    	var sum = 0;
			$('.price').each(function(){
				sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
			});
			$(".sub_total").text(sum+" $"); 
			calculateShipping();    	
	    });

	    // // place order
	    // $("#placeOrder").click(function(){

	    // 	var name = $("#name").val();
	    // 	var address = $("#address").val();
	    // 	var mobile = $("#mobile").val();
	    // 	var email = $("#email").val();
	    // 	var card_name = $("#card_name").val();
	    // 	var bill_address = $("#bill_address").val();
	    // 	var ccno = $("#ccno").val();
	    // 	var expiry_date = $("#expiry_date").val();
	    // 	var cvv = $("#cvv").val();

	    // 	$.post("{{ route('placeOrder') }}", { "name": name, "address": address, "mobile": mobile,"email": email,"card_name": card_name,"bill_address": bill_address,"ccno": ccno,"expiry_date": expiry_date,"cvv": cvv, "_token": "{{ csrf_token() }}", }, function(data){
		        
		   //  });
	    // });

	    $(".place-order").click(function(){
	    	selectShippingType();
	    });

	    $("#shipping").change(function(){
	    	selectShippingType();
	    });

	});

	  function selectShippingType() {
	  	var shipping = $("#shipping").val();
    	if(shipping == null) {
    		$("#placeOrder").attr("disabled", "true");
    		$(".err-msg").show();
    		$("#shipping").focus();
    		
    		// return false;
    	} else {
    		$("#placeOrder").removeAttr("disabled");
    		$(".err-msg").hide();	    		
    	}
	  }

	  function calculatePrice(){
	  	$('table .qty').each(function(){
		  	var qty = $.trim($("table .qty").val()); // remove space
	    	if(qty == "") {
	    		var qty = 1;
	    	}
	    	
	    	var price = $("table .qty").closest('tr').find('#basePrice').val();
	    	var totalPrice = parseInt(qty) * parseInt(price);
	    	
	    	$("table .qty").closest('tr').find('.price').text(totalPrice+" $");

	    	var sum = 0;
			$('.price').each(function(){
				sum += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
			});
			$(".sub_total").text(sum+" $"); 
			// calculateShipping();
		});
	  }

	  function calculateShipping() {
	  	if($("#shipping").val() == "Express") {
			// express
			$(".shipping-price").html("25 $");
			var eprice = parseInt($(".shipping-price").text(), 10);
			var etotal = parseInt($(".sub_total").text()) + parseInt(eprice);
			
			$('.total').text(etotal+" $");
		} else {
			// standard
			$(".shipping-price").html("20 $");
			var sprice = parseInt($(".shipping-price").text(), 10);
			var stotal = parseInt($(".sub_total").text()) + parseInt(sprice);
			
			$('.total').text(stotal+" $");
		}
		// calculatePrice();
	  }
	</script>
@endsection