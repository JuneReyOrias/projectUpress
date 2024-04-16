@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card shadow">
               
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    
                  <h4 class="mb-3 mb-md-0">UPRESS Services Informaion</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('servicescat.new_servcat') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <tr> <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">image</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Services Id</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Type of Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Sizes</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Units</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Color</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Unit Price</th>
                                     
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Status</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicescat as $services)
                                    <tr class="table-light">
                                        <td>
                                            <img style="height:70px; width:70px;" src="/servicesimages/{{$services->image}}">
                                        </td>
                                        <td>{{ $services->id}}</td>
                                        <td>{{ $services->category }}</td>
                                        <td>{{ $services->type_services }}</td>
                                        <td>{{ $services->size}}</td>
                                        <td>{{ $services->unit}}</td>
                                        <td>{{ $services->color}}</td>
                                        <td>{{ $services->unit_price}}</td>
                                        
                                        <td>{{ $services->status}}</td>
                                        <td>
                                            <a href="{{ route('servicescat.update_services', $services->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('servicescat.delete_services', $services->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
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
        <li><a href="{{$servicescat->previousPageUrl() }}">Previous</a></li>
        @foreach ($servicescat->getUrlRange(1,$servicescat->lastPage()) as $page => $url)
            <li class="{{ $page == $servicescat->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $servicescat->nextPageUrl() }}">Next</a></li>
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
