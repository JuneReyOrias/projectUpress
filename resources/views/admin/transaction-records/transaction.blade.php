@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-15"> 
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h3 class="text-center">Transaction Records</h3>
                        </div>
                        <div class="card-body">
                        <div class="row mb-3 justify-content-end">
                            <div class="col-auto">
                                    <label for="stockTypeFilter" class="form-label">Filter:</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select form-select-sm" id="stockTypeFilter">
                                        <option value="all">All</option>
                                        <option value="stock-in">2</option>
                                        <option value="stock-out">1</option>
                                    </select>
                                </div>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-lg"> 
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Payment OR</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>Lanyard (Red, Large)</td>
                                            <td>$300</td>
                                            <td>3</td>
                                            <td>$900</td>
                                            <td>Paid or Unpaid</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewTransactionModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- View Transaction Modal -->
<div class="modal fade" id="viewTransactionModal" tabindex="-1" role="dialog" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="viewTransactionModalLabel">Transaction Details</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body bg-white text-black">
                <div class="container-fluid">
                <!-- Header Section -->
                <div class="row justify-content-center align-items-center mb-4">
                    <!-- University Logo 1 -->
                    <div class="col-6 col-md-3 text-center">
                        <img class="img-fluid rounded-circle mb-2" src="../landingpage/assets/images/wmsu.png" alt="University Logo" style="max-width: 100px;">
                    </div>

                    <!-- University Details -->
                    <div class="col-6 col-md-3 text-center">
                        <span>Western Mindanao State University</span><br>
                        <h5>UNIVERSITY PRESS</h5>
                        <span>Zamboanga City</span>
                    </div>

                    <!-- University Logo 2 -->
                    <div class="col-6 col-md-3 text-center">
                        <img class="img-fluid rounded-circle mb-2" src="../assets/logo/upress-logo.png" alt="University Logo" style="max-width: 100px;">
                    </div>
                </div>

                    <!-- Transaction Details and Payment Proof -->
                    <div class="row">
                        <!-- Left Column (Transaction Information) -->
                        <div class="col-md-6 mt-3">
                            <div class="mb-2">
                                <p><strong>Order ID:</strong> 1</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Customer Name:</strong> John Doe</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>College:</strong>College of Computing Studies</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Department :</strong>Computer Science</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Product:</strong> Lanyard (Red, Large)</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Unit Price:</strong> 300</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Quantity:</strong> 3</p>
                            </div>
                            <div class="mb-2">
                                <p><strong>Total Amount:</strong> 900</p>
                            </div>
                        </div>

                        <!-- Right Column (Payment Proof Image) -->
                        <div class="col-md-6 text-center">
                            <div class="mb-0">
                                <p><strong>Payment Proof:</strong></p>
                                <img src="https://via.placeholder.com/300" class="img-fluid" alt="Payment Proof">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer bg-white text-black">
                <a href="#" class="btn btn-primary">Download PDF</a>
                <a href="#" class="btn btn-secondary">Print</a>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@endsection
