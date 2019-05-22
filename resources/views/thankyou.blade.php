@extends('layouts.app')
@section('content')
@include('header')

	<div class="container mb-4">
		<div class="jumbotron text-xs-center">
		  <h1 class="display-3">Thank You!</h1>
		  <p class="lead"><strong>Your order has been</strong> please wait till we get back to soon.</p>
		  <hr>
		  <p>
		    Have any query? Email us: <a href="#">support@largeskill.com</a>
		  </p>
		  <p class="lead">
		    <a class="btn btn-primary btn-sm" href="/" role="button">Continue to homepage</a>
		  </p>
		</div>
	</div>

	<script type="text/javascript">
	  $(document).ready(function(){
	    $('body').css("padding-top", "0px");
	  });
	</script>
	
@endsection