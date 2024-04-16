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
                    
                  <h4 class="mb-3 mb-md-0">Track Customer Orders</h4>
                    {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.accounts.add_new_acc') }}" button type="submit" class="btn btn-success me-md-2">Add</button></a>
                    </div> --}}
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">TrackNo</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Customer</th>
                                     
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Order Date</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Payment OR</th> 
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Order Status    </th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    // Group orders by track number
                                    $groupedOrders = $trackcustomer->groupBy('trackno');
                                @endphp
                                
                                @foreach ($groupedOrders as $trackNo => $orders)
                                    @php
                                        // Get the first order associated with the track number
                                        $orders = $orders->first();
                                    @endphp
                                    <tr class="table-light">
                                        <td>{{$orders->trackno}}</td>
                                        <td>{{ $orders->usersName->firstname.' '. $orders->usersName->lastname}}</td>
                                         <td>{{ $orders->created_at->format('Y-m-d H:i:s') }}</td> 
                                         {{-- <td>
                                            @if ($orders->image)
                                                <img style="height:70px; width:70px;" src="/receiptimages/{{ $orders->image }}">
                                                <span>Payment accepted</span>
                                            @else
                                                <span>Order not yet confirmed</span>
                                            @endif
                                        </td> --}}
                                        <td>
                                            @if ($orders->image)
                                                <span>Payment accepted</span>
                                            @else
                                                <span>Not yet confirmed</span>
                                            @endif
                                        </td>
                                        
                                        
                                        <td>{{ $orders->order_status}}</td>
                                        {{-- <td>
                                            <img style="height:100px; width:100px;" src="/ordersimages/{{ $orders->image }}">
                                        </td> --}}
                                       
                                       
                                       
                                        
                                        <td>
                                            <a href="{{ route('admin.customerOrders.check_orders', ['trackNo' => $trackNo]) }}" title="view">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            {{-- <a href="{{ route('admin.customerOrders.edit_trackorders', ['trackNo' => $trackNo]) }}" title="view">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Check
                                                </button>
                                            </a> --}}
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
        <li><a href="{{ $trackcustomer->previousPageUrl() }}">Previous</a></li>
        @foreach ($trackcustomer->getUrlRange(1, $trackcustomer->lastPage()) as $page => $url)
            <li class="{{ $page == $trackcustomer->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach
        <li><a href="{{ $trackcustomer->nextPageUrl() }}">Next</a></li>
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
