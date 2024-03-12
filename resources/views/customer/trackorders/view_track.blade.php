@extends('customer.customer_dashboard')
<style></style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<!-- ***** Preloader End ***** -->

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
                    <li class="nav-item active" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Track Orders">
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
<div class="page-heading products-heading header-text" style="background-image: url('../landingpage/assets/images/products-heading.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>View</h4>
                    <h2>Track Orders</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="products vh-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <article class="card">
                    <div class="card-body">
                        <h6>Order ID: OD45345345435</h6>
                        <article class="card">
                            <div class="card-body row">
                                <div class="col-sm-6"> <strong>Estimated Delivery time:</strong> <br>29 Nov 2019 </div>
                                <div class="col-sm-6"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i> +1598675986 </div>
                                <div class="col-sm-6"> <strong>Status:</strong> <br> Picked by the courier </div>
                                <div class="col-sm-6"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                            </div>
                        </article>
                        <div class="track row">
                            <div class="step active col-sm-6 col-md-3"> 
                                <span class="icon"> <i class="fa fa-check"></i> </span> 
                                <span class="text">Order confirmed</span> 
                            </div>
                            <div class="step active col-sm-6 col-md-3"> 
                                <span class="icon"> <i class="fa fa-user"></i> </span> 
                                <span class="text"> Picked by courier</span> 
                            </div>
                            <div class="step col-sm-6 col-md-3"> 
                                <span class="icon"> <i class="fa fa-truck"></i> </span> 
                                <span class="text"> On the way </span> 
                            </div>
                            <div class="step col-sm-6 col-md-3"> 
                                <span class="icon"><i class="fa fa-truck"></i></span> 
                                <span class="text">Ready for pickup</span> 
                            </div>
                        </div>
                        
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="https://i.imgur.com/iDwDQ4o.png" class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title">Dell Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$950 </span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="https://i.imgur.com/tVBy5Q0.png" class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title">HP Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$850 </span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-md-4">
                                <figure class="itemside mb-3">
                                    <div class="aside"><img src="https://i.imgur.com/Bd56jKH.png" class="img-sm border"></div>
                                    <figcaption class="info align-self-center">
                                        <p class="title">ACER Laptop with 500GB HDD <br> 8GB RAM</p> <span class="text-muted">$650 </span>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        <hr>
                        <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
                    </div>
                </article>
            </div>
        </div>
    </div>


    
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
