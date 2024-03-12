@extends('customer.customer_dashboard')


<style>
  /* Style for modal */
  .modal {
      display: none;
      position: fixed;
      justify-content: center;
      z-index: 1000;
      left: 0;
      top: 12px;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 500px; /* Set maximum width for larger screens */
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      text-align: center;
      position: relative;
  }

  @media screen and (max-width: 768px) {
      /* Adjust modal width for smaller screens */
      .modal-content {
          width: 90%;
          padding: 15px;
          margin: 20% auto; /* Center the modal vertically and horizontally */
      }
  }

  @media screen and (max-width: 480px) {
      /* Further adjustments for mobile phones */
      .modal-content {
          margin-top: 4px;
          margin: 20% auto; /* Center the modal vertically and horizontally */
      }

      .modal-content h2 {
          font-size: 18px;
      }

      .modal-content select,
      .modal-content input[type="number"] {
          width: 100%;
          margin-bottom: 10px;
      }

      .modal-content button {
          width: 100%;
      }
  }

  /* Close button style */
  .close {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
  }

  /* Add to cart button style */
  button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
  }

  button:hover {
      background-color: #45a049;
  }
</style>


    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>WMSU <em>UPRESS</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{route('customer.customer_dashboard')}}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{route('customer.custproduct.prod_view')}}"> Products</a>
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
            <a class="nav-link" href="{{route('homecontact.contacts')}}">
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

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01" style="background-image: url('../landingpage/assets/images/slide_01.jpg');" >
       
          <div class="text-content">
            <h4>Best Offer</h4>
            <h2>New Arrivals On Sale</h2>
          </div>
        </div>
        <div class="banner-item-02" style="background-image: url('../landingpage/assets/images/slide_02.jpg');">

          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03" style="background-image: url('../landingpage/assets/images/slide_03.jpg');">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="{{route('homeproduct.view')}}">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_01.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$25.75</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (24)</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_02.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$30.25</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (21)</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_03.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$20.45</h6>
                <p>Sixteen Clothing is free CSS template provided by TemplateMo.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (36)</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_04.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$15.25</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (48)</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_05.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$12.50</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (16)</span>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="product-item">
              <a href="#"><img src="../landingpage/assets/images/product_06.jpg" alt=""></a>
              <div class="down-content">
                <a href="#"><h4>Tittle goes here</h4></a>
                <h6>$22.50</h6>
                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                <ul class="stars">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span>Reviews (32)</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
{{-- end products list --}}

{{-- start point of services --}}
<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Latest Servicess</h2>
          <a href="{{route('homeservices.serve')}}">view all services <i class="fa fa-angle-right"></i></a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_01.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$25.75</h6>
            <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (24)</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_02.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$30.25</h6>
            <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (21)</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_03.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$20.45</h6>
            <p>Sixteen Clothing is free CSS template provided by TemplateMo.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (36)</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_04.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$15.25</h6>
            <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (48)</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_05.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$12.50</h6>
            <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (16)</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="product-item">
          <a href="#"><img src="../landingpage/assets/images/product_06.jpg" alt=""></a>
          <div class="down-content">
            <a href="#"><h4>Tittle goes here</h4></a>
            <h6>$22.50</h6>
            <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
            <ul class="stars">
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
              <li><i class="fa fa-star"></i></li>
            </ul>
            <span>Reviews (32)</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- end services list --}}
    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About WMSU UPRESS</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Looking for the best products?</h4>
              <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">This template</a> is free to use for your business websites. However, you have no permission to redistribute the downloadable ZIP file on any template collection website. <a rel="nofollow" href="https://templatemo.com/contact">Contact us</a> for more info.</p>
              <ul class="featured-list">
                <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                <li><a href="#">Consectetur an adipisicing elit</a></li>
                <li><a href="#">It aquecorporis nulla aspernatur</a></li>
                <li><a href="#">Corporis, omnis doloremque</a></li>
                <li><a href="#">Non cum id reprehenderit</a></li>
              </ul>
              <a href="about.html" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="../landingpage/assets/images/feature-image.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <div class="row">
                <div class="col-md-8">
                  <h4>Creative &amp; Unique <em>UPRESS</em> Products</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                </div>
                <div class="col-md-4">
                  <a href="#" class="filled-button">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



   
  
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
