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
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Create New Account</h4>
                </div>
                <div class="container">
                  <div class="title">Register</div>
                  <div class="content">
                    <form action{{ url('UpdateAccount') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                        <div class="input-box">
                          <span class="details">UserName:</span>
                          <input type="text" class="form-control @error('username') is-invalid @enderror"value="{{$accounts->username}}" name="username" placeholder="Enter username" value="{{ old('username') }}" >
                          @error('username')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">FirstName:</span>
                          <input type="text" class="form-control @error('firstname') is-invalid @enderror"value="{{$accounts->firstname}}" name="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}" >
                          @error('firstname')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">LastName:</span>
                          <input type="text" class="form-control @error('lastname') is-invalid @enderror"value="{{$accounts->lastname}}" name="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}" >
                          @error('lastname')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                            <span class="details">College:</span>
                            <select class="form-select @error('college') is-invalid @enderror" name="college" id="college" aria-label="Floating label select e">
                                <option value="{{$accounts->college}}">{{$accounts->college}}</option>
                                <option value="CLA" {{ old('college') == 'CLA' ? 'selected' : '' }}>CLA</option>
                                <option value="CN" {{ old('college') == 'CN' ? 'selected' : '' }}>CN</option>
                                <option value="CTE" {{ old('college') == 'CTE' ? 'selected' : '' }}>CTE</option>
                                <option value="CHE" {{ old('college') == 'CHE' ? 'selected' : '' }}>CHE</option>
                                <option value="COE" {{ old('college') == 'COE' ? 'selected' : '' }}>COE</option>
                                <option value="CAIS" {{ old('college') == 'CAIS' ? 'selected' : '' }}>CAIS</option>
                                <option value="CSM" {{ old('college') == 'CSM' ? 'selected' : '' }}>CSM</option>
                                <option value="CCJE" {{ old('college') == 'CCJE' ? 'selected' : '' }}>CCJE</option>
                                <option value="CSWD" {{ old('college') == 'CSWD' ? 'selected' : '' }}>CSWD</option>
                                <option value="CA" {{ old('college') == 'CA' ? 'selected' : '' }}>CA</option>
                                <option value="CPE" {{ old('college') == 'CPE' ? 'selected' : '' }}>CPE</option>
                                <option value="add_new">Add New</option>
                            </select>
                            @error('college')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Department:</span>
                          <input type="text" class="form-control" value="{{$accounts->department}}"name="Department" id="Department">
                             
                          @error('college')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
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
                        
                        </select>
                    </div>
                    
                    <!-- Input box for new department -->
                    <div id="additionalDepartmentField" class="input-box" style="display: none;">
                        <span class="details">New Department Name:</span>
                        <input type="text" class="form-control" name="new_department_name" id="new_department_name">
                    </div>
                        <div class="input-box">
                          <span class="details">Email</span>
                          <input type="text"name="email" class="form-control @error('email') is-invalid @enderror"value="{{$accounts->email}}" placeholder="Enter email" id="email" autocomplete="current-password" value="{{ old('email') }}" >
                          @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                            <span class="details">Contact no.;</span>
                            <input type="text"name="contact_no" class="form-control @error('contact_no') is-invalid @enderror"value="{{$accounts->contact_no}}" placeholder="Enter contact_no" id="contact_no" autocomplete="current-password" value="{{ old('contact_no') }}" >
                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="input-box">
                            <span class="details">Password</span>
                            <input type="text"name="password" class="form-control @error('password') is-invalid @enderror"value="{{$accounts->password}}" placeholder="Enter your password"id="password" autocomplete="current-password" value="{{ old('password') }}" >
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
                              <option value="{{$accounts->role}}">{{$accounts->role}}</option>
                              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                              <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>customer</option>
                              <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>staff</option>
                            
                            </select>
                          </div>
                        <div class="input-box">
                          <span class="details">UsersCode</span>
                          <input type="text" name="cust_code" class="form-control @error('cust_code') is-invalid @enderror"value="{{$accounts->cust_code}}" placeholder="Enter users code" value="{{ old('cust_code') }}">
                          @error('cust_code')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        {{-- <div class="input-box"> --}}
                          {{-- <span class="details">Product Image</span>
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
                        <input type="submit" class="register-button" value="Add">
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
  <script>
   $(document).ready(function() {
    var departments = {
        'CLA': ['BAELS', 'BAFILIPINO', 'BAHIST'],
        'CN': ['Nursing'],
        'CTE': ['BSED', 'BEED',],
        'CHE': ['Department A', 'Department B', 'Department C'],
        'COE': ['Department A', 'Department B', 'Department C'],
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
