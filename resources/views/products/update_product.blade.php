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
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Update Product</h4>
                </div>
                <div class="container">
                  <div class="title">New Product</div>
                  <div class="content">
                    <form action{{url('productupdate')}} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                        <div class="input-box">
                          <span class="details">Product Name:</span>
                          <input type="text" class="form-control @error('product_name') is-invalid @enderror"value="{{$product->product_name}}" name="product_name" placeholder="Enter product name"value="{{ old('product_name') }}" >
                          @error('product_name')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Description:</span>
                          <input type="text"name="descritpion" class="form-control @error('descritpion') is-invalid @enderror"value="{{$product->descritpion}}" placeholder="Enter description" value="{{ old('descritpion') }}" >
                          @error('descritpion')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Unit Price:</span>
                          <input type="text"name="unit_price" class="form-control @error('unit_price') is-invalid @enderror"value="{{number_format($product->unit_price,2)}}"  placeholder="Enter unit price"value="{{ old('unit_price') }}"  >
                          @error('unit_price')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Product Stock</span>
                          <input type="text"name="stocks" class="form-control @error('stocks') is-invalid @enderror"value="{{$product->stocks}}"  placeholder="Enter product stocks"id="stocks" autocomplete="current-password" value="{{ old('stocks') }}" >
                          @error('stocks')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>

                        <div class="input-box">
                          <span class="details">Status</span>
                          <select class="form-select  @error('status') is-invalid @enderror"  name="status"id="validationCustom01" aria-label="Floating label select e">
                            <option value="{{$product->status}}" >{{$product->status}}</option>
                            <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Not available" {{ old('status') == 'Not available' ? 'selected' : '' }}>Not available</option>
                          
                          </select>
                          @error('status')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Product Code</span>
                          <input type="text"name="prod_code" class="form-control @error('prod_code') is-invalid @enderror"value="{{$product->prod_code}}" placeholder="Enter product code"  value="{{ old('prod_code') }}">
                          @error('prod_code')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Product Image</span>
                          <div class="input-group">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"name="image" accept=".png, .jpeg, .jpg">
                              <label class="custom-file-label" for="inputGroupFile01" style="color: white;">Choose file</label>
                          </div>
                          @error('unit_price')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="input-box">
                        <span class="details">Product Image</span>
                        <div>
                            <img  id="showImage" src="/productimages/{{$product->image}}" alt="Product Image">
                        </div>
                    </div>
                      </div>
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Add">
                    </div>
                    
                      <a  href="{{route('products.add_product')}}"button  class="btn btn-success ">Back</button></a></p>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  <script>
    // Get references to the input fields
    const no_of_ha = document.getElementById('no_of_ha');
    const cost_per_ha = document.getElementById('cost_per_ha');
    const total_amount = document.getElementById('total_amount');
   
    
    // Function to calculate and display the total cost
    function calculateTotalCost() {
        const nooFhas = parseFloat(no_of_ha.value) || 0;
        const costPerHAS= parseFloat(cost_per_ha.value) || 0;
      
       
    
        const totalCost = nooFhas * costPerHAS
    
        // Display the total cost in the total cost input field
        totalCostInput.value = totalCost.toFixed(2); // You can adjust the number of decimal places as needed
    }
    
    // Calculate the total cost whenever any of the input fields change
    no_of_ha.addEventListener('input', calculateTotalCost);
    cost_per_ha.addEventListener('input', calculateTotalCost);
  
   
    
    // Initial calculation when the page loads
    calculateTotalCost();
    </script>
  @endsection