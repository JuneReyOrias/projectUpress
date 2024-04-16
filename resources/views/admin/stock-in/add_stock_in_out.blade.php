@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
<style>
    /* Your CSS styling */
    .pagination {
        text-align: center;
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
        padding: 5px 10px;
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

    .pagination > li:first-child > a,
    .pagination > li:last-child > a {
        font-size: 14px;
    }
</style>

<div class="page-content">
    

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
                        
                        <div class="title">Stock-In History</div>
                       
                        <br>
                        <div>
                          
                            <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                                <table class="table bordered datatable" style="background-color: #ffffff;">
                                    <thead class="thead-light">
                                        <tr>
                                         
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">StockId</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Name</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Size Name</th>
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Quantity</th>
                                         
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">DATE</th>
                                   
                                          <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($stockin->count() > 0)
                                        @foreach ($stockin  as $stock)
                                        <tr class="table-light">
                                           
                                            <td>{{ $stock->id}}</td>
                                            <td>{{ $stock->product->product_name}}</td>
                                         
                                            <td>{{ $stock->sizes->name_size}}</td>
                                            <td>{{ $stock->quantity}}</td>
                                           
                                            <td>{{ $stock->created_at->format('m-d-Y')}}</td>
                                            
                                            
                                            <td>
                                                <a href="{{ route('admin.stock-in.edit_stockIn_out', $stock->id) }}" title="StockOut">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> StockOut
                                                    </button>
                                                </a>
                                                {{-- <form action="{{ route('admin.stockin.delete', $stock->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
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
                                            <td class="text-center" colspan="5">Stock In/Out is Empty</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        
                        <style>
                         /* CSS to center the container */

    
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
    
    <br>
    <div>
        <ul class="pagination">
            <li><a href="{{ $stockin->previousPageUrl() }}">Previous</a></li>
            @foreach ($stockin->getUrlRange(1, $stockin->lastPage()) as $page => $url)
                <li class="{{ $page == $stockin->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li><a href="{{ $stockin->nextPageUrl() }}">Next</a></li>
        </ul>
    </div>
    
    
                        
                </div>
            </div>
        </div>
   

      <br><br>

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
                    
                    <div class="title">Stock-out History</div>
                   
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table bordered dataTable" style="background-color: #ffffff;">
                                <thead class="thead-light">
                                    <tr>
                                     
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">StockId</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Name</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Size Name</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Quantity</th>
                                     
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">DATE</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Customer</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($stockout->count() > 0)
                                    @foreach ($stockout  as $stock)
                                    <tr class="table-light">
                                       
                                        <td>{{ $stock->id}}</td>
                                        <td>{{ $stock->productstockout->product_name}}</td>
                                     
                                        <td>{{ $stock->sizestockout->name_size}}</td>
                                        <td>{{ $stock->quantities}}</td>
                                       
                                        <td>{{ $stock->created_at->format('m-d-Y')}}</td>
                                        <td>{{ $stock->userstockout->firstname.' '.$stock->userstockout->lastname}}</td>
                                        {{-- <td>{{ $stock->stock_type}}</td> --}}
                                        
                                        {{-- <td> --}}
                                            {{-- <a href="{{ route('admin.stock-in.edit_stockIn_out', $stock->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a> --}}
                                            {{-- <form action="{{ route('admin.stockout.delete', $stock->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form> --}}
                                        {{-- </td> --}}
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="5">Stock In/Out is Empty</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                    <style>
                     /* CSS to center the container */


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

<br>
<div>
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
<!-- Include jQuery at the beginning of the HTML page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get references to the dropdown and the department input box
    const collegeSelect = document.getElementById('college');
    const departmentInputBox = document.getElementById('departmentInputBox');
    const sizeInputBox = document.getElementById('sizeInputBox');
    // Add an event listener for when the dropdown selection changes
    collegeSelect.addEventListener('change', function() {
        // Get the selected value
        const selectedCollege = collegeSelect.value;

        // If the "add_new" option is selected, show the department input box
        if (selectedCollege === 'add_f') {
            departmentInputBox.style.display = 'block';
            sizeInputBox.style.display = 'block';
        } else {
            // Hide the department input box
            sizeInputBox.style.display = 'none';
            departmentInputBox.style.display = 'none';
        }
    });
});

</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Get the color container and add color button
      const colorContainer = document.getElementById('colorContainer');
      const addColorBtn = document.getElementById('addColorBtn');

      // Function to add a new color input field
      function addColorInput() {
          // Create a new color group
          const newColorGroup = document.createElement('div');
          newColorGroup.className = 'color-group mb-2';

          // Create a wrapper div
          const colorWrapper = document.createElement('div');
          colorWrapper.className = 'd-flex align-items-center';

          // Create a new select element for color choices
          const newColorSelect = document.createElement('select');
          newColorSelect.className = 'form-control';
          newColorSelect.name = 'colors_id[]';
          newColorSelect.innerHTML = document.querySelector('select[name="colors_id[]"]').innerHTML;

          // Create a remove button
          const removeBtn = document.createElement('button');
          removeBtn.type = 'button';
          removeBtn.className = 'btn btn-danger remove-color-btn ms-2';
          removeBtn.textContent = 'Remove';

          // Append the select element and remove button to the wrapper div
          colorWrapper.appendChild(newColorSelect);
          colorWrapper.appendChild(removeBtn);

          // Append the wrapper div to the new color group
          newColorGroup.appendChild(colorWrapper);

          // Append the new color group to the color container
          colorContainer.appendChild(newColorGroup);

          // Add click event listener to remove the color group
          removeBtn.addEventListener('click', function() {
              colorContainer.removeChild(newColorGroup);
          });
      }

      // Add click event listener to the "Add More" button
      addColorBtn.addEventListener('click', addColorInput);
  });
</script>



{{-- sizes fuction --}}
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const sizeContainer = document.getElementById('sizeContainer');
    const addSizeBtn = document.getElementById('addSizeBtn');
    const sizes = @json($sizes);  // Assuming the $sizes array is provided as JSON data.

    // Function to add a new size and quantity input group
    function addSizeInput() {
        const newSizeGroup = document.createElement('div');
        newSizeGroup.className = 'size-group d-flex align-items-center mt-2';

        // Create a new size select element
        const newSizeSelect = document.createElement('select');
        newSizeSelect.name = 'sizes_id[]';
        newSizeSelect.classList.add('form-control');
        newSizeSelect.placeholder = 'Select a size';

        // Create and append a disabled "Select a size" option
        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Select a size';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        newSizeSelect.appendChild(defaultOption);

        // Populate the size select element with options from the sizes data
        sizes.forEach(size => {
            const option = document.createElement('option');
            option.value = size.id;
            option.textContent = size.name_size;
            newSizeSelect.appendChild(option);
        });

        // Create a quantity input field
        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.name = 'quantity[]';
        quantityInput.className = 'form-control ms-2';
        quantityInput.placeholder = 'Enter quantity';
        quantityInput.min = 0; // Ensure a non-negative quantity

        // Create the remove button
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger remove-size-btn ms-2';
        removeBtn.textContent = 'Remove';

        // Append the size select element, quantity input field, and remove button to the new size group
        newSizeGroup.appendChild(newSizeSelect);
        newSizeGroup.appendChild(quantityInput);
        newSizeGroup.appendChild(removeBtn);

        // Append the new size group to the size container
        sizeContainer.appendChild(newSizeGroup);

        // Add a click event listener to the remove button
        removeBtn.addEventListener('click', function() {
            sizeContainer.removeChild(newSizeGroup);
        });
    }

    // Add a click event listener to the "Add Size and Quantity" button
    addSizeBtn.addEventListener('click', addSizeInput);

    // Attach event listener for removing size groups to the size container
    sizeContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-size-btn')) {
            const sizeGroup = event.target.closest('.size-group');
            sizeContainer.removeChild(sizeGroup);
        }
    });
});

      </script>
@endsection
