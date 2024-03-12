<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Materials;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    //add view
    public function material() {
        $material= Materials::all();
        return view('material.new_materials',compact('material'));
    }
    //adding data
    public function addmaterials(Request $request){
        $prefix = "130120000"; 
        $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>5,'prefix'=>$prefix]);
       
        $data= new Materials;
        $data->id=$id;
        $data->material_name = $request->material_name;

        $data->save();

        return redirect()->back()->with('message','Materials Added Successfully');
    }
}
