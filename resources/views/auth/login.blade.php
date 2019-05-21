@extends('admin.admin')

@section('content')
<div class="container">
    <p class="text-center"><a href="/"> Ecommerce</a></p>
    <hr>

    <div class="row">
        <aside class="col-sm-4 admin-form">
            <p>Please use your credentials to login.</p>
            <div class="card">
                <article class="card-body">
                    <a href="{{ route('register') }}" class="float-right btn btn-outline-primary">Sign up</a>
                    <h4 class="card-title mb-4 mt-1">Sign in</h4>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" >Your email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- form-group// -->
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a class="float-right" href="{{ route('password.request') }}">
                                    Forgot?
                                </a>
                            @endif
                            <label for="password" >Your password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- form-group// -->
                        <div class="form-group">
                            <div class="checkbox">
                                <input class="" type="checkbox" style="margin-left:0px" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <!-- checkbox .// -->
                        </div>
                        <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Login </button>
                        </div>
                        <!-- form-group// -->
                    </form>
                </article>
            </div>
            <!-- card.// -->

        </aside>
        <!-- col.// -->
        
        </aside>
        <!-- col.// -->
    </div>
    <!-- row.// -->
</div>

@endsection('content')