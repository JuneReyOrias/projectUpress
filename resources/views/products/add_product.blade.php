@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')

<div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card border rounded">
                    @if (session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h4 class="mb-2">UPRESS Product Information</h4>
                        <div class="d-flex justify-content-end mb-4">
                            <!-- <a href="{{ route('products.index') }}" class="btn btn-success me-2">Add</a> -->
                            <!-- create link for add modal -->
                            <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                Add Product
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <!-- <th>Unit Price</th> -->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product as $products)
                                        <tr>
                                            <td>
                                                <img src="/productimages/{{ $products->image }}" alt="Product Image" class="img-thumbnail" style="width: 50px;">
                                            </td>
                                            <td>{{ $products->id }}</td>
                                            <td>{{ $products->product_name }}</td>
                                            <td>{{ $products->description }}</td>
                                            <!-- <td>{{ $products->unit_price }}</td> -->
                                            <td>{{ $products->status }}</td>
                                            <td>
                                                <!-- <a href="{{ route('products.update_product', $products->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a> -->
                                                <!-- Button to trigger Edit Product Modal -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <form action="{{ route('product.destroy', $products->id) }}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Confirm delete?')">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No products found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <nav aria-label="Product Pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item {{ $product->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $product->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @foreach ($product->getUrlRange(1, $product->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $product->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                <li class="page-item {{ !$product->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $product->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: white; color: black;">
            <form action="#" method="post">
                @csrf
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_name" class="form-label text-black">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-black">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="unit_price" class="form-label text-black">Unit Price</label>
                        <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" required>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form> 
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_product_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit_product_name" name="edit_product_name" value="{{ $products->product_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="edit_description" rows="3" required>{{ $products->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_unit_price" class="form-label">Unit Price</label>
                        <input type="number" step="0.01" class="form-control" id="edit_unit_price" name="edit_unit_price" value="{{ $products->unit_price }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


<!-- <div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card border rounded">
                @if (session()->has('message'))
                <div class="alert alert-success" id="success-alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="card-body">

                    
                  <h4 class="mb-3 mb-md-0"> UPRESS Product Information</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('products.index') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" >
                            <table class="table bordered datatable" cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Image</th>
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Id</th>
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Name</th>
                                      
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Description</th>
                                        
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Unit Price</th>
                                  
                                       
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Status</th>
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @if($product->count() > 0)
                                    @foreach ($product as $products)
                                    <tr class="table-light">
                                      
                                        
                                        <td>
                                            <img style="height:70px; width:70px;" src="/productimages/{{$products->image}}">
                                        </td>
                                        <td>{{ $products->id}}</td>
                                        <td>{{ $products->product_name }}</td>
                                        
                                        <td>{{ $products->descritpion }}</td>
                                        <td>{{ $products->unit_price}}</td>
                                
                                       
                                        <td>{{ $products->status}}</td>
                                        <td>
                                            <a href="{{ route('products.update_product', $products->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('product.destroy', $products->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="5">Product not found</td>
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
                    <li><a href="{{$product->previousPageUrl() }}">Previous</a></li>
                    @foreach ($product->getUrlRange(1,$product->lastPage()) as $page => $url)
                        <li class="{{ $page == $product->currentPage() ? 'active' : '' }}">
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li><a href="{{ $product->nextPageUrl() }}">Next</a></li>
                </ul>
            </div>

            </div>
        </div>
    </div>
</div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    $(document).ready(function() {
        $("#success-alert").hide();
        $("#myWish").click(function showAlert() {
            $("#success-alert").alert();
            window.setTimeout(function() {
                $("#success-alert").alert('close');
            }, 2000);
        });
    });



    $("li").click(function () {
  $(this).addClass("active").siblings().removeClass("active");
});
</script> -->

