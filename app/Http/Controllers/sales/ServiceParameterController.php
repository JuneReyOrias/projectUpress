<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\ServiceParameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ServiceParameterController extends Controller
{
   public function servicedata(){
      
    
    return view('servicescat.index');
   }
   public function show(){
      
      $project= ServiceParameter::all();

    return view('servicescat.show_services',compact('project'));
   }
   public function addserviceParam(Request $request){
      $prefix = "19051816000"; 
      $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>5,'prefix'=>$prefix]);
      

        $data= New ServiceParameter;

    // Assign other fields from the request to the Product data
    $data->id=$id;
    $data->service_category_id = $request->service_category_id;
     $data->type = $request->type;
     $data->size = $request->size;
     $data->unit_price = $request->unit_price;
     $data->status = $request->status;
     // Save the Product data to the database
     $data->save();
 
     // Debugging: Dump and die to inspect $data
    
 
     // Redirect back after processing
     return redirect()->route('servicescat.show')->with('message','Services Category Added Successfully');
   }

   public function updateView($id){

      // $project= ServiceParameter::find($id);
      $project = DB::table('service_parameter')->where('id',$id)->first();
      return view('servicescat.serviceparam.update', compact('project'));
 
   }
//    //update the serviceCategory content
// public function updateservice(Request $request,$servparam_id){
//    try {
//        $data= ServiceParameter::find($servparam_id);
//        $data = ServiceParameter::where('servparam_id', $servparam_id)->first();
//        // Assign other fields from the request to the Product data
       
//        $data->service_category_id = $request->service_category_id;
//        $data->type = $request->type;
//        $data->size = $request->size;
//        $data->unit_price = $request->unit_price;
//        $data->status = $request->status;
   
//        // Save the Product data to the database
//        $data->save();
//            // Redirect back after processing
//            return redirect()->route('servicescat.show')->with('message', 'Servicess updated successfully');
       
//    } catch (\Exception $e) {
//        dd($e);
//        // Handle any exceptions and redirect back with error message
//        return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
//    }
// }


public function updateservice(Request $request, $id)
{
    try {
        // Find the service parameter by ID
        $data = ServiceParameter::findById($id);

        // Check if the service parameter exists
        if ($data) {
            // Assign fields from the request to the ServiceParameter instance
            $data->service_category_id = $request->service_category_id;
            $data->type = $request->type;
            $data->size = $request->size;
            $data->unit_price = $request->unit_price;
            $data->status = $request->status;

            // Save the ServiceParameter data to the database
            $data->save();

            // Redirect back after processing
            return redirect()->route('servicescat.show')->with('message', 'Service Parameter updated successfully');
        } else {
            // Redirect back with error message if service parameter not found
            return redirect()->back()->with('error', 'Service Parameter not found');
        }
    } catch (\Exception $e) {
      dd($e);
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error updating service parameter: ' . $e->getMessage());
    }
}

public function servicedelete($id){
   try {
       // Find the product by ID
        $project = ServiceParameter::find($id);
   
       // Check if the product exists
       
           // Delete the product data from the database
            $project->delete();

           // Redirect back with success message
           return redirect()->back()->with('message', 'Services deleted successfully');
       
   } catch (\Exception $e) {
       // Handle any exceptions and redirect back with error message
       return redirect()->back()->with('error', 'Error deleting Services: ' . $e->getMessage());
   }
}

}
