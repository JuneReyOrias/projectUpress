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
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Stock ID</th>
                                <th>Product Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
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
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="#" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Product B</td>
                                <td>Size L</td>
                                <td>50</td>
                                <td>2024-04-17</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="#" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                                    </form>
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
