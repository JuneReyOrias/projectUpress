@extends('admin.dashb')

@section('admin')
    @extends('layouts._footer-script')
    @extends('layouts._head')

    <div class="page-content">
        <div class="container">
            <div class="row mt-1">
                <div class="col-md-12">
                    <h1>Customer's order</h1>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>Lanyard</td>
                                    <td>Red</td>
                                    <td>Large</td>
                                    <td>$200</td>
                                    <td>3</td>
                                    <td>$600</td>
                                    <td>Processing</td>
                                    <td>2024-04-20</td>
                                    <td>
                                        <a href="{{ route('order.review') }}" class="btn btn-primary">Review Order</a>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
