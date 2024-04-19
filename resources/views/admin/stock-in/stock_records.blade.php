@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="title">Stock Records</div>
                <!-- Filter dropdown -->
                <div class="row mb-3 justify-content-end">
                    <div class="col-auto">
                        <label for="recordTypeFilter" class="form-label">Filter:</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm" id="recordTypeFilter">
                            <option value="all">All</option>
                            <option value="stock-in">Stock In</option>
                            <option value="stock-out">Stock Out</option>
                        </select>
                    </div>
                </div>

                <!-- Stock records table -->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Stock ID</th>
                                <th>Product Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Color</th>
                                <th>Product Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Product A</td>
                                <td>Size M</td>
                                <td>100</td>
                                <td>2024-04-18</td>
                                <td>Red</td>
                                <td>200</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewStockModal">View</a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Stock Modal -->
<div class="modal fade" id="viewStockModal" tabindex="-1" aria-labelledby="viewStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="viewStockModalLabel">Stock Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: black; background-color: white;">
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Stock ID:</strong></div>
                    <div class="col-md-8">1</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Product Name:</strong></div>
                    <div class="col-md-8">Product A</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Size Name:</strong></div>
                    <div class="col-md-8">Size M</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Quantity:</strong></div>
                    <div class="col-md-8">100</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Date:</strong></div>
                    <div class="col-md-8">2024-04-18</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Color</strong></div>
                    <div class="col-md-8">Red</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Product Price</strong></div>
                    <div class="col-md-8">200</div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
