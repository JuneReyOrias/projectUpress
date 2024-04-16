@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
<div class="page-content">

  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
 
    {{-- @if (session('message'))
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
@endif --}}
        

         

              <div class="row mb-4">
                
                <div>
                  

                  <h4 class="mb-3 mb-md-0">Create New Size</h4>
                </div>
                <div class="container">
                  <div class="title">Color</div>
                  <div class="content">
                    <form action{{ url('AddColors') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                       
                        <div class="input-box">
                            <span class="details">Color Name:</span>
                            <select class="form-select @error('size_name') is-invalid @enderror" name="color_name" id="ColorName" aria-label="Floating label select e">
                                <option selected disabled>Select</option>
                                <option value="Blue" {{ old('color_name') == 'Blue' ? 'selected' : '' }}>Blue</option>
                                <option value="Red" {{ old('color_name') == 'Red' ? 'selected' : '' }}>Red</option>
                                <option value="Green" {{ old('color_name') == 'Green' ? 'selected' : '' }}>Green</option>
                                <option value="Yellow" {{ old('color_name') == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                                <option value="Maroon" {{ old('color_name') == 'Maroon' ? 'selected' : '' }}>Maroon</option>
                                <option value="Orange" {{ old('color_name') == 'Orange' ? 'selected' : '' }}>Orange</option>
                                <option value="Fuchsia" {{ old('color_name') == 'Fuchsia' ? 'selected' : '' }}>Fuchsia</option>

                                <option value="add_new">Add New</option>
                               
                            </select>
                            @error('color_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Additional input box for new college -->
                        <div id="additionalCollegeField" class="input-box" style="display: none;">
                            <span class="details">New Color Name:</span>
                            <input type="text" class="form-control" name="new_color_name" placeholder="add new name color" id="new_college_name">
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
                        
                      <h4 class="mb-3 mb-md-0">Color</h4>

                        <br>
                        <div>
                          
                            <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                                <table class="table bordered datatable" style="background-color: #ffffff;">
                                    <thead class="thead-light">
                                        <tr>
                                         
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Size Id</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Size Name</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Create at</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Updatea at</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($color->count() > 0)
                                        @foreach ($color  as $colornew)
                                        <tr class="table-light">
                                           
                                            <td>{{ $colornew->id}}</td>
                                            <td>{{ $colornew->color_name}}</td>
                                            <td>{{ $colornew->created_at}}</td>
                                            <td>{{ $colornew->updated_at }}</td>
                                            
                                            <td>
                                               <a href="" title="Edit">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>
                                                 {{-- <form action="{{ route('admin.color.delete', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
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
                                            <td class="text-center" colspan="5">Sizes is Empty</td>
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
            <li><a href="{{ $color->previousPageUrl() }}">Previous</a></li>
            @foreach ($color->getUrlRange(1, $color->lastPage()) as $page => $url)
                <li class="{{ $page == $color->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li><a href="{{ $color->nextPageUrl() }}">Next</a></li>
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
   $('#ColorName').change(function() {
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
