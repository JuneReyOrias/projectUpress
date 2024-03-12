@extends('admin.dashb')
@section('admin')
<div class="page-wrapper full-page">
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card-register">
                    <div class="row">
        <div class="col-md-4 pe-md-0">
          <div class="auth-side-wrapper">

          </div>
        </div>
        <div class="col-md-8 ps-md-0">
          <div class="auth-form-wrapper px-4 py-5">
            <a href="#" class="noble-ui-logo logo-light d-block mb-2">WMSU<span>UPRESS</span></a>
            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
            <form class="forms-sample " method="post" action="{{ route('register') }}">
                @csrf
              <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name ="username"autocomplete="username" placeholder="Username" >
              </div>
              <div class="mb-3">
                <label for="firstname" class="form-label">FirstName</label>
                <input type="text" class="form-control" id="firstname" name ="firstname"autocomplete="firstname" placeholder="FirstName" >
              </div>
              <div class="mb-3">
                <label for="exampleInputUsername1" class="form-label">LastName</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name ="lastname"autocomplete="lastname" placeholder="LastName" >
              </div>
              <div class="mb-3">
                <label for="userEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
              </div>
              <div class="mb-3">
                <label for="contact_no" class="form-label">ContactNo.</label>
                <input type="text" name="contact_no" class="form-control" id="userEmail" placeholder="Contact no">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">confirm Password</label>
                <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Confirm-Password">
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" class="form-control" id="userEmail" placeholder="Role">
              </div>
              <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="authCheck">
                <label class="form-check-label" for="authCheck">
                  Remember me
                </label>
              </div>
              <div>
                <button type="submit"  class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    Sign up
                  </button>
              </div>
              <a href={{url('/')}} class="d-block mt-3 text-muted">have already account? Log in</a>
            </form>
          </div>
        </div>
      </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection