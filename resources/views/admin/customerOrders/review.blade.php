@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h3 class="text-center">Review Order</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lanyard, Red</td>
                                            <td>$300</td>
                                            <td>3</td>
                                            <td>$900</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td>$900</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center bg-transparent">
                            <!-- Button to trigger payment modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="paymentModalLabel">Order Details</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white text-dark">
                    <div class="list-group">
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Order ID:</h5>
                                <span class="text-muted">1</span>
                            </div>
                        </div>
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Customer Name:</h5>
                                <span class="text-muted">John Doe</span>
                            </div>
                        </div>
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Product:</h5>
                                <span class="text-muted">Lanyard (Red, Large)</span>
                            </div>
                        </div>
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Unit Price:</h5>
                                <span class="text-muted">$300</span>
                            </div>
                        </div>
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Quantity:</h5>
                                <span class="text-muted">3</span>
                            </div>
                        </div>
                        <div class="list-group-item bg-white">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Total Amount:</h5>
                                <span class="text-muted">$900</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <form id="paymentForm">
                        <div class="form-group">
                            <label for="imageUpload">Upload OR</label>
                            <input type="file" class="form-control-file border" id="imageUpload" accept="image/*" required>
                            <!-- 'accept="image/*"' ensures only image files can be selected -->
                        </div>
                        <div id="outOfStockMessage" class="alert alert-danger" style="display: none;">
                            The product is currently out of stock.
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="processPayment()">Pay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal (Displayed after successful payment) -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="successModalLabel">Payment Successful!</h5>
                    <button type="button" class="close text-light" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-white text-black">
                    <p>Your payment has been successfully processed.</p>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function processPayment() {
          
            const paymentAmount = document.getElementById('paymentAmount').value;
        
            setTimeout(function() {
                $('#paymentModal').modal('hide'); // Hide payment modal
                $('#successModal').modal('show'); // Show success modal
            }, 1000); 
        }
    </script>

@endsection
