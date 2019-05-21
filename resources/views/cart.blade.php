@extends('layouts.app')
@section('content')
@include('header')

	<section class="jumbotron text-center">
	    <div class="container">
	        <h1 class="jumbotron-heading"><i class="icon-large icon-shopping-cart"></i>YOUR CART</h1>
	     </div>
	</section>
	
	<div class="container mb-4">
		<form name="personal" method="POST" action="">
			<div class="row">
	        <div class="col-12">
	            <div class="table-responsive">
	            	@if(!empty($productsInCartFromSession['products']))
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <!-- <th scope="col"> </th> -->
	                            <th> </th>
	                            <th scope="col">Product</th>
	                            <th scope="col">Available</th>
	                            <th scope="col" class="text-center">Quantity</th>
	                            <th scope="col" class="text-right">Price</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    
	                        @foreach($productsInCartFromSession['products'] as $product)
	                        <tr>
	                            <td class="text-right"><button class="btn btn-sm btn-danger removeFromCart" id="{{ $product['product_id'] }}"><i class="fa fa-trash"></i> </button> </td>
	                        	<td>{{ $product['name'] }}</td>
	                            <td>In stock</td>
	                            <td><input class="form-control text-right qty" type="text" name="qty" value="1" /></td>
	                            <input type="hidden" name="" class="basePrice" id="basePrice" value="{{ $product['price'] }}">
	                            <td class="text-right price" id="price">{{ $product['price'] }} $</td>
	                        </tr>
	                        @endforeach
	                    	<tr>
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
	                            <td>
	                            	Shipping   
	                            	<select name="shipping" id="shipping">
	                            		<option value="Standard" selected="">Standard</option>
	                            		<option value="Express">Express</option>
	                            	</select>
	                            </td>
	                            <td class="text-right shipping-price">20 $</td>
	                        </tr>
	                        <tr>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td><strong>Total</strong></td>
	                            <td class="text-right"><strong class="total"></strong></td>
	                        </tr>
	                        
	                    </tbody>
	                </table>
	                @else 
	                <table class="table table-striped">
	                	<tr class="text-center">Your cart is empty. <a href="/">Buy Something</a></tr>
	                </table>
	                @endif
	            </div>
	        </div>

	        @if(!empty($productsInCartFromSession['products']))
	        	<div class="accordion col-md-12" id="accordionExample">
  
				  	<div class="">
					    <div class="" id="headingTwo">
					      <h5 class="mb-0">
					        <button class="btn btn-block btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: darkgray;    margin-bottom: 15px;">
					          Click here!! to enter personal details
					        </button>
					      </h5>
					    </div>
					    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					      <div class="card-body">
					        
					        <div class="form-group">
							  <label for="usr">Name:</label>
							  <input type="text" class="form-control" id="name" name="name" value="" required="">
							</div>
							<div class="form-group">
							  <label for="pwd">Address:</label>
							  <textarea class="form-control" name="address" id="address" required=""></textarea>
							</div>
					        <div class="form-group">
							  <label for="usr">Mobile:</label>
							  <input type="text" class="form-control" id="mobile" name="mobile" required="">
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
							  <input type="text" class="form-control" id="ccno" name="ccno" required="">
							</div>
							<div class="form-group">
							  <label for="usr">Expiry Date:</label>
							  <input type="text" class="form-control" id="expiry_date" name="expiry_date" required="">
							</div>
							<div class="form-group">
							  <label for="usr">CVV:</label>
							  <input type="text" class="form-control" id="cvv" name="cvv" required="">
							</div>
					      </div>
					    </div>
				  	</div>
			  	</div>

		        <div class="col mb-2">
		            <div class="row">
		                <div class="col-sm-12  col-md-6">
		                    <a href="/" class="btn btn-block btn-light">Continue Shopping</a>
		                </div>
		                <div class="col-sm-12 col-md-6 text-right">
		                    <button type="submit" class="btn btn-lg btn-block btn-success text-uppercase">Place Order</button>
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

	});

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
			$(".shipping-price").html("50 $");
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