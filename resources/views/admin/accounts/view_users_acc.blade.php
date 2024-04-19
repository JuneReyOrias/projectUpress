@extends('admin.dashb')

@section('admin')

<div class="page-content">
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

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="staff-tab" data-bs-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="false">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content mt-3">
                        <!-- Users Tab Pane -->
                        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                            <h4 class="mb-3 mb-md-0">Customer Accounts Info</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <a href="{{ route('admin.accounts.add_new_acc') }}" class="btn btn-success me-md-2">Add</a> -->
                                <!-- modal button -->
                                <a href="#" class="btn btn-success me-md-2" data-bs-toggle="modal" data-bs-target="#addAccountModal">Add</a>
                            </div>
                            <br>
                            <div class="table-responsive" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <table class="table bg-light text-black table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($accounts->where('role', 'customer') as $customer)
                                        <tr>
                                            <td>{{ $customer->cust_code.'-'.$customer->id }}</td>
                                            <td>{{ $customer->username }}</td>
                                            <td>{{ $customer->firstname }}</td>
                                            <td>{{ $customer->lastname }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->department }}</td>
                                            <td>
                                                <!-- <a href="{{ route('admin.accounts.update_acc', $customer->id) }}" title="Edit">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a> -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCustomerAccountModal">
                                                    Edit
                                                </button>

                                                <form action="{{ route('admin.accounts.delete', $customer->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Confirm delete?')">
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

                        <!-- Staff Tab Pane -->
                        <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                            <h4 class="mb-3 mb-md-0">Staff Accounts Info</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <a href="{{ route('admin.accounts.add_new_acc') }}" class="btn btn-success me-md-2">Add</a> -->
                                <button class="btn btn-success me-md-2" data-bs-toggle="modal" data-bs-target="#addStaffAccountModal">Add Staff</button>
                            </div>
                            <br>
                            <div class="table-responsive" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); ">
                                <table class="table bg-light text-black table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($accounts->where('role', 'staff') as $staff)
                                        <tr>
                                            <td>{{ $staff->cust_code.'-'.$staff->id }}</td>
                                            <td>{{ $staff->username }}</td>
                                            <td>{{ $staff->firstname }}</td>
                                            <td>{{ $staff->lastname }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->department }}</td>
                                            <td>
                                                <!-- <a href="{{ route('admin.accounts.update_acc', $staff->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </a> -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editStaffAccountModal">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.accounts.delete', $staff->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Confirm delete?')">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-2">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link bg-white text-black" href="{{ $accounts->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">&laquo; Previous</span>
                                        </a>
                                    </li>
                                    @foreach ($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
                                        <li class="page-item table-bordered{{ $page == $accounts->currentPage() ? 'active' : '' }}">
                                            <a class="page-link bg-white text-black" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                                    <li class="page-item">
                                        <a class="page-link bg-white text-black" href="{{ $accounts->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">Next &raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <!-- Admin Tab Pane -->
                        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            <h4 class="mb-3 mb-md-0">Admin Accounts Info</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <!-- <a href="{{ route('admin.accounts.add_new_acc') }}" class="btn btn-success me-md-2">Add</a> -->
                                <button class="btn btn-success me-md-2" data-bs-toggle="modal" data-bs-target="#addAdminAccountModal">Add Admin</button>
                            </div>
                            <br>
                            <div class="table-responsive" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <table class="table bg-light text-black table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>College</th>
                                            <th>Department</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th>Image</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($accounts->where('role', 'admin') as $admin)
                                        <tr>
                                            <td>{{ $admin->cust_code.'-'.$admin->id }}</td>
                                            <td>{{ $admin->username }}</td>
                                            <td>{{ $admin->firstname }}</td>
                                            <td>{{ $admin->lastname }}</td>
                                            <td>{{ $admin->college }}</td>
                                            <td>{{ $admin->department }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->contact }}</td>
                                            <td>
                                                <img style="height: 50px; width: 50px;" src="/productimages/{{ $admin->image }}" alt="User Image">
                                            </td>
                                            <td>{{ $admin->role }}</td>
                                            <td>{{ $admin->status }}</td>
                                            <td>
                                                <!-- <a href="{{ route('admin.accounts.update_acc', $admin->id) }}" title="Edit">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a> -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAdminAccountModal">
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.accounts.delete', $admin->id) }}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Confirm delete?')">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content bg-maroon">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addAccountModalLabel">Register New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <form action="{{ url('AccountAdd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3"> 
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name:</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name:</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="college" class="form-label">College:</label>
                            <select class="form-select @error('college') is-invalid @enderror" name="college" id="college" aria-label="Select College">
                                <option selected disabled>Select</option>
                                <!-- Add options for colleges here -->
                            </select>
                            @error('college')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                  
                        <div class="col-md-12">
                            <label for="new_college_name" class="form-label">New College Name:</label>
                            <input type="text" class="form-control" name="new_college_name" id="new_college_name">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contact_no" class="form-label">Contact No.:</label>
                            <input type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" id="contact_no" placeholder="Enter contact_no" value="{{ old('contact_no') }}">
                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Role:</label>
                            <select class="form-select" name="role" id="role" aria-label="Select Role">
                                <option selected disabled>Select role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Staff Account Modal -->
<div class="modal fade" id="addStaffAccountModal" tabindex="-1" aria-labelledby="addStaffAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addStaffAccountModalLabel">Add Staff Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <form action="{{ url('AccountAdd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name:</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name:</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department:</label>
                            <select class="form-select @error('department') is-invalid @enderror" name="department" id="department" aria-label="Select Department">
                                <option selected disabled>Select</option>
                                <!-- Add options for departments here -->
                            </select>
                            @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Staff Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Admin Account Modal -->
<div class="modal fade" id="addAdminAccountModal" tabindex="-1" aria-labelledby="addAdminAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="addAdminAccountModalLabel">Add Admin Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <form action="{{ url('AccountAdd') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name:</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name:</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department:</label>
                            <select class="form-select @error('department') is-invalid @enderror" name="department" id="department" aria-label="Select Department">
                                <option selected disabled>Select</option>
                                <!-- Add options for departments here -->
                            </select>
                            @error('department')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Staff Account</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Edit Customer Account Modal -->
<div class="modal fade" id="editCustomerAccountModal" tabindex="-1" aria-labelledby="editCustomerAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="editCustomerAccountModalLabel">Edit Customer Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <form action="#" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="edit_username" id="edit_username" value="{{ $customer->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="edit_firstname" id="edit_firstname" value="{{ $customer->firstname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="edit_lastname" id="edit_lastname" value="{{ $customer->lastname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="edit_email" id="edit_email" value="{{ $customer->email }}">
                    </div>
            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Staff Account Modal -->
<div class="modal fade" id="editStaffAccountModal" tabindex="-1" aria-labelledby="editStaffAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="editStaffAccountModalLabel">Edit Staff Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white text-black">
                <form action="#" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="edit_username" id="edit_username" value="{{ $staff->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="edit_firstname" id="edit_firstname" value="{{ $staff->firstname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="edit_lastname" id="edit_lastname" value="{{ $staff->lastname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="edit_email" id="edit_email" value="{{ $staff->email }}">
                    </div>
                 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Admin Account Modal -->
<div class="modal fade" id="editAdminAccountModal" tabindex="-1" aria-labelledby="editAdminAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="editAdminAccountModalLabel">Edit Admin Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="edit_username" id="edit_username" value="{{ $admin->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="edit_firstname" id="edit_firstname" value="{{ $admin->firstname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="edit_lastname" id="edit_lastname" value="{{ $admin->lastname }}">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="edit_email" id="edit_email" value="{{ $admin->email }}">
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection


<!-- @extends('admin.dashb')

@section('admin')

<div class="page-content">
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
                    
                  <h4 class="mb-3 mb-md-0">I. Customer Accounts Info</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.accounts.add_new_acc') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-info" style="background-color: #ffffff;">
                                <thead class="thead-light">
                                    <tr>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Users Id</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">UserName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">FirstName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">LastName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">College</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Department</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">email</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">contact_no</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Password</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Image</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Role</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Password</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts->where('role','customer')  as $product)
                                    <tr class="table-light">
                                        <td>{{ $product->cust_code.'-'.$product->id}}</td>
                                        <td>{{ $product->username}}</td>
                                        <td>{{ $product->firstname}}</td>
                                        <td>{{ $product->lastname}}</td>
                                        <td>{{ $product->college }}</td>
                                        <td>{{ $product->department}}</td>
                                        <td>{{ $product->email}}</td>
                                        <td>{{ $product->contact}}</td>
                                        <td>{{ $product->password}}</td>
                                        <td>
                                            <img style="height:100px; width:100px;" src="/productimages/{{ $product->image }}">
                                        </td>
                                        <td>{{ $product->role}}</td>
                                        <td>{{ $product->status}}</td>
                                       
                                        
                                        <td>
                                            <a href="{{ route('admin.accounts.update_acc', $product->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('admin.accounts.delete', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
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
                padding: 5px 10px; /* Adjust padding as needed */
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

            /* CSS for left and right arrow icons */
            .pagination > li:first-child > a,
            .pagination > li:last-child > a {
                font-size: 14px; /* Adjust size of left and right arrow icons */
            }


</style>


<div class="container">
    <ul class="pagination">
        <li><a href="{{ $accounts->previousPageUrl() }}">Previous</a></li>
        @foreach ($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
            <li class="{{ $page == $accounts->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $accounts->nextPageUrl() }}">Next</a></li>
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
</script>
@endsection -->
