@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')


    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Order Receipt</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Order ID:</th>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Customer Name:</th>
                                            <td>John Doe</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Product:</th>
                                            <td>Lanyard (Red, Large)</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Unit Price:</th>
                                            <td>$200</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Quantity:</th>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Amount:</th>
                                            <td>$600</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
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
    <style>
        .modal-dialog {
            max-width: 800px; 
        }
        .modal-content {
            background-color: white;
            box-shadow: black;
        }
    </style>
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--  Order and Payment Information -->
                    <p><strong>Order ID:</strong> 1</p>
                    <p><strong>Customer Name:</strong> John Doe</p>
                    <p><strong>Product:</strong> Lanyard (Red, Large)</p>
                    <p><strong>Unit Price:</strong> $200</p>
                    <p><strong>Quantity:</strong> 3</p>
                    <p><strong>Total Amount:</strong> $600</p>
                    <hr>
                    <form id="paymentForm">
                        <!-- Payment Amount Input -->
                        <div class="form-group">
                            <label for="paymentAmount">Payment Amount ($)</label>
                            <input type="number" class="form-control" id="paymentAmount" placeholder="Enter Payment Amount" min="1" required>
                        </div>
                    </form>
                    <div id="outOfStockMessage" class="alert alert-danger" style="display: none;">
                        The product is currently out of stock. 
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Payment Action Buttons -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="processPayment()">Pay</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function processPayment() {
            // Check if the product is out of stock (simulated condition)
            const isOutOfStock = true;

            if (isOutOfStock) {
                
                document.getElementById('outOfStockMessage').style.display = 'block';
            } else {
           
                const paymentAmount = document.getElementById('paymentAmount').value;
                alert(`Payment of $${paymentAmount} processed successfully!`);
          
            }
        }
    </script>
@endsection
