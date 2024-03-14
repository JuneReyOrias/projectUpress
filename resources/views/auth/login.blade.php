<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>UPRESS</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="../../../assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="../../../assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="../../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="../../../assets/css/demo2/style.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="../../../assets/logo/upress-logo.png" />
</head>
<body>
	<div class="main-wrapper"style="  background-image: url(upload/wmsu.JPG); background-size: cover;    width: 100%;
  height: 100%; 
">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card-register">
              @if (session()->has('message'))
            <div class="alert alert-success" id="success-alert">
              <button type="button" class="close" data-dismiss="alert">x</button>
        
        
                {{session()->get('message')}}
              </div>
              @endif
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">

                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">WMSU<span>UPRESS</span></a>
                    <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                    <form class="forms-sample " method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                          <label for="login" class="form-label">Email address</label>
                          <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                          @error('email')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input id="password" class="form-control"
                          type="password"
                          name="password"
                          required autocomplete="current-password">
                          <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input"id="togglePasswordVisibilityCheckbox">
                            <label class="form-check-label" for="togglePasswordVisibilityCheckbox">Show Password</label>
                          </div>
  
                          @error('password')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                        </div>
                        <div>
                         <!-- <a href="../../dashboard.html" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</a>-->
                         <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                            Login
                          </button>
                        </div>
                        <a href="{{route('homepage.upress_homepage')}}" class="d-block mt-3 text-muted">Homepage</a>
                      </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
  <script>
  document.getElementById("togglePasswordVisibilityCheckbox").addEventListener("change", function () {
      var passwordInput = document.getElementById("password");

      if (this.checked) {
          passwordInput.type = "text";
      } else {
          passwordInput.type = "password";
      }
  });
</script>
	<!-- core:js -->
	<script src="../../../assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
	<script src="../../../assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->

</body>
</html>