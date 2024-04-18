@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10"> <!-- Increased column width to 10 for larger table -->
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
                                <table class="table table-bordered table-lg"> <!-- Added table-lg class for a larger table -->
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
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
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewTransactionModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Add more rows for additional records -->
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="viewTransactionModalLabel">Transaction Details</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white text-black">
                    <p><strong>Order ID:</strong> 1</p>
                    <p><strong>Customer Name:</strong> John Doe</p>
                    <p><strong>Product:</strong> Lanyard (Red, Large)</p>
                    <p><strong>Unit Price:</strong> $300</p>
                    <p><strong>Quantity:</strong> 3</p>
                    <p><strong>Total Amount:</strong> $900</p>
                </div>
                <div class="modal-footer bg-white text-black">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
