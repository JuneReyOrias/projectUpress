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
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Create New Sizes</h4>
                </div>
                <div class="container">
                  <div class="title">Sizes</div>
                  <div class="content">
                    <form action{{ url('AccountAdd') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                       
                        <div class="input-box">
                            <span class="details">Sizes Name:</span>
                            <select class="form-select @error('college') is-invalid @enderror" name="college" id="college" aria-label="Floating label select e">
                                <option selected disabled>Select</option>
                                <option value="CLA" {{ old('college') == 'CLA' ? 'selected' : '' }}>CLA(College of Liberal Arts)</option>
                                <option value="CN" {{ old('college') == 'CN' ? 'selected' : '' }}>CN(Collge Of Nursing)</option>
                                <option value="CTE" {{ old('college') == 'CTE' ? 'selected' : '' }}>CTE (College of Teacher Eduaction)</option>
                                <option value="COE" {{ old('college') == 'COE' ? 'selected' : '' }}>COE (Collge Of Engineering)</option>
                                <option value="COA" {{ old('college') == 'COA' ? 'selected' : '' }}>COA (Collge Of Architecture)</option>
                                <option value="CCS" {{ old('college') == 'CCS' ? 'selected' : '' }}>CCS (Collge Of Computing Studies)</option>
                                <option value="CHE" {{ old('college') == 'CHE' ? 'selected' : '' }}>CHE (Collge Of Home Economics)</option>
                                <option value="CAIS" {{ old('college') == 'CAIS' ? 'selected' : '' }}>CAIS (Collge Of Islamic and Asian Studies)</option>
                                <option value="CSM" {{ old('college') == 'CSM' ? 'selected' : '' }}>CSM (Collge Of Science and Mathematics)</option>
                                <option value="CCJE" {{ old('college') == 'CCJE' ? 'selected' : '' }}>CCJE (Collge Of Criminal Justice Education)</option>
                                <option value="CSWCD" {{ old('college') == 'CSWCD' ? 'selected' : '' }}>CSWCD (Collge Of Social Work and Community Development)</option>
                               
                                <option value="CPE" {{ old('college') == 'CPE' ? 'selected' : '' }}>CPE (Collge Of Physical Education)</option>
                                <option value="add_new">Add New</option>
                                <option value="UPRESS" {{ old('college') == 'UPRESS' ? 'selected' : '' }}>UPRESS</option>
                            </select>
                            @error('college')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Additional input box for new college -->
                        <div id="additionalCollegeField" class="input-box" style="display: none;">
                            <span class="details">New Sizes Name:</span>
                            <input type="text" class="form-control" name="new_sizes_name" id="new_college_name">
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
                      
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Add">
                    </div>
                    
                      {{-- <a href="{{ route('admin.accounts.view_users_acc') }}" class="btn btn-success ">Back</a> --}}
                    </form>
                  </div>
                </div>
          </div>
        </div>
        <div class="container">
        <div class="row m-4">
            <div class="col-md-12 grid-margin">
                {{-- <div class="card shadow">
                   
                    <div class="card-body"> --}}
                        @if (session()->has('message'))
                        <div class="alert alert-success" id="success-alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        
                      <h4 class="mb-3 mb-md-0">Sizes</h4>
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
                                          
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($stockout->count() > 0)
                                        @foreach ($stockout  as $product)
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
                                                {{-- <a href="{{ route('admin.stockout.update_acc', $product->id) }}" title="Edit">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>
                                                <form action="{{ route('admin.stockout.delete', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="5">Stock Out is Empty</td>
                                        </tr>
                                    @endif
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
            <li><a href="{{ $stockout->previousPageUrl() }}">Previous</a></li>
            @foreach ($stockout->getUrlRange(1, $stockout->lastPage()) as $page => $url)
                <li class="{{ $page == $stockout->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li><a href="{{ $stockout->nextPageUrl() }}">Next</a></li>
        </ul>
    </div>
    
    
                        
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
