@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">
    <h2>Customer Services</h2>

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="serviceTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#Services" type="button" role="tab" aria-controls="Services" aria-selected="true">Services</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#pendingServices" type="button" role="tab" aria-controls="pendingServices" aria-selected="false">Pending Services</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approvedServices" type="button" role="tab" aria-controls="approvedServices" aria-selected="false">Approved Services</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="serviceTabsContent">
        <!--  Services Tab -->
        <div class="tab-pane fade show active" id="Services" role="tabpanel" aria-labelledby="service-tab">
            <div class="table-toolbar mb-3">
                <!-- Button to Add Service Modal -->
                <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                    Add Service
                </button>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Service ID</th>
                        <th>Service</th>
                        <th>Type of Service</th>
                        <th>Sizes</th>
                        <th>Units</th>
                        <th>Color</th>
                        <th>Unit Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td>
                            <img src="path_to_image.jpg" alt="Service Image" style="width: 50px;">
                        </td>
                        <td>Service123</td>
                        <td>Printing</td>
                        <td>Brochure Printing</td>
                        <td>A4</td>
                        <td>100</td>
                        <td>Full Color</td>
                        <td>$50.00</td>
                        <td>Available</td>
                        <td>
                            <!-- Button to View Details Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal1">
                                View Details
                            </button>
                            <!-- Button to edit Details Modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editServiceModal">
                                Edit
                            </button>
                        </td>
                    </tr>
            
                </tbody>
            </table>
            </div>
        </div>

        <!-- Pending Services Tab -->
        <div class="tab-pane fade" id="pendingServices" role="tabpanel" aria-labelledby="pending-tab">
            <div class="table-toolbar mb-3">
                <!-- Button to Add Service Modal -->
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Service Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Service Row (Replace with dynamic data) -->
                        <tr>
                            <td>John Doe</td>
                            <td>Printing</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pendingServiceModal1">
                                    View Details
                                </button>
                            </td>
                            <td>Pending</td>
                            <td>
                                <!-- Button to Approve Service Modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveServiceModal1">
                                    Approve
                                </button>
                            </td>
                        </tr>
                        <!-- Add more rows for other pending services -->

                    </tbody>
                </table>
            </div>

        </div>

        <!-- View Details Modal for Pending Service -->
        <div class="modal fade" id="pendingServiceModal1" tabindex="-1" aria-labelledby="pendingServiceModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="pendingServiceModal1Label">Service Details - Printing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white text-black">
                        <p><strong>Customer Name:</strong> John Doe</p>
                        <p><strong>Service Type:</strong> Printing</p>
                        <p><strong>Details:</strong> Brochure Printing, A4, 100 copies, Full Color</p>
                        <!-- Additional service details can be included here -->
                    </div>
                    
                    <div class="modal-footer bg-white text-black">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approve Service under pending Modal -->
        <div class="modal fade" id="approveServiceModal1" tabindex="-1" aria-labelledby="approveServiceModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="approveServiceModal1Label">Approve Service - Printing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white text-black">
                        <!-- Approval Form or Confirmation Message -->
                        <p>To approve, Upload the Payment OR</p>
                        <label for="imageUpload">Upload OR</label>
                        <input type="file" class="form-control-file border" id="imageUpload" accept="image/*" required>
                      
                    </div>
           
                    <div class="modal-footer bg-white text-black">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success">Approve</button>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Approved Services Tab -->
        <div class="tab-pane fade" id="approvedServices" role="tabpanel" aria-labelledby="approved-tab">
            <div class="table-toolbar mb-3">
                <!-- Button to Add Service Modal -->
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Service Type</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Binding</td>
                            <td>Binding Service - Hardcover, A5, 50 copies</td>
                            <td>Approved</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#serviceDetailsModal1">
                                    View
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Michael Johnson</td>
                            <td>Printing</td>
                            <td>Printing Service - Brochure, A4, 200 copies, Full Color</td>
                            <td>Approved</td>
                            <td>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#serviceDetailsModal2">
                                    View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Service Details Modals -->
        <div class="modal fade" id="serviceDetailsModal1" tabindex="-1" aria-labelledby="serviceDetailsModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceDetailsModal1Label">Service Details - Jane Smith</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-white text-black">
                        <p><strong>Customer Name:</strong> Jane Smith</p>
                        <p><strong>Service Type:</strong> Binding</p>
                        <p><strong>Details:</strong> Binding Service - Hardcover, A5, 50 copies</p>
                        <p><strong>Status:</strong> Approved</p>

                    </div>
                    <div class="modal-footer bg-white text-black">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addServiceModalLabel">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <!-- Form to Add Service -->
                <form>
                    <!-- Service Name Input -->
                    <div class="mb-3">
                        <label for="serviceName" class="form-label text-black">Service Name</label>
                        <input type="text" class="form-control" id="serviceName" placeholder="Enter service name">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


<!-- <div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card shadow">
               
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    
                  <h4 class="mb-3 mb-md-0">UPRESS Services Informaion</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('servicescat.new_servcat') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <tr> <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">image</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Services Id</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Type of Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Sizes</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Units</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Color</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Unit Price</th>
                                     
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Status</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicescat as $services)
                                    <tr class="table-light">
                                        <td>
                                            <img style="height:70px; width:70px;" src="/servicesimages/{{$services->image}}">
                                        </td>
                                        <td>{{ $services->id}}</td>
                                        <td>{{ $services->category }}</td>
                                        <td>{{ $services->type_services }}</td>
                                        <td>{{ $services->size}}</td>
                                        <td>{{ $services->unit}}</td>
                                        <td>{{ $services->color}}</td>
                                        <td>{{ $services->unit_price}}</td>
                                        
                                        <td>{{ $services->status}}</td>
                                        <td>
                                            <a href="{{ route('servicescat.update_services', $services->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('servicescat.delete_services', $services->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                    <style>
                     /* CSS to center the container */
.container {
    text-align: center;
}

.pagination {
    display: inline-block;
    list-style: none;
    padding: 0;
}

            .pagination > li {
                display: inline-block;
                margin-right: 5px;
            }

            .pagination > li > a,
            .pagination > li > span {
                display: inline-block;
                padding: 5px 10px; 
                border: 1px solid #ccc;
                border-radius: 3px;
                text-decoration: none;
                color: #333;
            }

            .pagination > li.active > a,
            .pagination > li.active > span {
                background-color: #007bff;
                color: #fff;
            }

            .pagination > li > a:hover,
            .pagination > li > span:hover {
                background-color: #f0f0f0;
            }

        
            .pagination > li:first-child > a,
            .pagination > li:last-child > a {
                font-size: 14px; 
            }


</style>


<div class="container">
    <ul class="pagination">
        <li><a href="{{$servicescat->previousPageUrl() }}">Previous</a></li>
        @foreach ($servicescat->getUrlRange(1,$servicescat->lastPage()) as $page => $url)
            <li class="{{ $page == $servicescat->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $servicescat->nextPageUrl() }}">Next</a></li>
    </ul>
</div>


                    
            </div>
        </div>
    </div>
</div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    $(document).ready(function() {
        $("#success-alert").hide();
        $("#myWish").click(function showAlert() {
            $("#success-alert").alert();
            window.setTimeout(function() {
                $("#success-alert").alert('close');
            }, 2000);
        });
    });



    $("li").click(function () {
  $(this).addClass("active").siblings().removeClass("active");
});
</script> -->