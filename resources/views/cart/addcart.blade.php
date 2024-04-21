@extends('customer.customer_dashboard')

@section('customer')

<div class="page-content">
    <nav class="page-breadcrumb">
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                @if($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session()->has('message'))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('products.index') }}" class="btn btn-success me-md-2">Add</a>
                    </div>
                    <br>

                    <div>
                        <h6 class="card-title"><span>I.</span> Cart</h6>
                    </div>

                    <div class="table-responsive tab">
                        <table class="table table-info">
                            <thead class="thead-light">
                                <tr>
                                    <th style="padding:20px">Product Id</th>
                                    <th style="padding:20px">Product Name</th>
                                    <th style="padding:20px">Description</th>
                                    <th style="padding:20px">Unit Price</th>
                                    <th style="padding:20px">Stocks</th>
                                    <th style="padding:20px">Image</th>
                                    <th style="padding:20px">Status</th>
                                    <th style="padding:20px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 
                                @foreach ($product as $product)
                                    <tr class="table-light">
                                        <td>{{ $product->unique_code_id.'-'.$product->id}}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->unit_price }}</td>
                                        <td>{{ $product->stocks }}</td>
                                        <td>
                                            <img style="height:100px; width:100px;" src="/productimages/{{ $product->image }}">
                                        </td>
                                        <td>{{ $product->status }}</td>
                                        <td>
                                            <a href="{{ route('products.update_product', $product->id) }}" title="Edit Product">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a> 
                                            <form action="{{ route('product.destroy', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach 
                                --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
  $(document).ready (function(){
    $("#success-alert").hide();
    $("#myWish").click(function showAlert() {
      $("#success-alert").alert();
      window.setTimeout(function () { 
          $("#success-alert").alert('close'); 
      }, 2000);             
      });      
  });
</script>


@endsection
