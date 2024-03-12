<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderListingController extends Controller
{
    public function CreateOrder(){
        $product= Product::all();
        return view('customer.product.add_orders',compact('product'));
    }
    public function CreateServices(){
        return view('customer.service.add_services');
    }
}
