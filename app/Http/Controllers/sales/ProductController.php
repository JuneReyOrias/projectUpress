<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Storage;
use App\Events\ProductViewed;
use App\Models\ProductStockColors;
use App\Models\Sizes;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class ProductController extends Controller
{
    //product fetching to show
    public function Product(){
        $product = Product::with('productStockColors.sizes')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('products.add_product',compact('product'));
    }
    public function addServices(){
        return view('customer.product.add_services');
    }
    public function showadd(){
        
        return view('products.index');
    }

//update of product for view

public function updateviews($id){
    //  Find the product by ID
    // $product = Product::find($productId);

    // // Dispatch the event
    // event(new ProductViewed($productId));
    // $product = DB::table('product')->where('id',$id)->first();
    // Find the product using its ID
    $product = Product::with('productStockColors.sizes')->findOrFail($id);
    $sizes=Sizes::all();
    $productstock =ProductStockColors::where('product_id')->get() ;
     return view('products.update_product', compact('product','productstock','sizes'));

}
  
//update the data 
public function productUpdate(ProductRequest $request, $id)
{
    // Begin a database transaction to ensure atomicity
    DB::beginTransaction();

    try {
        // Find the product by id with eager loading of productStockColors
        $product = Product::with('productStockColors.sizes')->findOrFail($id);

        // Handle image update if provided in the request
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('productimages', $imageName);

            // Delete old image file if it exists
            if ($product->image) {
                Storage::delete('productimages/' . $product->image);
            }

            // Update the product's image
            $product->image = $imageName;
        }

        // Update other product attributes
       
        $product->product_name = $request->product_name;
        $product->descritpion = $request->descritpion;
        $product->unit_price = $request->unit_price;
        $product->status = $request->status;

        // Save the updated product
        $product->save();

        // Retrieve the sizes and quantities from the request
        $sizesIds = $request->input('sizes_id', []);
        $quantities = $request->input('quantity', []);

        // Ensure sizes and quantities arrays have the same length
        if (count($sizesIds) !== count($quantities)) {
            throw new \Exception('Sizes and quantities must have the same number of items.');
        }

        // Create a key-value array of sizes_id from the request
        $sizesIdKey = array_flip($sizesIds);

        // Iterate through each size and quantity from the request to update `ProductStockColors`
        foreach ($sizesIds as $index => $sizesId) {
            $quantity = $quantities[$index];

            // Find existing `ProductStockColors` entry or create a new one
            $stockColor = ProductStockColors::where('product_id', $product->id)
                            ->where('sizes_id', $sizesId)
                            ->first();

            if ($stockColor) {
                // Update quantity if the entry exists
                $stockColor->quantity += $quantity;
                $stockColor->save();
            } else {
                // Create a new `ProductStockColors` entry
                $newStockColor = new ProductStockColors();
                $newStockColor->product_id = $product->id;
                $newStockColor->sizes_id = $sizesId;
                $newStockColor->quantity = $quantity;
                $newStockColor->save();
            }
        }

        // Optionally, remove existing entries not present in the request
        // Iterate through the product's `productStockColors`
        // foreach ($product->productStockColors as $existingStockColor) {
        //     if (!array_key_exists($existingStockColor->sizes_id, $sizesIdKey)) {
        //         // If the existing `ProductStockColors` entry's sizes_id is not present in the request, delete it
        //         $existingStockColor->delete();
        //     }
        // }

        // Commit the transaction
        DB::commit();

        // Redirect with a success message
        return redirect()->route('products.add_product')->with('message', 'Product and stock colors updated successfully');
    } catch (\Exception $e) {
        // Roll back the transaction in case of an exception
        DB::rollBack();

        // Redirect back with an error message
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
