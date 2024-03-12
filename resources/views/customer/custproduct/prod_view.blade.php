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
                        <a class="nav-link active" href="{{route('customer.custproduct.prod_view')}}">Products</a>
                    </li>
               
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('customer.custservices.service_view')}}">Services</a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart">
                        <a class="nav-link " href="{{route('customer.addcart.cart_order')}}">
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
<div class="page-heading products-heading header-text" style="background-image: url('../landingpage/assets/images/products-heading.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>new arrivals</h4>
                    <h2>upress products</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ session('error') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ session('error') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters">
                    <ul>
                        <li class="active" data-filter="*">All Products</li>
                        <li data-filter=".des">Latest</li>
                        <li data-filter=".dev">Top Sales</li>
                        <li data-filter=".gra">Low Stocks</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="filters-content">
                    <div class="row grid">
                        @foreach ($product as $order)

                        <div class="col-lg-4 col-md-4 all des">
                            <div class="product-item">
                                <a href="#"><img src="/productimages/{{$order->image}}" alt="" style="width: 100%; height: 200px;border-radius: 10px;"></a>
                                <div class="down-content">
                                    <a href="#">
                                        <h4 class="">{{$order->product_name}}</h4>
                                    </a>
                                    <div class="" style="gap:5px;"><h6>Php {{$order->unit_price}}</h6></div>
                                    
                                    <h4>Description:<p>{{$order->descritpion}}</p></h4>
                                    <p>Stocks: {{$order->stocks}}</p>
                                    <p>Status: {{$order->status}}</p>
                                    
                                    <!-- Add Cart button with onclick event -->
                                    <button class="btn btn-primary" onclick="openModal('{{$order->product_name}}', '{{$order->unit_price}}', '{{$order->image}}')">Add Cart</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                                            
                <!-- Modal -->
                    <div id="cartModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <h2>Add to Cart</h2>
                            <p id="productName"></p>
                            
                            <!-- Form for color select, quantity input, and other color input -->
                            <form action{{url('CartNew')}} method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4 form-group">
                                        <label for="typeSelect">Type:</label>
                                        <select id="typeSelect" name="type" class="form-control">
                                            <option value="product">Product</option>
                                            <option value="services">Services</option>
                                         
                                            <!-- Add more color options as needed -->
                                        </select>
                                    </div>
                                    
                                    <!-- Color Select Column -->
                                    <div class="col-md-4 form-group">
                                        <label for="colorSelect">Select Color:</label>
                                        <select id="colorSelect" name="color" onchange="checkColor()" class="form-control">
                                            <option value="red">Red</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="other">Other</option>
                                            <!-- Add more color options as needed -->
                                        </select>
                                    </div>
                                    
                                    <!-- Quantity Input Column -->
                                    <div class="col-md-4 form-group">
                                        <label for="quantityInput">Quantity:</label>
                                        <input type="number" id="quantityInput" name="quantity" value="1" min="1" class="form-control" onchange="calculateTotal()">
                                    </div>
                                    
                                    <div class="col-md-4 form-group">
                                        <label for="totalPrice">Total Price:</label>
                                        <input type="text" id="totalPrice" name="total_amount" class="form-control" readonly>
                                    </div>
                                </div>
                                
                                <!-- Other Color Input -->
                                <div class="form-group" id="otherColorInputContainer" style="display: none;">
                                    <label for="otherColorInput">Enter Color:</label>
                                    <input type="text" id="otherColorInput" name="othercolor"class="form-control" placeholder="Enter Color">
                                </div>
                                
                                <!-- Hidden input fields for product name, price, and user ID -->
                                <input type="hidden" id="productNameInput" name="item_name" value="{{$order->product_name}}">
                                <input type="hidden" id="productPriceInput" name="unit_price">
                                <input type="hidden" id="unitPriceInput" name="unit_price" value="{{$order->unit_price}}">
                                <input type="hidden" name="product_id" value="{{$order->id}}">
                                <input type="hidden" name="users_id" value="{{$order->users_id}}">
                                <input type="hidden" id="userIdInput" name="image" value="{{$order->image}}">
                                
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                    <script>
                    function openModal(productName, productPrice, userId) {
                        document.getElementById("productName").textContent = productName;
                        document.getElementById("productNameInput").value = productName;
                        document.getElementById("productPriceInput").value = productPrice;
                        document.getElementById("unitPriceInput").value = productPrice;
                        document.getElementById("userIdInput").value = userId;
                        document.getElementById("cartModal").style.display = "block";
                        calculateTotal(); // Calculate total price initially
                    }

                    function closeModal() {
                        document.getElementById("cartModal").style.display = "none";
                    }

                    function checkColor() {
                        var colorSelect = document.getElementById("colorSelect");
                        var otherColorInputContainer = document.getElementById("otherColorInputContainer");
                        if (colorSelect.value === "other") {
                            otherColorInputContainer.style.display = "block";
                        } else {
                            otherColorInputContainer.style.display = "none";
                        }
                    }

                  
                    </script>
<script>
    function calculateTotal() {
    // Get the quantity input value
    var quantity = parseInt(document.getElementById("quantityInput").value);

    // Get the unit price from the hidden input field or any other source
    var unitPrice = parseFloat(document.getElementById("unitPriceInput").value);

    // Calculate the total price by multiplying quantity and unit price
    var totalPrice = quantity * unitPrice;

    // Display the total price in the "Total Price" input field
    document.getElementById("totalPrice").value = totalPrice.toFixed(2); // Ensure to format the total price as needed
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
