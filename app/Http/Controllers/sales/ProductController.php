<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Storage;
use App\Events\ProductViewed;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //product fetching to show
    public function Product(){
        $product= Product::all();
        return view('products.add_product',compact('product'));
    }
    public function addServices(){
        return view('customer.product.add_services');
    }
    public function showadd(){
        
        return view('products.index');
    }

  //adding new product
    public function addproduct(ProductRequest $request){
     
     try{
        // Create a new Product instance
        // $prefix = "161815400"; 
        // $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>7,'prefix'=>$prefix]);
     // Create a new Product instance
     $data= $request->validated();
     $data= $request->all();
     $data = new Product;

     // Check if a file is present in the request and if it's valid
     if ($request->hasFile('image') && $request->file('image')->isValid()) {
         // Retrieve the image file from the request
         $image = $request->file('image');

         // Generate a unique image name using current timestamp and file extension
         $imageName = time() . '.' . $image->getClientOriginalExtension();

         // Move the uploaded image to the 'productimages' directory with the generated name
         $image->move('productimages', $imageName);

         // Set the image name in the Product data
         $data->image = $imageName;
     } else {
         // Handle case where no valid image was uploaded
         throw new \Exception('No valid image uploaded.');
     }

     // Assign other fields from the request to the Product data
     $data->product_name = $request->product_name;
     $data->description = $request->description; // Fix typo in description field name
       
     $data->size = $request->size;  
     $data->color = $request->color;
     $data->unit_price = $request->unit_price;
     $data->unit_price = $request->unit_price;

     $data->stocks = $request->stocks;
     $data->status = $request->status;
dd($data);
     // Save the Product data to the database
     $data->save();

     // Redirect back after processing with success message
     return redirect()->back()->with('message', 'Product Added Successfully');
 } catch (\Exception $e) {
    dd($e);
     // Handle exceptions here
     return redirect()->back()->with('error', $e->getMessage());
 }
}
//update of product for view

public function updateviews($id){
    //  Find the product by ID
    // $product = Product::find($productId);

    // // Dispatch the event
    // event(new ProductViewed($productId));
    $product = DB::table('product')->where('id',$id)->first();
     return view('products.update_product', compact('product'));

}
  
//update the data 
public function productupdate(ProductRequest $request, $id)
{
    try {
        $data= $request->validated();
        $data= $request->all();
        // Find the product by id
        $data = Product::where('id', $id)->first();
     
        if ($data) {
            // Check if a file is present in the request and if it's valid
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Retrieve the image file from the request
                $image = $request->file('image');

                // Generate a unique image name using current timestamp and file extension
                $imagename = time() . '.' . $image->getClientOriginalExtension();

                // Move the uploaded image to the 'productimages' directory with the generated name
                $image->move('productimages', $imagename);

                // Delete the previous image file, if exists
                if ($data->image) {
                    Storage::delete('productimages/' . $data->image);
                }

                // Set the image name in the Product data
                $data->image = $imagename;
            }

            // Assign other fields from the request to the Product data
            $data->prod_code = $request->prod_code;
            $data->product_name = $request->product_name;
            $data->descritpion = $request->descritpion;
            $data->unit_price = $request->unit_price;
            $data->stocks = $request->stocks;
            $data->status = $request->status;
            // Save the Product data to the database
            $data->save();

            // Redirect back after processing
            return redirect()->route('products.add_product')->with('message', 'Product updated successfully');
        } else {
            // Redirect back with error message if product not found
            return redirect()->back()->with('error', 'Product not found');
        }
    } catch (\Exception $e) {
        dd($e);
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
    }
}


//deletion of product
public function productdelete($id)
{
    try {
        // Find the product by ID
        $product = Product::find($id);
    
        // Check if the product exists
        if ($product) {
            // Delete the image file from the 'productimages' directory
            Storage::delete('productimages/' . $product->image);
            
            // Delete the product data from the database
            $product->delete();

            // Redirect back with success message
            return redirect()->back()->with('message', 'Product deleted successfully');
        } else {
            // Redirect back with error message if product not found
            return redirect()->back()->with('error', 'Product not found');
        }
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
    }
}
    
}
