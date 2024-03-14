@extends('admin.dashb')

@section('admin')

<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
 
    @if (session('message'))
    <div class="alert alert-success" role="alert">
      {{ session('message')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
       
    @endif
   
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        

         

              <div class="row mb-4">
                
                <div>
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Check Orders</h4>
                </div>
                <div class="container">
                  <div class="title">Orders</div>
                  <div class="content">
                    <form action{{ url('ordersCustoUpdate') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                        <div class="input-box">
                          <span class="details">Users ID:</span>
                          <input type="text" class="form-control @error('users_id') is-invalid @enderror" name="users_ids"value="{{$ordersEdit->cust_code.'-'.$ordersEdit->users_id}}" placeholder="Enter users_id" value="{{ old('users_id') }}"readonly >
                          @error('username')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">ProductID:</span>
                          <input type="text" class="form-control @error('product_id') is-invalid @enderror" name="product_id"value="{{$ordersEdit->product_id}}" placeholder="product_id" value="{{ old('product_id') }}" readonly>
                          @error('product_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">ServiceID:</span>
                          <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->service_category_id}}" name="service_category_id" placeholder="Enter serviceID" value="{{ old('service_category_id') }}"readonly >
                         
                        </div>
                        <div class="input-box">
                            <span class="details">Item Name:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->item_name}}" name="item_name" placeholder="item name" value="{{ old('service_category_id') }}">
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Type:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->type}}" name="type" placeholder="item name" value="{{ old('service_category_id') }}"readonly>
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Offer Services:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->services}}" name="services" placeholder="item name" value="{{ old('service_category_id') }}"readonly>
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Type Services:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->type_services}}" name="type_services" placeholder="item name" value="{{ old('service_category_id') }}"readonly>
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Color:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->color}}" name="color" placeholder="item name" value="{{ old('service_category_id') }}">
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Size:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->sizeof}}" name="sizeof" placeholder="item name" value="{{ old('service_category_id') }}">
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Quantity:</span>
                            <input type="number" class="form-control @error('service_category_id') is-invalid @enderror"value="{{$ordersEdit->quantity}}" name="quantity" placeholder="item name" value="{{ old('service_category_id') }}">
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Unit Price:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{number_format($ordersEdit->unit_price,2)}}" name="unit_price" placeholder="item name" value="{{ old('service_category_id') }}"readonly>
                           
                          </div>
                          <div class="input-box">
                            <span class="details">Total Amount:</span>
                            <input type="text" class="form-control @error('service_category_id') is-invalid @enderror"value="{{number_format($ordersEdit->total_amount,2)}}" name="total_amount" placeholder="item name" value="{{ old('service_category_id') }}"readonly>
                           
                          </div>
                        <div class="input-box">
                            <span class="details">Order Status:</span>
                            <select class="form-select @error('order_status') is-invalid @enderror" name="order_status" id="order_status" aria-label="Floating label select e">
                                <option value="{{$ordersEdit->order_status}}">{{$ordersEdit->order_status}}</option>
                                <option value="Pending" {{ old('order_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ old('order_status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="Confirmed" {{ old('order_status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Payment" {{ old('order_status') == 'Payment' ? 'selected' : '' }}>Payment </option>
                                <option value="Processing" {{ old('order_status') == 'Processing' ? 'selected' : '' }}>Processing </option>
                                <option value="Ready for Pick up" {{ old('order_status') == 'Ready for Pick up' ? 'selected' : '' }}>Ready for Pick up </option>
                                <option value="Completed" {{ old('order_status') == 'Completed' ? 'selected' : '' }}>Completed </option>
                               
                            </select>
                            @error('order_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
{{--                         
                        <!-- Additional input box for new college -->
                        <div id="additionalCollegeField" class="input-box" style="display: none;">
                            <span class="details">New College Name:</span>
                            <input type="text" class="form-control" name="new_college_name" id="new_college_name">
                        </div>
                        
                        <!-- Department dropdown -->
                    <div class="input-box" id="departmentDropdown" style="display: none;">
                        <span class="details">Department:</span>
                        <select class="form-select" name="department" id="department">
                        <option selected disabled>Select</option>
                        <!-- Options for departments will be populated dynamically -->
                        </select>
                    </div>
                    
                    <!-- Input box for new department -->
                    <div id="additionalDepartmentField" class="input-box" style="display: none;">
                        <span class="details">New Department Name:</span>
                        <input type="text" class="form-control" name="new_department_name" id="new_department_name">
                    </div>
                        <div class="input-box">
                          <span class="details">Email</span>
                          <input type="text"name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" id="email" autocomplete="current-password" value="{{ old('email') }}" >
                          @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                            <span class="details">Contact no.;</span>
                            <input type="text"name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" placeholder="Enter contact_no" id="contact_no" autocomplete="current-password" value="{{ old('contact_no') }}" >
                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Password</span>
                            <input type="text"name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password"id="password" autocomplete="current-password" value="{{ old('password') }}" >
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
  
                          <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="text"  class="form-control @error('password') is-invalid @enderror"id="password" autocomplete="current-password" placeholder="Password" value="{{ old('password') }}" >
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Role</span>
                            <select class="form-select" name="role"id="validationCustom01" aria-label="Floating label select e">
                              <option selected disabled>Select role</option>
                              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                              <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>customer</option>
                              <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>staff</option>
                            
                            </select>
                          </div>
                        <div class="input-box">
                          <span class="details">UsersCode</span>
                          <input type="text" name="cust_code" class="form-control @error('cust_code') is-invalid @enderror" placeholder="Enter users code" value="{{ old('cust_code') }}">
                          @error('cust_code')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div> --}}
                        {{-- <div class="input-box">
                          <span class="details">Product Image</span>
                          <div class="input-group">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="image" accept=".png, .jpeg, .jpg">
                              <label class="custom-file-label" for="inputGroupFile01" style="color: white;">Choose file</label>
                          </div>
                          @error('unit_price')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                       --}}
                      </div>
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Update">
                    </div>
                    
                      <a href="{{ route('admin.accounts.view_users_acc') }}" class="btn btn-success ">Back</a>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  {{-- <script>
   $(document).ready(function() {
    var departments = {
        'CLA': ['Bs Accountancy ','BS Econaomics','BS Psychology','Barsilyer ng Sining Sa Filipino' 'AB Broadcasting ', 'BAELS','AB Journalism', 'AB Political Science','BA History'],
        'CN': ['Nursing'],
        'CTE': ['BSED', 'BEED',],
        'CHE': ['HE'],
        'COE': ['Civil Eng', 'Mechanical Eng', 'Electrical E','Environmental Eng','Geodetic Eng','Industrial Eng','Sanitary Eng','Computer Eng','Agriculture Eng'],
        'COA':['Architecture']
        'CAIS':['Asian Studies','Islamic Studies'],
        'CSM':['BS Chemistry','BS Biology','BS Math','BS Statistics', 'BS Physics'],
        'CCJE':['BSCRIM'],
        'CAIS':['Asian Studies','Islamic Studies'],
        'UPRESS': ['Admin', 'Staff'],
    };

    $('#college').change(function() {
        var selectedCollege = $(this).val();
        var selectedDepartment = departments[selectedCollege];

        $('#department').empty().append('<option selected disabled>Select</option>');
        $.each(selectedDepartment, function(key, value) {
            $('#department').append($("<option></option>")
                .attr("value", value).text(value));
        });

        $('#departmentDropdown').show();
    });

    // Show additional college field if "Add New" is selected
    $('#college').change(function() {
        var selectedCollege = $(this).val();
        if (selectedCollege === 'add_new') {
            $('#additionalCollegeField').show();
            $('#departmentDropdown').hide();
        } else {
            $('#additionalCollegeField').hide();
        }
    });
});

</script> --}}
<script>
  $(document).ready(function() {
   var departments = {
       'CLA': ['Bs Accountancy ','BS Econaomics','BS Psychology','Barsilyer ng Sining Sa Filipino','AB Broadcasting','BAELS','AB Journalism','AB Political Science','BA History'],
       'CN': ['Nursing'],
       'CTE': ['BSED', 'BEED','Bachelor of Early Childhood Educ','Bachelor Of Special Needs Educ','Special Tertiary Education Program'],
       'CHE': ['HE'],
       'COE': ['Civil Eng', 'Mechanical Eng', 'Electrical E','Environmental Eng','Geodetic Eng','Industrial Eng','Sanitary Eng','Computer Eng','Agriculture Eng'],
       'COA':['Architecture'],
        'CAIS':['Asian Studies','Islamic Studies'],
        'CSM':['BS Chemistry','BS Biology','BS Math','BS Statistics', 'BS Physics'],
        'CCJE':['BSCRIM'],
        'CSWCD':['BS Social Work','BS Community Development'],
        'CCS':['BS Computer Science','BS Information Technology'],
        'UPRESS': ['Admin', 'Staff'],
   
      };

   $('#college').change(function() {
       var selectedCollege = $(this).val();
       var selectedDepartment = departments[selectedCollege];

       $('#department').empty().append('<option selected disabled>Select</option>');
       $.each(selectedDepartment, function(key, value) {
           $('#department').append($("<option></option>")
               .attr("value", value).text(value));
       });

       $('#departmentDropdown').show();
   });

   // Show additional college field if "Add New" is selected
   $('#college').change(function() {
       var selectedCollege = $(this).val();
       if (selectedCollege === 'add_new') {
           $('#additionalCollegeField').show();
           $('#departmentDropdown').hide();
       } else {
           $('#additionalCollegeField').hide();
       }
   });
});

</script>
@endsection
