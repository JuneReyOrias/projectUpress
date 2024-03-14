@extends('customer.customer_dashboard')
<style>
    .btn i {
        vertical-align: middle;





        /* Modal for Editing Product Details */
.modal {
    display: none; /* Hide the modal by default */
    position: fixed; /* Position the modal */
    z-index: 1000; /* Set z-index to ensure it appears above other content */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scrolling if needed */
    background-color: rgba(0,0,0,0.4); /* Black background with opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered horizontally */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* 80% width */
    max-width: 600px; /* Max width to ensure it's not too wide on larger screens */
}

/* Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form Styles */
.form-group {
    margin-bottom: 20px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .modal-content {
        width: 90%; /* Adjust width for smaller screens */
    }
}

@media (max-width: 576px) {
    .modal-content {
        width: 95%; /* Adjust width for even smaller screens */
    }
}

    }


    .text-content {
    border: 1px solid #ccc;
    padding: 20px; /* Optional: Adjust padding as needed */
}

</style>
 <!-- ***** Preloader Start ***** -->
 <div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>  
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
                            <span class="badge bg-primary">{{$carters}}</span>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-contents border">
                    <h4>Edit Cart</h4><br>
                    <h2 id="type_services">{{$cart->type_services}}</h2>
                    <p id="category">{{$cart->services}}</p>

<br>
      
        
        <!-- Form for color select, quantity input, and other color input -->
        <form action{{url('UpdateCarts')}} method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-md-4 form-group">
                    <label for="typeSelect">Type:</label>
                    <input type="text" id="typeSelect" name="type" class="form-control" value="{{$cart->type}}" readonly>
                     
                </div>

                <!-- Color Select Column -->
                <div class="col-md-4 form-group">
                    <label for="colorSelect">Select Color:</label>
                    <select id="colorSelect" name="color" onchange="checkColor()" class="form-control">
                        <option value="{{$cart->color}}" >{{$cart->color}}</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="other">Other</option>
                        <!-- Add more color options as needed -->
                    </select>
                </div>
                <!-- Color Select Column -->
                <div class="col-md-4 form-group">
                    <label for="sizeSelect">Size:</label>
                    <select id="sizeSelect" name="sizeof" onchange="checkSize()" class="form-control">
                        <option value="{{$cart->sizeof}}" >{{$cart->sizeof}}</option>
                        <option value="Long">Long</option>
                        <option value="Short">Short</option>
                        <option value="A4">A4</option>
                        <option value="add">Add</option>
                        <!-- Add more color options as needed -->
                    </select>
                </div>

                <!-- Quantity Input Column -->
                <div class="col-md-4 form-group">
                    <label for="quantityInput">Quantity:</label>
                    <input type="number" id="quantityInput" name="quantity" class="form-control" value="{{$cart->quantity}}"  class="form-control" onchange="calculateTotal()">
                </div>

                <div class="col-md-4 form-group">
                    <label for="totalPrice">Total Price:</label>
                    <input type="text" id="totalPrice" name="total_amount"  value="{{number_format($cart->total_amount,2)}}" class="form-control" readonly>
                </div>
      
                <!-- Hidden input fields -->
                <input type="hidden" id="productNameInput" name="services" id="category" value="{{$cart->services}}">
                <input type="hidden" id="productPriceInput" name="unit_price"value="{{$cart->unit_price}}">
                <input type="hidden"id="serviceIdInput" name="service_category_id" value="{{$cart->service_category_id}}">
                <input type="hidden" name="users_id" >
                <input type="hidden" id="userIdInput" >
                <input type="hidden" id="typeImagesInput" name="image" id="typeImage" value="{{$cart->image}}" >
                <input type="hidden" id="typeServicesInput" name="type_services" id="typeServices"value="{{$cart->type_services}}">

            </div>

            <!-- Other Color Input -->
            <div class="col-md-4 form-group" id="otherColorInputContainer" style="display: none;">
                <label for="otherColorInput">Add Color:</label>
                <input type="text" id="otherColorInput" name="other_color" class="form-control" placeholder="Enter Color">
            </div>
             <!-- Other size Input -->
             <div class="col-md-4 form-group" id="AddnputContainer" style="display: none;">
                <label for="AddinputContainer">Add Size:</label>
                <input type="text" id="AddinputContainer" name="new_size" class="form-control" placeholder="Enter Size">
            </div>

            <!-- Submit Button -->  
             <a href="{{ route('customer.addcart.cart_order') }}" class="btn btn-success ">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
         
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

    function openModal(category, productPrice, userId, type_services) {
        var serviceId = $(event.target).closest('.product-item').find('.service-id').val();
    
        document.getElementById("category").textContent = category;
        document.getElementById("productNameInput").value = category;
        document.getElementById("productPriceInput").value = productPrice;
        document.getElementById("serviceIdInput").value = serviceId; // Update the hidden input field with the service ID
        document.getElementById("userIdInput").value = userId;
       // Set the selected type_services in the dropdown
        document.getElementById("type_services").textContent = type_services; // Update the modal header with type_services
        document.getElementById("typeServicesInput").value = type_services;
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
        function checkSize() {
            var sizeSelect = document.getElementById("sizeSelect");
            var otherColorInputContainer = document.getElementById("AddnputContainer");
            if (sizeSelect.value === "add") {
               AddnputContainer.style.display = "block";
            } else {
               AddnputContainer.style.display = "none";
            }
        }
        function calculateTotal() {
            // Get the quantity input value
            var quantity = parseInt(document.getElementById("quantityInput").value);
    
            // Get the unit price from the hidden input field or any other source
            var unitPrice = parseFloat(document.getElementById("productPriceInput").value);
    
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
                                        <script>
                                            // Function to retrieve the service ID when the "Add Cart" button is clicked
                                            document.querySelectorAll('.add-to-cart').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    // Retrieve the service ID from the data attribute of the button
                                                    const serviceId = this.getAttribute('data-service-id');
                                                    
                                                    // Set the service ID in the hidden input field of the modal
                                                    document.getElementById('serviceIdInput').value = serviceId;
                                                    
                                                    // Display the service ID in the modal body
                                                    document.getElementById('serviceId').textContent = serviceId;
                                                });
                                            });
                                            
                                            // Function to add the service to the cart
                                            function addToCart() {
                                                // Retrieve the service ID from the hidden input field in the modal
                                                const serviceId = document.getElementById('serviceIdInput').value;
                                                
                                                // Perform further actions, such as adding the service to the cart
                                                console.log('Service ID:', serviceId);
                                                
                                                // You can add more logic here to add the service to the cart
                                            }
                                        </script>
                                        
    <script>
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.getAttribute('data-service-id');
                const typeServices = this.getAttribute('data-service-type');
                const typeImage = this.getAttribute('data-service-image');
                document.getElementById('serviceIdInput').value = serviceId;
                document.getElementById('typeServicesInput').value = typeServices;
                document.getElementById('typeImagesInput').value = typeImage;
                document.getElementById('serviceId').textContent = serviceId;
            });
        });
    
        function addToCart() {
            const serviceId = document.getElementById('serviceIdInput').value;
            const typeServices = document.getElementById('typeServicesInput').value;
            const typeImage = document.getElementById('typeImagesInput').value;
            console.log('Service ID:', serviceId);
            console.log('Type Services:', typeServices);
            console.log('Type Image:', typeImage );
            // Add logic to add the service to the cart
        }
    </script>