@extends('customer.customer_dashboard')
<style></style>


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
                            <span class="badge bg-primary">{{$cart}}</span>
                        </a>
                    </li>
                    <li class="nav-item active" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Orders">
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
<div class="page-heading products-heading header-text" style="background-image: url('../landingpage/assets/images/products-heading.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>View</h4>
                    <h2>Orders</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="products vh-100">
    <div class="container">
       <div class="col-md-12">
        <div class="filters">
            <ul>
                <li data-status="all" class="active">All Orders</li>
                <li data-status="Pending">Pending</li>
                <li data-status="Confirmed">Confirmed</li>
                <li data-status="Declined">Declined</li>
                <li data-status="Orderslip">Orderslip</li>
                <li data-status="Ready for pick up">Ready for Pick Up</li>
            </ul>
        </div>
            </div>
        <div class="card card-body border rounded">
            @if (session()->has('message'))
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <article class="card">
                        <div class="card-body row">
                            <div class="col-12">
                                <img class="rounded-circles d-block mx-auto mb-4" style="max-width: 200%; height: auto; max-height: 300px;" src="../landingpage/assets/images/wmsu.png" alt="University Logo">
                                <div class="text-center">
                                    <span>Western Mindanao State University</span><br>
                                    <h5>UNIVERSITY PRESS</h5>
                                    <span>Zamboanga City</span>
                                </div>
                                <div class="text-center d-none d-md-block">
                                    <h5>ORDER SLIP</h5>
                                </div>
                                <div class="d-flex justify-content-md-between flex-column flex-md-row text-center">
                                    <div class="mb-md-0">
                                        <p>WMSU-UPRESS <span>FR-010</span></p>
                                    </div>
                                    <div class="mb-md-0">
                                        @if ($date->count() > 0)
                                        <p>riv no:<span class="font-weight-bold">_______</span></p>
                                        <p>Order Date: <span class="font-weight-bold">{{ $date->first()->created_at->format('Y-m-d') }}</span></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>CustomerID:</strong> <br> {{ $customerId }} </div>
                            <div class="col"> <strong>OrderID:</strong> <br> 
                                @foreach($groupedOrderIds as $groupedPart => $lastTwoDigits)
                                    {{ $groupedPart . '-' . implode(', ', $lastTwoDigits) }} <br>
                                @endforeach
                            </div>
                            <div class="col"> <strong>Type:</strong> <br> {{ $collegeType.' '. $department }} </div>
                            <div class="col"> <strong>Type of Job:</strong> <br> {{ $department }} </div>
                        </div>
                    </article>
                    
                    <table id="shoppingCart" class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th style="width:20%">Product</th>
                                <th style="width:12%">Item-Name</th>
                                <th style="width:12%">Type</th>
                                <th style="width:12%">Color</th>
                                <th style="width:12%">Quantity</th>
                                <th style="width:12%">Unit Price</th>
                                <th style="width:12%">Total Cost</th>
                                <th style="width:12%">Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalQuantity = 0;
                            $totalCost = 0;
                            @endphp
                            @foreach ($groupedItems as $itemName => $items)
                            @php
                            $groupedColors = $items->groupBy('color');
                            @endphp
                            @foreach ($groupedColors as $colorName => $colorItems)
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-9 text-left mt-sm-2">
                                            @foreach ($colorItems as $item)
                                            <img src="/productimages/{{ $item->image }}" alt="" class="img-fluid rounded mb-2 shadow">
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">{{ $itemName }}</td>
                                <td data-th="Price">{{ $colorItems->first()->type }}</td>
                                <td data-th="Price">{{ $colorName }}</td>
                                <td data-th="Quantity">{{ $colorItems->sum('quantity') }}</td>
                                <td data-th="Price">{{ $colorItems->first()->unit_price }}</td>
                                <td data-th="Price">{{ $colorItems->sum('total_amount') }}</td>
                                <td data-th="Order Status">
                                    <!-- Display order status here -->
                                    {{ $colorItems->first()->order_status }}
                                </td>
            
                                
                            </tr>
                            @php
                            $totalQuantity += $colorItems->sum('quantity');
                            $totalCost += $colorItems->sum('total_amount');
                            @endphp
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <div class="float-right text-right d-flex justify-content-end">
                        <div class="mr-3">
                            <span>Total Qty:</span>
                            <span><strong>{{ $totalQuantity }}</strong></span>   <br>
                        </div>
                       
                        <div>
                            <span>Total Amount:</span>
                            <span><strong>Php{{ number_format($totalCost, 2) }}</strong></span>
                        </div>
                    </div>
                    
                   
                </div>
                <a href="" class="btn btn-primary">Download Receipt as PDF</a>
            </div>
            
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.filters ul li').on('click', function() {
            // Remove the 'active' class from all filter options
            $('.filters ul li').removeClass('active');

            // Add the 'active' class to the clicked filter option
            $(this).addClass('active');

            // Get the status value from the clicked filter option
            var status = $(this).data('status');

            // Send an AJAX request to fetch orders based on the selected status
            $.ajax({
                url: '{{ route('customer.orderlist.view_orders') }}', // Adjust the route to your controller method
                type: 'GET',
                data: { status: status },
                success: function(data) {
                    // Replace the content of the orders section with the updated orders
                    $('#orders').html(data);
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(error);
                }
            });
        });
    });
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
