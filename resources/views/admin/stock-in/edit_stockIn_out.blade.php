@extends('admin.dashb')

@section('admin')

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
                  

                </div>
                <div class="container">
                  <div class="title">Stocks</div>
                  <div class="content">
                    <form action{{ url('AddNewSize') }} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                       
                        
                        <div class="input-box">
                          <span class="details">Product Sizes and Quantities:</span>
                          <div id="sizeContainer">
                              <!-- Initial size and quantity field -->
                              <div class="size-group d-flex align-items-center mt-2">
                                   
                                  <select name="sizes_id" class="form-control" placeholder="Select size">
                                     
                                     
                                          <option value="{{ $editstock->sizes_id }}">{{ $editstock->sizes->name_size }}</option>
                                    
                                  </select>
                                  <input type="number" name="quantity[]" id="availableQuantity" class="form-control ms-2" value="{{ $editstock->quantity }}" value="0" min="0">
                                  <input type="hidden" name="product_id" class="form-control ms-2" value={{ $editstock->product_id }} placeholder="Enter quantity" min="0">
                                  {{-- <button type="button" class="btn btn-danger remove-size-btn ms-2">Remove</button> --}}
                              </div>
                          </div>
                          {{-- <button type="button" id="addSizeBtn" class="btn btn-primary mt-2">Add Size and Quantity</button> --}}
                      </div>
                  
                      <div class="input-box">
                        <span class="details">Customer Name:</span>
                        <select class="form-select @error('users_id') is-invalid @enderror" name="users_id"  aria-label="Floating label select e">
                            
                            @foreach ($customer->where('role','customer') as $users )
                                
                            <option value="{{ $users->id }}">{{ $users->lastname }}</option>
                            @endforeach
                           
                           
                        </select>
                        @error('name_size')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                        <!-- Additional input box for new college -->
                        <div class="input-box">
                            <span class="details">StockOut qty:</span>
                            <input type="number" class="form-control" name="quantities" id="stockOutQuantity" value="0" min="0">

                        </div>
                      
                 
                                      
                      
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Add">
                    </div>
                    
                      {{-- <a href="{{ route('admin.accounts.view_users_acc') }}" class="btn btn-success ">Back</a> --}}
                    </form>
                  </div>
                  <a  href="{{route('admin.stock-in.add_stock_in_out')}}"button  class="btn btn-success ">Back</button></a></p>
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
   $('#SizeName').change(function() {
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



<script>
    // JavaScript to handle stockout quantity changes and update available quantity
    document.addEventListener("DOMContentLoaded", function() {
        const availableQuantityInput = document.getElementById("availableQuantity");
        const stockOutQuantityInput = document.getElementById("stockOutQuantity");

        // Function to handle changes in stockout quantity
        function handleStockOutChange() {
            // Get current values from the input fields
            let availableQuantity = parseInt(availableQuantityInput.value);
            let stockOutQuantity = parseInt(stockOutQuantityInput.value);

            // Calculate the new available quantity
            let newAvailableQuantity = availableQuantity - stockOutQuantity;

            // If the stockout quantity exceeds available quantity, handle it
            if (newAvailableQuantity < 0) {
                alert("StockOut quantity exceeds available quantity. Adjusting to available quantity.");
                stockOutQuantityInput.value = availableQuantity;
                newAvailableQuantity = 0;
            }

            // Update the available quantity input field
            availableQuantityInput.value = newAvailableQuantity;
        }

        // Attach event listener to stockout quantity input field
        stockOutQuantityInput.addEventListener("input", handleStockOutChange);
    });
</script>
@endsection
