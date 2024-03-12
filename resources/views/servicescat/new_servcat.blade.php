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
                  

                  <h4 class="mb-3 mb-md-0">Welcome Back! Create New Services</h4>
                </div>
                <div class="container">
                  <div class="title">New Services</div>
                  <div class="content">
                    <form action{{url('Newstore')}} method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="user-details">
                      

                        <div class="input-box">
                          <span class="details">Offer Services:</span>
                          <select class="form-select @error('category') is-invalid @enderror" name="category" id="category" aria-label="Floating label select e">
                              <option selected disabled>Select</option>
                              <option value="Printing/Photocopy" {{ old('category') == 'Printing/Photocopy' ? 'selected' : '' }}>Printing/Photocopy</option>
                              <option value="Layout" {{ old('category') == 'Layout' ? 'selected' : '' }}>Layout</option>
                              <option value="Lamination" {{ old('category') == 'Lamination' ? 'selected' : '' }}>Lamination</option>
                              <option value="Binding" {{ old('category') == 'Binding' ? 'selected' : '' }}>Binding</option>
                              <option value="Not Applicable">add</option>
                          </select>
                          @error('category')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <div id="additionalField"class="input-box" style="display: none;">
                          <div class="input-box"id="additionalField">
                              <span class="details">Additional Information:</span>
                              <input type="text" class="form-control" name="additional_info" id="additional_info">
                          </div>
                      </div>
                      <div class="input-box">
                        <span class="details">Type Services:</span>
                        <input type="text" class="form-control @error('type_services') is-invalid @enderror" name="type_services" placeholder="Enter offer services"value="{{ old('type_services') }}" >
                        @error('type_services')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div>
                            <div class="input-box">
                              <span class="details">Description:</span>
                              <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter descripion"value="{{ old('description') }}" >
                              @error('description')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                            </div>
                            
                              <div class="input-box">
                                <span class="details">Sizes:</span>
                                <input type="text" class="form-control @error('size') is-invalid @enderror" name="size" placeholder="Enter sizes"value="{{ old('size') }}" >
                                @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                              </div>
                        <div class="input-box">
                          <span class="details">Unit:</span>
                          <input type="text"name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Enter unit" value="{{ old('unit') }}" >
                          @error('unit')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Color:</span>
                          <input type="text"name="color" class="form-control @error('color') is-invalid @enderror" placeholder="Enter color" value="{{ old('color') }}" >
                          @error('color')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Unit Price:</span>
                          <input type="text"name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" placeholder="Enter unit price"value="{{ old('unit_price') }}"  >
                          @error('unit_price')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        {{-- <div class="input-box">
                          <span class="details">Product Stock</span>
                          <input type="text"name="stocks" class="form-control @error('stocks') is-invalid @enderror" placeholder="Enter product stocks"id="stocks" autocomplete="current-password" value="{{ old('stocks') }}" >
                          @error('stocks')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div> --}}

                        <div class="input-box">
                          <span class="details">Status</span>
                          <select class="form-select  @error('status') is-invalid @enderror" name="status"id="validationCustom01" aria-label="Floating label select e">
                            <option selected disabled >Select status</option>
                            <option value="Available" {{ old('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Not available" {{ old('status') == 'Not available' ? 'selected' : '' }}>Not available</option>
                          
                          </select>
                          @error('status')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Services Code</span>
                          <input type="text"name="serv_code" class="form-control @error('serv_code') is-invalid @enderror" placeholder="Enter services code"  value="{{ old('serv_code') }}">
                          @error('serv_code')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Service Image</span>
                          <div class="input-group">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"name="image" accept=".png, .jpeg, .jpg">
                              <label class="custom-file-label" for="inputGroupFile01" style="color: white;">Choose file</label>
                          </div>
                          @error('unit_price')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      </div>
                 
                      <div class="button d-flex justify-content-end"> <!-- Use d-flex and justify-content-end to align the button to the end -->
                        <input type="submit" class="register-button" value="Add">
                    </div>
                    
                      <a  href="{{route('servicescat.add_services')}}"button  class="btn btn-success ">Back</button></a></p>
                    </form>
                  </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  
   
  
  
  </div>
  <script>
    document.querySelector('#type_services').addEventListener('change', function() {
        var selectedValue = this.value;
        var additionalField = document.querySelector('#additionalField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'Not Applicable') {
            additionalField.style.display = 'block';
        } else {
            // If any other option is selected, hide the additional input field
            additionalField.style.display = 'none';
        }
    });
</script>
  @endsection