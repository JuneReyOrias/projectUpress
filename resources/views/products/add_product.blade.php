@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
<div class="page-content">
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
</script>
@endsection
