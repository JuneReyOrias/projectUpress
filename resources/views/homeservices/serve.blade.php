<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Our Services</title>

    <!-- Bootstrap core CSS -->
    <link href="landingpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="landingpage/assets/css/fontawesome.css">
    <link rel="stylesheet" href="landingpage/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="landingpage/assets/css/owl.css">
    <link rel="shortcut icon" href="../../../assets/logo/upress-logo.png" />
</head>

<body>

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
                            <a class="nav-link" href="{{route('homepage.upress_homepage')}}">Home
                  <span class="sr-only">(current)</span>
                </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('homeproduct.view')}}">Products</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('homeservices.serve')}}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('homeabout.about')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('homecontact.contacts')}}">Contact</a>
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
                    <h4>Upress</h4>
                    <h2>Services</h2>
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
                        <li class="active" data-filter="*">All Services</li>
                        @foreach ($services as $service)
                        <li id="filter_{{ $service->slug }}" data-filter=".{{ $service->slug }}">{{ $service->category }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="filters-content">
                    <div class="row grid">
                        @foreach ($services as $service)

                        <div class="col-lg-4 col-md-4 all des">
                            <div class="product-item">
                                <a href="#"><img src="/productimages/{{$service->image}}" alt="" style="width: 100%; height: 200px;bservice-radius: 10px;"></a>
                                <div class="down-content">
                                    <a href="#">
                                        <h4 class="">{{$service->category}}</h4>
                                    </a>
                                    <div class="" style="gap:5px;"><h6>Php {{$service->unit_price}}</h6></div>
                                    
                                    <h4>Description:<p>{{$service->descritpion}}</p></h4>
                                    <p>Stocks: {{$service->stocks}}</p>
                                    <p>Status: {{$service->status}}</p>
                                    
                                    <!-- Add Cart button with onclick event -->
                                    <button class="btn btn-primary" onclick="openModal('{{$service->product_name}}', '{{$service->unit_price}}', '{{$service->image}}')">Add Cart</button>
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
                                <input type="hidden" id="productNameInput" name="item_name" value="{{$service->product_name}}">
                                <input type="hidden" id="productPriceInput" name="unit_price">
                                <input type="hidden" id="unitPriceInput" name="unit_price" value="{{$service->unit_price}}">
                                <input type="hidden" name="product_id" value="{{$service->id}}">
                                <input type="hidden" name="users_id" value="{{$service->users_id}}">
                                <input type="hidden" id="userIdInput" name="image" value="{{$service->image}}">
                                
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
    <script>
        // Add event listeners to filter buttons
        document.addEventListener('DOMContentLoaded', function () {
            var filterButtons = document.querySelectorAll('.filters ul li');
            filterButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var filterValue = button.getAttribute('data-filter');
                    filterServices(filterValue);
                });
            });
        });
    
        // Function to filter services based on category
        function filterServices(filterValue) {
            var serviceItems = document.querySelectorAll('.filters-content .product-item');
            serviceItems.forEach(function (item) {
                if (filterValue === '*' || item.classList.contains(filterValue)) {
                    item.style.display = 'block'; // Show item if it matches the filter or filter is '*'
                } else {
                    item.style.display = 'none'; // Hide item if it doesn't match the filter
                }
            });
        }
    
        // Initially show all services
        filterServices('*');
    </script>
    <footer>
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="inner-content">
                  <p>Normal Road , Western Mindano State University.
                
                {{-- - OJR : <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p> --}}
                </div>
              </div>
            </div>
          </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="landingpage/vendor/jquery/jquery.min.js"></script>
    <script src="landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="landingpage/assets/js/custom.js"></script>
    <script src="landingpage/assets/js/owl.js"></script>
    <script src="landingpage/assets/js/slick.js"></script>
    <script src="landingpage/assets/js/isotope.js"></script>
    <script src="landingpage/assets/js/accordions.js"></script>


    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>


</body>

</html>