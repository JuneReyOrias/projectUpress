<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryRequest;
use App\Models\ServiceCategory;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function ServicesCat(){
        $servicescat= ServiceCategory::all();
        
        return view('servicescat.add_services',compact('servicescat'));
    }

    
//insrtion data to database
public function Newstore(ServiceCategoryRequest $request)
{
    try {
        // Create a new Product instance
        // $prefix = "19051822000"; 
        // $id=IdGenerator::generate(['table'=> 'service_category','field'=> 'id','length'=>7,'prefix'=>$prefix]);




        // Validate the request data using the ServiceCategoryRequest class
        $data = $request->validated(); // This line validates the request data using the rules defined in ServiceCategoryRequest class

        // Create a new ServiceCategory instance
        $serviceCategory = new ServiceCategory; // Renamed the variable to make it clearer

        // Check if a file is present in the request and if it's valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Retrieve the image file from the request
            $image = $request->file('image');

            // Generate a unique image name using current timestamp and file extension
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded image to the 'servicesimages' directory with the generated name
            $image->move('servicesimages', $imageName);

            // Set the image name in the ServiceCategory instance
            $serviceCategory->image = $imageName;
        } else {
            // Handle case where no valid image was uploaded
            return redirect()->back()->with('error', 'No valid image uploaded.');
        }

        // Assign other fields from the request to the ServiceCategory instance
        // $serviceCategory->id = $id;
        $serviceCategory->serv_code = $request->serv_code;
        $serviceCategory->category = $request->category;
        $serviceCategory->description = $request->description;
        $serviceCategory->type_services = $request->type_services;
        $serviceCategory->size = $request->size;
        $serviceCategory->unit = $request->unit;
        $serviceCategory->color = $request->color;
        $serviceCategory->unit_price = $request->unit_price;
        $serviceCategory->status = $request->status;

        // Debugging: Dump the $serviceCategory instance to see its values
        // dd($serviceCategory);

        // Save the ServiceCategory data to the database
        $serviceCategory->save();

        return redirect()->route('servicescat.add_services')->with('message', 'Services Category Added Successfully');
    } catch (\Exception $e) {
        // Debugging: Dump the exception to see the error details

        // Handle exceptions here
        return redirect()->back()->with('error', 'Failed to add services category: ' . $e->getMessage());
    }
}

//services views
public function serviceshow($id){
    $servicescat= ServiceCategory::find($id);
     return view('servicescat.update_services', compact('servicescat'));

}

//update the serviceCategory content
public function updateservices(Request $request,$id){
    try {
        $data= ServiceCategory::find($id);

        // Assign other fields from the request to the Product data
        $data->category = $request->category;
        $data->description = $request->description;
        
    
        // Save the Product data to the database
        $data->save();
            // Redirect back after processing
            return redirect()->route('servicescat.add_services')->with('message', 'Servicess updated successfully');
        
    } catch (\Exception $e) {
        dd($e);
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
    }
}

public function servicesdelete($id){
    try {
        // Find the product by ID
        $servicescat = ServiceCategory::find($id);
    
        // Check if the product exists
       
            // Delete the product data from the database
            $servicescat->delete();

            // Redirect back with success message
            return redirect()->back()->with('message', 'Services deleted successfully');
        
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting Services: ' . $e->getMessage());
    }
}

//fetch the primary key
public function serviceParam(){

    $category= ServiceCategory::all();

        return view('servicescat.new_servcat',compact('category'));
       
}
}
