<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beverages Admin | Login/Register</title>
    <link href="{{ asset('dashAssets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashAssets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashAssets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('dashAssets/vendors/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashAssets/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signin"></a>
        <a class="hiddenanchor" id="signup"></a>

        <div class="login_wrapper">
            <!-- Login Form -->
            <div class="animate form login_form">
                <section class="login_content">
                <form method="POST" action="{{ route('admin.dashLogin') }}">
               @csrf
                <h1>Login Form</h1>
                <div class="form-group">
                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                 @error('username')
                 <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                 </span>
                 @enderror
                     </div>
                   <div class="form-group">
                 <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                 @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                 </span>
                 @enderror
                </div>
                <div class="row mb-1">
                            <div class="col-md-2 offset-md-0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
               <div class="form-group">
               <button type="submit" class="btn btn-default submit">{{ __('Login') }}</button>
                 @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
                </a>
                 @endif
                 </div>
                 
                <div class="clearfix"></div>
                <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                    </p>
                   <div class="clearfix"></div>
                    <br />
                       <div>
                     <h1><i class="fa fa-graduation-cap"></i> Beverages Admin</h1>
                       <p>©2016 All Rights Reserved. Beverages Admin is a Bootstrap 4 template. Privacy and Terms</p>
                         </div>
                            </div>
                         </form>
                </section>
            </div>

            <!-- Registration Form -->
            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('admin.register') }}">
                        @csrf
                        <h1>Create Account</h1>
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default submit">{{ __('Register') }}</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-graduation-cap"></i> Beverages Admin</h1>
                                <p>©2016 All Rights Reserved. Beverages Admin is a Bootstrap 4 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>