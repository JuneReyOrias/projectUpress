<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
   public function addpurchase(){
    return view('customer.purchase.view_purchase');
   }
}
