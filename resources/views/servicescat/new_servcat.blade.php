<!-- not kasama -->
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
                  

                  <h4 class="mb-3 mb-md-0">Create New Services</h4>
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
                              <option value="Add_new">add</option>
                          </select>
                          @error('category')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      
                      <div id="additionalField"class="input-box" style="display: none;">
                          <div class="input-box"id="additionalField">
                              <span class="details">Add New:</span>
                              <input type="text" class="form-control" name="additional_info"placeholder="Enter services" id="additional_info">
                          </div>
                      </div>
                      
                      <div id="ServicesField"class="input-box" style="display: none;">
                        <div class="input-box"id="additionalField">
                            <span class="details">Type Services:</span>
                            <input type="text" class="form-control" name="type_services"placeholder="Enter type services" id="type_services">
                        </div>
                    </div>
                
                    <!-- Subcategory dropdowns -->
                    <div class="input-box" id="printingSubCategoryBox" style="display: none;">
                        <span class="details">Printing/Photocopy Subcategories:</span>
                        <select class="form-select" id="printingSubCategory" name="type_services">
                          <option selected disabled>Select</option>
                            <option value="Black and White">Black and White</option>
                            <option value="Color Printing">Color Printing</option>
                            <option value="Large Format">Large Format</option>
                            <option value="Document Photocopy">Document Photocopy</option>
                            <option value="add_new_printing">add</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    {{-- add new printing --}}
                    <div id="printingField"class="input-box" style="display: none;">
                      <div class="input-box"id="printingField">
                          <span class="details">Add New:</span>
                          <input type="text" class="form-control" name="printing_info" id="printing_info">
                      </div>
                  </div>
                
                    <div class="input-box" id="layoutSubCategoryBox" style="display: none;">
                        <span class="details">Layout Subcategories:</span>
                        <select class="form-select" id="layoutSubCategory" name="type_services">
                          <option selected disabled>Select</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Page Layout">Page Layout</option>
                            <option value="Poster Design">Poster Design</option>
                            <option value="add_new_layout">add</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                {{-- add new layout --}}
                <div id="layoutField"class="input-box" style="display: none;">
                  <div class="input-box"id="layoutField">
                      <span class="details">Add New:</span>
                      <input type="text" class="form-control" name="layout_info" id="layout_info">
                  </div>
              </div>
            

                    <div class="input-box" id="laminationSubCategoryBox" style="display: none;">
                        <span class="details">Lamination Subcategories:</span>
                        <select class="form-select" id="laminationSubCategory" name="laminationSubCategory">
                          <option selected disabled>Select</option>
                            <option value="Gloss Lamination">Gloss Lamination</option>
                            <option value="Matte Lamination">Matte Lamination</option>
                            <option value="Cold Lamination">Cold Lamination</option>
                            <option value="add_new_Lamination">add</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                                {{-- add new lamination --}}
                                <div id="laminationField"class="input-box" style="display: none;">
                                  <div class="input-box"id="laminationField">
                                      <span class="details">Add New:</span>
                                      <input type="text" class="form-control" name="lamination_info" id="lamination_info">
                                  </div>
                              </div>
                    <div class="input-box" id="bindingSubCategoryBox" style="display: none;">
                        <span class="details">Binding Subcategories:</span>
                        <select class="form-select" id="bindingSubCategory" name="bindingSubCategory">
                          <option selected disabled>Select</option>
                            <option value="Spiral Binding">Spiral Binding</option>
                            <option value="Hardcover Binding">Hardcover Binding</option>
                            <option value="Thermal Binding">Thermal Binding</option>
                            <option value="add_new_Binding">add</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                       {{-- add new binding --}}
                       <div id="bindingField"class="input-box" style="display: none;">
                        <div class="input-box"id="bindingField">
                            <span class="details">Add New:</span>
                            <input type="text" class="form-control" name="binding_info" id="binding_info">
                        </div>
                    </div>
                      {{-- <div class="input-box">
                        <span class="details">Type Services:</span>
                        <input type="text" class="form-control @error('type_services') is-invalid @enderror" name="type_services" placeholder="Enter offer services"value="{{ old('type_services') }}" >
                        @error('type_services')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                      </div> --}}
                            <div class="input-box">
                              <span class="details">Description:</span>
                              <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter descripion"value="{{ old('description') }}" >
                              @error('description')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                            </div>
                            <div class="input-box">
                              <span class="details">Sizes:</span>
                              <select class="form-select @error('category') is-invalid @enderror" name="size" id="size" aria-label="Floating label select e">
                                  <option selected disabled>Select</option>
                                  <option value="Long" {{ old('size') == 'Long' ? 'selected' : '' }}>Long</option>
                                  <option value="Short" {{ old('size') == 'Short' ? 'selected' : '' }}>Short</option>
                                  <option value="Letter" {{ old('size') == 'Letter' ? 'selected' : '' }}>Letter</option>
                                
                                  <option value="Add_new_size">add</option>
                              </select>
                              @error('size')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                           {{-- add new size --}}
                       <div id="sizeField"class="input-box" style="display: none;">
                        <div class="input-box"id="sizeField">
                            <span class="details">Add New:</span>
                            <input type="text" class="form-control" name="size_info" id="size_info">
                        </div>
                    </div>
                          <div class="input-box">
                            <span class="details">Quantity:</span>
                            <input type="number" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Enter quantity" value="{{ old('unit') }}" step="0.01">
                            @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-box">
                          <span class="details">Color:</span>
                          <select class="form-select @error('category') is-invalid @enderror" name="color" id="colors" aria-label="Floating label select e">
                              <option selected disabled>Select</option>
                              <option value="Black and White" {{ old('color') == 'Black and White' ? 'selected' : '' }}>Black and White</option>
                              <option value="Colored" {{ old('color') == 'Colored' ? 'selected' : '' }}>Colored</option>
                             
                              <option value="add_new_colors">add</option>
                          </select>
                          @error('color')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>

                       {{-- add new size --}}
                       <div id="colorField"class="input-box" style="display: none;">
                        <div class="input-box"id="colorField">
                            <span class="details">Add New:</span>
                            <input type="text" class="form-control" name="color_info" id="color_info">
                        </div>
                    </div>
                      <div class="input-box">
                        <span class="details">Unit Price:</span>
                        <input type="number" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror" placeholder="Enter unit price" value="{{ old('unit_price') }}" step="0.01" min="0">
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
    document.querySelector('#category').addEventListener('change', function() {
        var selectedValue = this.value;
        var additionalField = document.querySelector('#additionalField');
        var ServicesField = document.querySelector('#ServicesField');
        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'Add_new') {
            additionalField.style.display = 'block';
            ServicesField.style.display = 'block';
        } else {
            // If any other option is selected, hide the additional input field
            additionalField.style.display = 'none';
            ServicesField.style.display = 'none';
        }
    });

    // pptinting
    document.querySelector('#printingSubCategory').addEventListener('change', function() {
        var selectedValue = this.value;
        var printingField = document.querySelector('#printingField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'add_new_printing') {
            printingField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            printingField.style.display = 'none';
        }
    });

// add new layout
document.querySelector('#layoutSubCategory').addEventListener('change', function() {
        var selectedValue = this.value;
        var layoutField = document.querySelector('#layoutField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'add_new_layout') {
            layoutField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            layoutField.style.display = 'none';
        }
    });
   
// add new lamination
document.querySelector('#laminationSubCategory').addEventListener('change', function() {
        var selectedValue = this.value;
        var layoutField = document.querySelector('#laminationField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'add_new_Lamination') {
            layoutField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            layoutField.style.display = 'none';
        }
    });
        
        // add new lamination
document.querySelector('#bindingSubCategory').addEventListener('change', function() {
        var selectedValue = this.value;
        var layoutField = document.querySelector('#bindingField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'add_new_Binding') {
            layoutField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            layoutField.style.display = 'none';
        }
    });

   
    // add new size
    document.querySelector('#size').addEventListener('change', function() {
        var selectedValue = this.value;
        var layoutField = document.querySelector('#sizeField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'Add_new_size') {
            layoutField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            layoutField.style.display = 'none';
        }
    });


    // Add_new_color
    document.querySelector('#colors').addEventListener('change', function() {
        var selectedValue = this.value;
        var layoutField = document.querySelector('#colorField');

        // If "Not Applicable" is selected, show the additional input field
        if (selectedValue === 'add_new_colors') {
            layoutField.style.display = 'block';
        } else {  
            // If any other option is selected, hide the additional input field
            layoutField.style.display = 'none';
        }
    });
</script>

<script>
  const categorySelect = document.getElementById('category');
  const printingSubCategoryBox = document.getElementById('printingSubCategoryBox');
  const layoutSubCategoryBox = document.getElementById('layoutSubCategoryBox');
  const laminationSubCategoryBox = document.getElementById('laminationSubCategoryBox');
  const bindingSubCategoryBox = document.getElementById('bindingSubCategoryBox');

  // Function to handle category changes
  function handleCategoryChange() {
      const selectedCategory = categorySelect.value;

      // Hide all subcategory boxes initially
      printingSubCategoryBox.style.display = 'none';
      layoutSubCategoryBox.style.display = 'none';
      laminationSubCategoryBox.style.display = 'none';
      bindingSubCategoryBox.style.display = 'none';

      // Display the appropriate subcategory dropdown based on the selected category
      if (selectedCategory === 'Printing/Photocopy') {
          printingSubCategoryBox.style.display = 'block';
      } else if (selectedCategory === 'Layout') {
          layoutSubCategoryBox.style.display = 'block';
      } else if (selectedCategory === 'Lamination') {
          laminationSubCategoryBox.style.display = 'block';
      } else if (selectedCategory === 'Binding') {
          bindingSubCategoryBox.style.display = 'block';
      }
  }

  // Listen for changes to the category select element
  categorySelect.addEventListener('change', handleCategoryChange);
</script>

<!-- Optional: Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  @endsection