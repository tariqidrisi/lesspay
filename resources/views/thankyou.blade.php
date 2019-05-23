@extends('layouts.app')
@section('content')
@include('header')

	<div class="container mb-4">
		<div class="jumbotron text-xs-center" style="margin: 100px 0">
		  <h1 class="display-3"><span class="glyphicon glyphicon-ok"></span> Thank You!</h1>
		  <p class="lead">
		  	We will process your order within 24 hours and send you a confirmation email. 
			In case of not getting a confirmation email please check your spam folder or contact us at <strong><span class="glyphicon glyphicon-envelope"></span> support@largeskill.com.</strong> Our customer care executive will get in touch with you. 

			You will receive a call from our head office within <span class="glyphicon glyphicon-time"></span> 24 hours for verification
			of the order.

			If your order is not approved with <strong><span class="glyphicon glyphicon-time"></span> 24 hours</strong> your credit card might be blocked for internet transactions. Please get in touch with your bank and ask them to remove the block and authorize it.
			</p>
		  <hr>
		  <p>
		    <span class="glyphicon glyphicon-question-sign"></span> Have any query? <span class="glyphicon glyphicon-envelope"></span> Email us: <a href="#">support@largeskill.com</a>
		  </p>
		  <p class="lead">
		    <a class="btn btn-primary btn-sm" href="/" role="button">Continue to <span class="glyphicon glyphicon-home"></span> homepage</a>
		  </p>
		</div>
	</div>

	<script type="text/javascript">
	  $(document).ready(function(){
	    $('body').css("padding-top", "0px");
	  });
	</script>
	
@endsection