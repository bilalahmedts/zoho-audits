<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - {{ env('APP_NAME') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="icon" href="{{ asset('img/touchstone-icon.jpg') }}" type="image/x-icon">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <img src="{{ asset('img/logo.png') }}" width="100%" class="img-responsive" alt="Logo">
          </div>
          <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
      
            @if(Session::has('error'))
              <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
              @endif
      
            <form action="{{ route('login.submit') }}" method="post">
              @csrf
              <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" value="" placeholder="Email Address" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              @error('email')
                  <div class="validate-error">{{ $message }}</div>
              @enderror
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              @error('password')
                  <div class="validate-error">{{ $message }}</div>
              @enderror
              <div class="row">
                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-block btn-primary mt-3">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
      
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
