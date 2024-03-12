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
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    
                  <h4 class="mb-3 mb-md-0">I. Customer Accounts Info</h4>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.accounts.add_new_acc') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div>
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-info" style="background-color: #ffffff;">
                                <thead class="thead-light">
                                    <tr>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Users Id</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">UserName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">FirstName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">LastName</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">College</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Department</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">email</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">contact_no</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Password</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Image</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Role</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Password</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts->where('role','customer')  as $product)
                                    <tr class="table-light">
                                        <td>{{ $product->cust_code.'-'.$product->id}}</td>
                                        <td>{{ $product->username}}</td>
                                        <td>{{ $product->firstname}}</td>
                                        <td>{{ $product->lastname}}</td>
                                        <td>{{ $product->college }}</td>
                                        <td>{{ $product->department}}</td>
                                        <td>{{ $product->email}}</td>
                                        <td>{{ $product->contact}}</td>
                                        <td>{{ $product->password}}</td>
                                        <td>
                                            <img style="height:100px; width:100px;" src="/productimages/{{ $product->image }}">
                                        </td>
                                        <td>{{ $product->role}}</td>
                                        <td>{{ $product->status}}</td>
                                       
                                        
                                        <td>
                                            <a href="{{ route('admin.accounts.update_acc', $product->id) }}" title="Edit">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <form action="{{ route('admin.accounts.delete', $product->id) }}" method="post" accept-charset="UTF-8" style="display:inline">
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
        <li><a href="{{ $accounts->previousPageUrl() }}">Previous</a></li>
        @foreach ($accounts->getUrlRange(1, $accounts->lastPage()) as $page => $url)
            <li class="{{ $page == $accounts->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $accounts->nextPageUrl() }}">Next</a></li>
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
