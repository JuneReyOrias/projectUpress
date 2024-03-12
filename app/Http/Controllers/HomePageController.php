<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
   public function Home(){
      $product= Product::all();
      $services = ServiceCategory::all();
        return view("homepage.upress_homepage",compact('product','services'));
   }

   public function OurProducts(){
      $product= Product::all();
      $services = ServiceCategory::all();
      return view('homeproduct.view',compact('product','services'));
   }

   public function OurServices(){
      $product= Product::all();
      $services = ServiceCategory::all();
      return view('homeservices.serve',compact('product','services'));
   }
   public function OurAbout(){
      return view('homeabout.about');
   }
   public function OurContact(){
      return view('homecontact.contacts');
   }
}
