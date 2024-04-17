@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="title">Stock List</div>
                <!-- Filter dropdown -->
                <div class="row mb-3 justify-content-end">
                    <div class="col-auto">
                        <label for="stockTypeFilter" class="form-label">Filter:</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select form-select-sm" id="stockTypeFilter">
                            <option value="all">All</option>
                            <option value="stock-in">Stock In</option>
                            <option value="stock-out">Stock Out</option>
                        </select>
                    </div>
                </div>

                <!-- Stock list table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Stock ID</th>
                                <th>Product Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="stock-in">
                                <td>1</td>
                                <td>Product A</td>
                                <td>Size M</td>
                                <td>100</td>
                                <td>2024-04-18</td>
                                <td>Stock In</td>
                            </tr>
                            <tr class="stock-out">
                                <td>2</td>
                                <td>Product B</td>
                                <td>Size L</td>
                                <td>50</td>
                                <td>2024-04-17</td>
                                <td>Stock Out</td>
                            </tr>
                            <!-- Additional rows can be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <style>

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
</style> -->

<!-- <div class="page-content">
    

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

<div class="container"> -->
    <!-- <div class="row m-4">
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
 
<br> -->
<!-- <div>
    <ul class="pagination">
        <li><a href="{{ $stockout->previousPageUrl() }}">Previous</a></li>
        @foreach ($stockout->getUrlRange(1, $stockout->lastPage()) as $page => $url)
            <li class="{{ $page == $stockout->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $stockout->nextPageUrl() }}">Next</a></li>
    </ul>
</div> -->


<!--                     
            </div>
        </div>
    </div>
</div>
  </div> -->
<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 -->

<!--   
<script>
  document.addEventListener('DOMContentLoaded', function() {

    const collegeSelect = document.getElementById('college');
    const departmentInputBox = document.getElementById('departmentInputBox');
    const sizeInputBox = document.getElementById('sizeInputBox');

    collegeSelect.addEventListener('change', function() {
   
        const selectedCollege = collegeSelect.value;


        if (selectedCollege === 'add_f') {
            departmentInputBox.style.display = 'block';
            sizeInputBox.style.display = 'block';
        } else {
          
            sizeInputBox.style.display = 'none';
            departmentInputBox.style.display = 'none';
        }
    });
}); -->

<!-- </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
  
      const colorContainer = document.getElementById('colorContainer');
      const addColorBtn = document.getElementById('addColorBtn');


      function addColorInput() {
      
          const newColorGroup = document.createElement('div');
          newColorGroup.className = 'color-group mb-2';

          const colorWrapper = document.createElement('div');
          colorWrapper.className = 'd-flex align-items-center';

          const newColorSelect = document.createElement('select');
          newColorSelect.className = 'form-control';
          newColorSelect.name = 'colors_id[]';
          newColorSelect.innerHTML = document.querySelector('select[name="colors_id[]"]').innerHTML;

   
          const removeBtn = document.createElement('button');
          removeBtn.type = 'button';
          removeBtn.className = 'btn btn-danger remove-color-btn ms-2';
          removeBtn.textContent = 'Remove';

     
          colorWrapper.appendChild(newColorSelect);
          colorWrapper.appendChild(removeBtn);


          newColorGroup.appendChild(colorWrapper);

          colorContainer.appendChild(newColorGroup);

          removeBtn.addEventListener('click', function() {
              colorContainer.removeChild(newColorGroup);
          });
      }


      addColorBtn.addEventListener('click', addColorInput);
  });
</script> -->



<!-- {{-- sizes fuction --}}
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const sizeContainer = document.getElementById('sizeContainer');
    const addSizeBtn = document.getElementById('addSizeBtn');
    const sizes = @json($sizes); 

    function addSizeInput() {
        const newSizeGroup = document.createElement('div');
        newSizeGroup.className = 'size-group d-flex align-items-center mt-2';

    
        const newSizeSelect = document.createElement('select');
        newSizeSelect.name = 'sizes_id[]';
        newSizeSelect.classList.add('form-control');
        newSizeSelect.placeholder = 'Select a size';

       
        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Select a size';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        newSizeSelect.appendChild(defaultOption);

   
        sizes.forEach(size => {
            const option = document.createElement('option');
            option.value = size.id;
            option.textContent = size.name_size;
            newSizeSelect.appendChild(option);
        });

        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.name = 'quantity[]';
        quantityInput.className = 'form-control ms-2';
        quantityInput.placeholder = 'Enter quantity';
        quantityInput.min = 0; 

        // Create the remove button
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-danger remove-size-btn ms-2';
        removeBtn.textContent = 'Remove';

       
        newSizeGroup.appendChild(newSizeSelect);
        newSizeGroup.appendChild(quantityInput);
        newSizeGroup.appendChild(removeBtn);

        sizeContainer.appendChild(newSizeGroup);

        removeBtn.addEventListener('click', function() {
            sizeContainer.removeChild(newSizeGroup);
        });
    }

    addSizeBtn.addEventListener('click', addSizeInput);

    sizeContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-size-btn')) {
            const sizeGroup = event.target.closest('.size-group');
            sizeContainer.removeChild(sizeGroup);
        }
    });
}); -->

      <!-- </script> -->
@endsection
