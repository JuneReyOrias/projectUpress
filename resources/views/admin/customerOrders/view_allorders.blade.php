@extends('admin.dashb')

@section('admin')
@extends('layouts._footer-script')
@extends('layouts._head')
<style>

.track-card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Adjust the gap as needed */
}

.track-card {
    flex: 0 0 calc(50% - 10px); /* Adjust the width of each card */
    /* background-color: #f0f0f0; */
    padding: 20px;
    border-radius: 5px;
    /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
}

@media (min-width: 768px) {
    .track-card {
        flex: 0 0 calc(33.333% - 10px); /* Adjust for larger screens */
    }
}
@media (min-width: 320px) {
    .track-card {
        flex: 0 0 calc(33.333% - 10px); /* Adjust for larger screens */
    }
}
</style>
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
                    <div class="track-card-container">
                        <div class="track-card">
                            <img class="rounded-circles d-block mx-auto mb-4" style="max-width: 70%; height: auto; max-height: 70px;" src="../landingpage/assets/images/wmsu.png" alt="University Logo">
                        </div>
                        <div class="track-card">
                            <div class="text-center">
                                <span>Western Mindanao State University</span><br>
                                <h5>UNIVERSITY PRESS</h5>
                                 <span>Zamboanga City</span><br>
                                 
                            </div>
                            <div class="text-center d-none d-md-block">
                                <h6>ORDER SLIP</h6>
                            </div>
                        </div>

                        <div class="track-card">
                            <img class="rounded-circles d-block mx-auto mb-4" style="max-width: 70%; height: auto; max-height: 70px;" src="../assets/logo/upress-logo.png" alt="University Logo">
                        </div>
                        <div class="track-card">
                            @php
                            // Group orders by track number
                            $groupedOrders = $checkcustomers->groupBy('trackno','users_id');
                        @endphp
                        
                        @foreach ($groupedOrders as $trackNo => $orders)
                            @php
                                // Get the first order associated with the track number
                                $orders = $orders->first();
                            @endphp
                           <span><b>TrackNo:</b> {{$orders->orderlist->trackno}}</span><br>
                           <span><b>CustomerName:</b> {{$orders->usersName->firstname.' '.$orders->usersName->lastname}}</span><br>
                           <span><b>College:</b> {{$orders->usersName->college}}</span><br>
                           <span><b>College:</b> {{$orders->usersName->college}}</span><br>
                           <span><b>Contact#:</b> {{$orders->usersName->contact_no}}</span><br>
                           <span><b>Email:</b> {{$orders->usersName->email}}</span><br>
                           @endforeach
                           
                        </div>
                        <div class="track-card">
                           
                        </div>
                        <div class="track-card">
                            <span></span><br>
                            <h5></h5>
                             <span></span><br>
                                @if ($checkcustomers->count() > 0)
                                <p>riv no:<span class="font-weight-bold">_______</span></p>
                                <p>Order Date: <span class="font-weight-bold">{{ $checkcustomers->first()->created_at->format('Y-m-d') }}</span></p>
                                @endif
                            
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                       
                    </div>
                    
                    <br>
                    <div>
                      
                        <div class="table-responsive tab" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">no.</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Product Name</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Type of Services</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Quantity</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Unit Price</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Total Amount</th>
                                      <th style="padding:20px; font-weight: bold; background-color: #343a40; color: white;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; 
                                        $grandTotal = 0; // Initialize grand total
@endphp
                                    @if($checkcustomers->count() > 0)
                                    @foreach ($checkcustomers as $orders)
                                        
                                  
                                    <tr class="table-light">
                                        <td>{{$counter++ }}</td>
                                        
                                        <td>{{ $orders->orderlist->item_name}}</td>
                                        <td>{{ $orders->orderlist->services}}</td>
                                        <td>{{ $orders->orderlist->type_services}}</td>
                                        <td>{{ $orders->orderlist->quantity}}</td>
                                        <td>{{ number_format($orders->orderlist->unit_price,2)}}</td>
                                        <td>{{ number_format($orders->orderlist->total_amount,2)}}</td>
                                        <td>{{ $orders->order_status}}</td>

                                       
                                     
                                        
                                      
                                    </tr>
                                    @php
                                    $grandTotal += $orders->orderlist->total_amount; // Calculate grand total
                                @endphp
                                    @endforeach
                                    @else
                                    {{-- <tr>
                                        <td class="text-center" colspan="5">Sizes is Empty</td>
                                    </tr> --}}
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
    <div class="track-card-container">
        <div class="track-card">
         
        </div>
        <div class="track-card">
            
        </div>
        <div class="track-card">
  
            <h4 class="mb-3 mb-md-0">Grand Total: Php {{ number_format($grandTotal,2) }}</h4>
        </div>
        <div class="track-card">
            <div class="button d-flex justify-content-start">
            <a  href="{{route('admin.customerOrders.view_orders')}}"button  class="btn btn-success ">Back</button></a></p>
        </div>
        </div>
        <div class="track-card">

        </div>
        <div class="track-card">
            <div class="button d-flex justify-content-end">
                <a href="#" class="register-button">Download PDF</a>
                <a href="#" class="btn btn-primary ml-2">Print</a>
            </div>
        </div>
 
          
        </div>
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



    $("li").click(function () {
  $(this).addClass("active").siblings().removeClass("active");
});
</script>
@endsection
