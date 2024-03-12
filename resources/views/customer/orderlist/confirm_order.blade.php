@extends('customer.customer_dashboard')



<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="">
                <h2>WMSU <em>UPRESS</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('customer.customer_dashboard')}}">Home
              <span class="sr-only">(current)</span>
            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('customer.custproduct.prod_view')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('customer.custservices.service_view')}}">Services</a>
                    </li>
                   
            
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart">
                      <a class="nav-link" href="{{route('customer.addcart.cart_order')}}">
                          <i class="fas fa-shopping-cart"></i>
                          <span class="badge bg-primary">{{$carter}}</span>
                      </a>
                  </li>
                  <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Orders">
                    <a class="nav-link" href="{{route('customer.orderlist.view_orders')}}">
                      <i class="fas fa-shopping-bag"></i>
                      <span class="badge bg-primary">{{$pendingOrders}}</span>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Track Orders">
                  <a class="nav-link" href="{{route('customer.trackorders.view_track')}}">
                    <i class="fas fa-truck"></i>
                    <span class="badge bg-primary">{{$pending}}</span>
                  </a>
              </li>
             
              <li class="nav-item dropdown" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notifications">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge bg-primary" id="notificationCount">0</span>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown" id="notificationDropdownMenu">
                    <!-- Notification items will be dynamically populated here -->
                </div>
            </li>
                
                  <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact us">
                    <a class="nav-link" href="">
                        <i class="fas fa-address-book"></i>
                
                    </a>
                </li>
              
             <li class="nav-item">
              @php
                $id =Auth::user()->id;
              $customer = App\Models\User:: find($id);
              @endphp
              <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <img class="wd-10 ht-3 rounded-circle" src="/customerimages/{{$customer->image}}" alt="profile" height="28px;width:35px;">
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm p-0" aria-labelledby="profileDropdown">
                  <div class="d-flex flex-column align-items-center border-bottom px-3 py-2">
                      <div class="mb-2">
                          <img class="wd-10 ht-60 rounded-circle" src="/customerimages/{{$customer->image}}" alt="" height="28px;width:35px;">
                      </div>
                      <div class="text-center">
                          <p class="tx-14 fw-bolder">{{ $customer->firstname.' '.$customer->lastname}}</p>
                          <p class="tx-10 text-muted">{{ $customer->email}}</p>
                      </div>
                  </div>
                  <ul class="list-unstyled p-1">
                      <li class="dropdown-item py-2">
                          <a href="route('profile.edit')" class="text-body ms-0">
                              <i class="me-2 icon-md" data-feather="user"></i>
                              <span>Profile</span>
                          </a>
                      </li>
                      <li class="dropdown-item py-2">
                          <a href="{{route('customer.profile.new_update')}}" class="text-body ms-0">
                              <i class="me-2 icon-md" data-feather="edit"></i>
                              <span>Edit Profile</span>
                          </a>
                      </li>
                      <li class="dropdown-item py-2">
                          <a href="{{route('customer.logout')}}" class="text-body ms-0">
                              <i class="me-2 icon-md" data-feather="log-out"></i>
                              <span>Log Out</span>
                          </a>
                      </li>
                  </ul>
              </div>
          </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
{{-- page contents --}}
<div class="page-heading products-heading header-text" 
>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    {{-- <h4>Confirm Order</h4> --}}
                    <section class="h-100 gradient-custom">
                        <div class="container py-5 h-100">
                          <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-10 col-xl-8">
                              <div class="card" style="border-radius: 10px; color:#b51717;">
                                <div class="card-header px-4 py-5" style="background-color: #fff; position: relative;">
                                    <a href="{{route('customer.addcart.cart_order')}}" title="Back">
                                        <button class="btn btn-primary btn-sm d-flex"><i class="far fa-arrow-alt-circle-left" aria-hidden="true"></i></button>
                                    </a>
                                    <h5 class="text-muted">Checkout <span></span>!</h5>
                                </div>
                                <div class="card-body p-4">
                                    
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0" style="color: #b51717;">Product</p>
                                    <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p>
                                  </div>
                                  <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                        @foreach ($cart as $cartItems )
                                        <div class="row">
                                            <div class="col-md-2">
                                              <img src="/productimages/{{ $cartItems->image}}"
                                                class="img-fluid" alt="Phone">
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0">{{$cartItems->item_name }}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Color: {{$cartItems->color}}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Php {{ number_format($cartItems->unit_price, 2) }}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Qty: {{$cartItems->quantity}}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Php {{ number_format($cartItems->total_amount, 2) }}</p>
                                            </div>
                                          </div>
                                          <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                       @endforeach
                                      
                                   
                                     
                                    </div>
                                  </div>
                                  <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0" style="color: #b51717;">Services</p>
                                    
                                  </div>
                                  <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                        @foreach ($cart as $cartItems )
                                        <div class="row">
                                            <div class="col-md-2">
                                              <img src="/productimages/{{ $cartItems->image}}"
                                                class="img-fluid" alt="Phone">
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0">{{$cartItems->item_name }}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Color: {{$cartItems->color}}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Php {{ number_format($cartItems->unit_price, 2) }}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Qty: {{$cartItems->quantity}}</p>
                                            </div>
                                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                              <p class="text-muted mb-0 small">Php {{ number_format($cartItems->total_amount, 2) }}</p>
                                            </div>
                                          </div>
                                          <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                       @endforeach
                                      
                                   
                                     
                                    </div>
                                  </div>
                      

                                <div class="card-footer border-0 px-4 py-5"
                                  style="background-color: #D7DBDD; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                  <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                    : <span class="h2 mb-0 ms-2">{{$total}}</span></h5>
                                </div>
                                <div class="row mt-4 d-flex justify-content-center">
                                    <div class="col-sm-6 order-md-2 text-center">
                                        <form id="checkoutForm" action{{URL('OrderList')}} method="POST">
                                            @csrf <!-- Include CSRF token for Laravel -->
                                            <!-- You can include hidden input fields here to pass additional data if needed -->
                                            <!-- For example: -->
                                            <!-- <input type="hidden" id="additionalData" name="additionalData" value="someValue"> -->
                                            <button type="button" class="btn btn-primary mb-4 btn-lg pl-5 pr-5" onclick="prepareCheckout()">Checkout</button>
                                        </form>
                                    </div>
                                </div>
                                
                           
                     
                                    
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
                                        function prepareCheckout() {
                                            // Gather data from the page
                                            // Example: If you have input fields with IDs, you can get their values like this:
                                            // var additionalData = document.getElementById('additionalData').value;
                                    
                                            // If you have multiple fields to collect data from, gather them similarly
                                    
                                            // Once you have collected all the data you need, populate the form fields
                                            // Example:
                                            // document.getElementById('additionalData').value = additionalData;
                                    
                                            // Submit the form
                                            document.getElementById('checkoutForm').submit();
                                        }
                                    </script>
                                    
<!-- Add your JavaScript files here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Function to fetch and display notifications
    function fetchNotifications() {
        // Simulate fetching notifications from the server
        // Replace this with actual AJAX call to fetch notifications
        const notifications = [
            { title: "New Order Received", time: "30 min ago" },
            { title: "Server Limit Reached!", time: "1 hr ago" },
            { title: "New customer registered", time: "2 sec ago" }
            // Add more notifications as needed
        ];

        // Clear existing notifications
        $("#notificationDropdownMenu").empty();

        // Update notification count
        $("#notificationCount").text(notifications.length);

        // Populate notification items
        notifications.forEach(notification => {
            $("#notificationDropdownMenu").append(`
                <a href="#" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                        <i class="far fa-bell"></i>
                    </div>
                    <div class="flex-grow-1 me-2">
                        <p>${notification.title}</p>
                        <p class="tx-12 text-muted">${notification.time}</p>
                    </div>
                </a>
            `);
        });
    }

    // Function to mark all notifications as read
    function markAllNotificationsAsRead() {
        // Perform actions to mark notifications as read
        // This function can be called when "Clear all" is clicked
        $("#notificationDropdownMenu").empty();
        $("#notificationCount").text("0");
    }

    // Fetch notifications when document is ready
    $(document).ready(function() {
        fetchNotifications();
    });
</script>
