<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockInController extends Controller
{
    public function stockRecords()
    {
        return view('admin.stock-in.stock_records');
    }

}
