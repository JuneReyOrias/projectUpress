@extends('customer.customer_dashboard')


<!-- Header -->
<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
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
                        <a class="nav-link  active" href="{{route('customer.addcart.cart_order')}}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-primary">{{$no_cart}}</span>
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
<div class="page-heading products-heading header-text" >
    <!-- Add blurry effect to the background image -->
   
    <!-- Add dirty white color overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
        <div style="background-image: #fff;width: 100%; height: 100%;"></div>
    </div>
        
                   
   


    <div class="container">
        <div class="card card-body border rounded"  >
            @if (session()->has('message'))
            <div class="alert alert-success" id="success-alert">
              <button type="button" class="close" data-dismiss="alert">x</button>
        
        
                {{session()->get('message')}}
              </div>
              @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                
                <div class="col-lg-12 col-md-12 col-12">
                    <h3 class="display-5 mb-2 text-center"> Cart</h3>
                    <p class="mb-5 text-center">
                        <i class="text-info font-weight-bold">{{ $no_cart}}</i> items in your cart</p>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th style="width:20%">Product</th>
                            <th style="width:12%">Item-Name</th>
                            <th style="width:12%">Type</th>
                            <th style="width:12%">Color</th>
                            <th style="width:12%">Quantity</th>
                            <th style="width:12%">Unit Price</th>
                            <th style="width:12%">Total Amount</th>
                            <th style="width:12%">action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ( $cart as $carts )
                                
                       
                            <td data-th="Product">
                                <div class="row">
                                   
                                    <div class="col-md-9 text-left mt-sm-2">
                                        <img src="/productimages/{{ $carts->image}}" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                    </div> 
                                </div>
                            </td>
                            <td data-th="Price">{{ $carts->item_name}}</td>
                            <td data-th="Price">{{ $carts->type}}</td>
                            <td data-th="Price">{{ $carts->color}}</td>
                            <td data-th="Quantity">{{ $carts->quantity}}
                                {{-- <input type="number" class="form-control form-control-lg text-center" value="{{ $carts->quantity}}"> --}}
                            </td>
                            <td data-th="Price">{{ $carts->unit_price}}</td>
                            <td data-th="Price">{{ $carts->total_amount}}</td>
                           
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions">
                                   




                    <!-- Edit Button -->
                    <a href="{{route('customer.addcart.edit_cart',$carts->id)}}" title="Edit">
                        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </a>


                                    <span class="mx-1"></span> <!-- Add space between icons -->
                                    <form action="{{route('customer.addcart.delete',$carts->id)}}" method="post" accept-charset="UTF-8" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            
                            
                        </tr>
                        <tr>
                            @endforeach
                               
                    </tbody>
                </table>
                <div class="card-footers border-0 px-4 py-5"
                >
                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                  : <span class="h2 mb-0 ms-2">{{ number_format($total, 2) }}</span></h5>
              </div>
                <div class="row mt-4 d-flex align-items-center justify-content-end">
                    <div class="col-sm-6 order-md-1 text-right">
                        <!-- Checkout button -->
                        <form id="checkoutForm" action="{{route('customer.orderlist.confirm_order')}}" method="GET">
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
