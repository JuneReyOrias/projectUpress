@extends('admin.dashb')

@section('admin')

<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card shadow">
               
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                    
                  <h4 class="mb-3 mb-md-0">I. UPRESS Product Informaion</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{route('products.index')}}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-info" style="background-color: #ffffff;">
                                <thead class="thead-light">
                                    <tr>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Id</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Name</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Size</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Color</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Description</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Unit Price</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Stocks</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Image</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Status</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $product)
                                    <tr class="table-light">
                                        <td>{{ $product->prod_code.'-'.$product->id}}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->size}}</td>
                                        <td>{{ $product->color }}</td>
                                        <td>{{ $product->descritpion }}</td>
                                        <td>{{ $product->unit_price}}</td>
                                        <td>{{ $product->stocks}}</td>
                                        <td>
                                            <img style="height:100px; width:100px;" src="/productimages/{{$product->image}}">
                                        </td>
                                        <td>{{ $product->status}}</td>
                                        <td>
                                            <a href="{{ route('products.update_product', $product->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
</script>
@endsection
