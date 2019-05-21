@extends('admin.admin')

@section('content')
<div class="container">
   <br>  
   <p class="text-center">To complete signup process please register with below form.</p>
   <hr>
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card">
            <header class="card-header">
               <a href="{{ route('login') }}" class="float-right btn btn-outline-primary mt-1">Log in</a>
               <h4 class="card-title mt-2">Sign up</h4>
            </header>
            <article class="card-body">
                <form method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}
                  <div class="form-row">
                     <div class="col form-group  {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>Name</label>   
                        <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
                     </div>
                     <!-- form-group end.// -->
                     
                     @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                     @endif
                  </div>
                  <!-- form-row end.// -->
                  <div class="form-group">
                     <label>Email address</label>
                     <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                     @endif
                     <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                  
                  <!-- form-row.// -->
                  <div class="form-group">
                     <label>Password</label>
                     <input id="password" type="password" class="form-control" name="password" required>

                     @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                     @endif
                  </div>

                  <div class="form-group">
                     <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                  </div>

                  <!-- form-group end.// -->  
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-block"> Register  </button>
                  </div>
                  <!-- form-group// -->      
                  <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>                                          
               </form>
            </article>
            <!-- card-body end .// -->
            <div class="border-top card-body text-center">Have an account? <a href="{{ route('login') }}">Log In</a></div>
         </div>
         <!-- card.// -->
      </div>
      <!-- col.//-->
   </div>
   <!-- row.//-->
</div>
<!--container end.//-->
@endsection