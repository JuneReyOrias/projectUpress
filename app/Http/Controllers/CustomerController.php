<?php

namespace App\Http\Controllers;
use App\Models\OrderListing;
use App\Models\Product;

use App\Models\Cart;
use App\Models\ServiceCategory;
use App\Models\TrackOrders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use Barryvdh\DomPDF\PDF; 
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
{
    public function  CustomersDashboard(){

        $pending = TrackOrders::where('order_status', 'Confirmed')->count();
        $cart= Cart::count();
        $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();

        $product= Product::all();
        $services = ServiceCategory::all();
        return view('customer.customers_index',compact('cart','pendingOrders','pending','product','services'));
    }

   
    public function CustomerLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function ViewCart(){
        return view('cart.addcart');
    }


    public function Customerprof(){
        $id =Auth::user()->id;
        $pending = TrackOrders::where('order_status', 'Confirmed')->count();
        $custProfile = User:: find($id);
        $cart= Cart::count();
        $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
        return view('customer.profile.new_update',compact('custProfile','pending','cart','pendingOrders'));
    }

    public function custProfile(Request $request){
       
        try {
             $id =Auth::user()->id;
        $data= User:: find($id);
        if ($data) {
            // Check if a file is present in the request and if it's valid
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Retrieve the image file from the request
                $image = $request->file('image');

                // Generate a unique image name using current timestamp and file extension
                $imagename = time() . '.' . $image->getClientOriginalExtension();

                // Move the uploaded image to the 'productimages' directory with the generated name
                $image->move('customerimages', $imagename);

                // Delete the previous image file, if exists
                if ($data->image) {
                    Storage::delete('customerimages/' . $data->image);
                }

                // Set the image name in the Product data
                $data->image = $imagename;
            }


        $data->username= $request->username;
        $data->firstname= $request->firstname;
        $data->lastname= $request->lastname;
        $data->email= $request->email;
        $data->contact_no= $request->contact_no;
        $data->role= $request->role;
         
         
       $data->save();
         // Redirect back after processing
         return redirect()->route('customer.profile.new_update')->with('message', 'Profile updated successfully');
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



// customer product view 
public function displayProduct(){
    $product= Product::orderBy('id','desc')->paginate(10);
    $no_cart= Cart::count();
    $pending = TrackOrders::where('order_status', 'Confirmed')->count();
    $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
    return view('customer.custproduct.prod_view', compact('product','no_cart','pendingOrders','pending'));
}

// customer viw the servicess offer by the UPRESS
public function ViewOfferServices(){
    $services = ServiceCategory::orderBy('id')->paginate(10);
    $no_cart= Cart::count();
    $pending = TrackOrders::where('order_status', 'Confirmed')->count();
    $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
    return view('customer.custservices.service_view', compact('services','no_cart','pendingOrders','pending'));
}

// add product or services of customer to cart
public function AddToCart(){
    $cart=Cart::orderBy('id','desc')->paginate();
    $no_cart=Cart::count();
    $total=Cart::sum('total_amount');
    $pending = TrackOrders::where('order_status', 'Confirmed')->count();
    $pendingOrders =TrackOrders::where('order_status', 'Pending')->count();
    return view('customer.addcart.cart_order',compact('cart','no_cart','total','pendingOrders','pending'));
}




// fetching the product deteils to databse to customer product

public function CartNew(Request $request){
    try {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
        
           
            // $prefix = "31182000"; 
            // $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>6,'prefix'=>$prefix]);
            // Create a new cart instance
            $existingItem = Cart::where('users_id', $user->id)
            ->where('item_name', $request->item_name)
            
            ->where('color', $request->color)
            ->where('sizeof', $request->sizeof)
            ->first();

        if ($existingItem) {
            // If item already exists, update its quantity and total amount
            $existingItem->quantity += $request->quantity;
            $existingItem->total_amount = $existingItem->unit_price * $existingItem->quantity;
            $existingItem->save();
        } else {
            $cart = new Cart();

            // Assign user's information to the cart instance
            $cart->users_id=$user->id;
            $cart->lastname = $user->lastname;
            $cart->firstname = $user->firstname;
            $cart->email = $user->email;
            $cart->college = $user->college;
            $cart->department = $user->department;
            $cart->contact_no = $user->contact_no;
            $cart->cust_code = $user->cust_code;
            // Assign other relevant user information to corresponding columns in the cart table
            // $cart->id=$id;
            $cart->image= $request->image;
            $cart->item_name= $request->item_name;
            $cart->type= $request->type;
            $cart->services= $request->services;
            $cart->type_services= $request->type_services;

                      // Handle the "Other" color option
                      if ($request->color === 'other') {
                        $cart->color = $request->other_color; // Use the value entered in the "other_color" input field
                    } else {
                        $cart->color = $request->color; // Use the selected color from the dropdown
                    }
            $cart->sizeof= $request->sizeof;
            $cart->unit= $request->unit;
            $cart->quantity= $request->quantity;
            $cart->unit_price= $request->unit_price;
            $cart->total_amount= $request->total_amount;
            $cart->product_id= $request->product_id;
            $cart->service_category_id= $request->service_category_id;
           
         
            // dd($cart);
            // Save the cart instance
            $cart->save();
        }
            return redirect('/customer-upress-product')->with('message', 'Cart Added Successfully');

        } else {
            // User is not authenticated
            // You can handle this case accordingly
        }
    } catch (\Exception $e) {
        // Handle the exception
        // Log the error or return an error response
        dd($e);
        return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    }
}
 

public function cartdelete($id){
    try {
        // Find the product by ID
        $cart = Cart::find($id);
    
        // Check if the product exists
       
            // Delete the product data from the database
            $cart->delete();

            // Redirect back with success message
            return redirect()->back()->with('message', 'Product deleted successfully');
        
    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting Services: ' . $e->getMessage());
    }

}

public function getProductDetails($id)
{
    // Retrieve the product from the database
    $product = Product::findOrFail($id);

    // Return the product details in JSON format
    return response()->json([
        'productName' => $product->name,
        'productColor' => $product->color,
        'productQuantity' => $product->quantity,
        'productPrice' => $product->price,
    ]);



}


public function cartforedit($id){
    $cart= Cart::find($id);
    $carters= Cart::count();
    $pending = TrackOrders::where('order_status', 'Confirmed')->count();
    $pendingOrders =TrackOrders::where('order_status', 'Pending')->count();
    return view('customer.addcart.edit_cart',compact('cart','carters','pendingOrders','pending'));
}



public function UpdateCarts(Request $request,$id){
    try {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
         
        
            // $prefix = "31182000"; 
            // $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>6,'prefix'=>$prefix]);
            // Create a new cart instance
            $cart = Cart::where('id', $id)->first();

            // Assign user's information to the cart instance

            $cart->lastname = $user->lastname;
            $cart->firstname = $user->firstname;
            $cart->email = $user->email;
            $cart->college = $user->college;
            $cart->department = $user->department;
            $cart->contact_no = $user->contact_no;
            
            // Assign other relevant user information to corresponding columns in the cart table
            // $cart->id=$id;
            $cart->image= $request->image;
            $cart->item_name= $request->item_name;
            $cart->type= $request->type;
            $cart->services= $request->services;
            $cart->type_services= $request->type_services;
            $cart->color= $request->color;
            $cart->sizeof= $request->sizeof;
            $cart->unit= $request->unit;
            $cart->quantity= $request->quantity;    
            $cart->unit_price= $request->unit_price;
            $cart->total_amount= $request->total_amount;
            $cart->product_id= $request->product_id;
            $cart->service_category_id= $request->service_category_id;
         
            // dd($cart);
            // Save the cart instance
            $cart->save();

            return redirect('/customer-add-cart')->with('message', 'Cart Updated Successfully');

        } else {
            // User is not authenticated
            // You can handle this case accordingly
        }
    } catch (\Exception $e) {
        // Handle the exception
        // Log the error or return an error response
        dd($e);
        return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    }
}
 

// customeorderlisting of add to cart of orders
public function orderList(Request $request) {
    try {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the item already exists in the cart
            $existingItem = Cart::where('users_id', $user->id)
                ->where('item_name', $request->item_name)
                ->where('color', $request->color)
                ->where('sizeof', $request->sizeof)
                ->first();

            if ($existingItem) {
                // If item already exists, update its quantity and total amount
                $existingItem->quantity += $request->quantity;
                $existingItem->total_amount = $existingItem->unit_price * $existingItem->quantity;
                $existingItem->save();
            } else {
                // Generate random trackno and invoiceno
                $trackno = "Refno-" . mt_rand(100000, 999999);
                $invoiceno = "IVNo-" . mt_rand(100000, 999999);

                // Retrieve cart items for the user
                $cartItems = Cart::where('users_id', $user->id)->get();

                foreach ($cartItems as $cartItem) {
                    // Create a new order
                    $order = new OrderListing;
                    $order->trackno = $trackno;
                    $order->invoiceno = $invoiceno;
                    $order->users_id = $user->id;
                    $order->cust_code = $cartItem->cust_code;
                    $order->image=$cartItem->image;
                    $order->item_name = $cartItem->item_name;
                    $order->type = $cartItem->type;
                    $order->product_id= $cartItem->product_id;
                    $order->services=$cartItem->services;
                    
                    $order->service_category_id=$cartItem->service_category_id;
                    $order->type_services=$cartItem->type_services;
                    $order->sizeof=$cartItem->sizeof;
                    $order->unit=$cartItem->unit;
                    $order->quantity=$cartItem->quantity;
                    $order->unit_price=$cartItem->unit_price;
                    $order->total_amount=$cartItem->total_amount;
                    
            
                    $order->color = $cartItem->color;
                    // Generate a UUID and make it short
                    // $shortUuid = substr((string) Str::uuid(), 0, 8); // Adjust the length as needed
                    // $order->uuid = $shortUuid;
                    // dd($order);

                    // Save the order
                    $order->save();

                    // Create track orders
                    $trackOrder = new TrackOrders;
                    $trackOrder->order_listing_id = $order->id;
                    $trackOrder->users_id = $order->users_id;
                    $trackOrder->product_id= $order->product_id;
                    $trackOrder->service_category_id = $order->service_category_id;
                    $trackOrder->customer_name = $order->customer_name;
                    $trackOrder->department = $order->department;
                    $trackOrder->college = $order->college;
                    $trackOrder->trackno = $order->trackno;
                    $trackOrder->invoiceno = $order->invoiceno;
                    // dd( $trackOrder);
                    $trackOrder->save();

                    // Delete the cart item
                    $cartItem->delete();
                }
            }

            // Redirect with success message
            return redirect('/customer-orderslip')->with('message', 'Order Added Successfully');
        } else {
            // User is not authenticated
            // Handle this case accordingly
        }
    } catch (\Exception $e) {
        // Handle specific exceptions and return appropriate response
        dd($e);
        return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    }
}


// customer receipt
public function Receipt(){
    // Assuming you have an authenticated user
    $user = Auth::user();

    // Fetch new orders for the authenticated user
    $newOrders = OrderListing::where('users_id', $user->id)
                      ->where('order_status','Pending')
                      ->get();
                      $total= OrderListing::sum('total_amount');
                      $pending = OrderListing::where('order_status', 'Confirmed')->count();
                      $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
                      $date = OrderListing::select('id', 'created_at')
                      ->where('users_id', $user->id)
                      ->where('order_status', 'Pending')
                      ->get();
                      $customername =$user->firstname.' '.$user->lastname; // Customer/User ID
                      $orderId = $newOrders->pluck('id');
                      $collegeType = $user->college; // Type of College
                      $department = $user->department; // Department
                      $groupedOrderIds = [];
                      foreach ($newOrders as $order) {
                          $orderId = $order->id;
                          $groupedPart = substr($orderId, 0, 9); // Get the first 11 digits
                          $lastTwoDigits = substr($orderId, -2); // Get the last two digits
                          $groupedOrderIds[$groupedPart][] = $lastTwoDigits;
                      }

                      $orderlist=OrderListing::orderBy('id','desc')->paginate();
                      $total=OrderListing::sum('total_amount');
    return view('customer.orderlist.receipt_order',compact('orderlist','total','groupedOrderIds','date','newOrders','total','pending','pendingOrders','customername','orderId','collegeType','department',));


}
public function confirmOrders(){
    $user = Auth::user();
         
    $usersid=$user->id;
    $cart=Cart::where('users_id','=',$usersid)->get();
    $total= Cart::sum('total_amount');
    $carter= Cart::count();
    $pending = OrderListing::where('order_status', 'Confirmed')->count();
    $pendingOrders = OrderListing::where('order_status', 'Pending')->count();
    return view('customer.orderlist.confirm_order',compact('cart','total','carter','pendingOrders','pending'));
}




// public function newlist() {
//     // Get the authenticated user
//     $user = Auth::user();

//     // Fetch new orders for the authenticated user
//     $newOrders = OrderListing::where('users_id', $user->id)
//                              ->where('order_status', 'Pending')
//                              ->get();

//     // Group the items by their name
//     $groupedItems = $newOrders->groupBy('item_name');

//     // Calculate total amount of all orders
//     $total = OrderListing::where('users_id', $user->id)
//                          ->where('order_status', 'Pending')
//                          ->sum('total_amount');

//     // Fetch creation dates of orders
//     $date = OrderListing::select('id', 'created_at')
//                         ->where('users_id', $user->id)
//                         ->where('order_status', 'Pending')
//                         ->get();

//                         // Fetch additional order details
//     $customerId = $user->id; // Customer/User ID
//     $orderId = $newOrders->pluck('id');
//     $collegeType = $user->college; // Type of College
//     $department = $user->department; // Department

    
//  // Group the first 11 digits of each order ID and append the last two digits
//  $groupedOrderIds = [];
//  foreach ($newOrders as $order) {
//      $orderId = $order->id;
//      $groupedPart = substr($orderId, 0, 9); // Get the first 11 digits
//      $lastTwoDigits = substr($orderId, -2); // Get the last two digits
//      $groupedOrderIds[$groupedPart][] = $lastTwoDigits;
//  }


//    // Pass data to the view
//    return view('customer.orderlist.view_orders', compact('groupedItems', 'total', 'date', 'customerId', 'orderId', 'collegeType', 'department','groupedOrderIds'));
// }

// public function newlist(Request $request)
// {
//     // Get the authenticated user
//     $user = Auth::user();

  
//     // Fetch additional order details
//     $customername =$user->firstname.' '.$user->lastname; // Customer/User ID
//    $collegeType = $user->college; // Type of College
//     $department = $user->department; // Department

  

//     $cart= Cart::count();
//     $pendingOrders = OrderListing::where('order_status', 'Pending')->count();
//     $pending = OrderListing::where('order_status', 'Confirmed')->count();
//     $orderlist=OrderListing::all();
//     $totalPendingAmount = OrderListing::where('order_status', 'Confirmed')->sum('total_amount');
//     $trackOrders = TrackOrders::with('user', 'orderListing')->get();

//     // Pass data to the view
//     return view('customer.orderlist.view_orders', compact('trackOrders','totalPendingAmount','orderlist','cart','pendingOrders', 'customername', 'collegeType', 'department','pending'));
// }


public function newlist(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

  
    // Fetch additional order details
    $customername =$user->firstname.' '.$user->lastname; // Customer/User ID
   $collegeType = $user->college; // Type of College
    $department = $user->department; // Department
$trackcustomer= TrackOrders::with('usersName','orderlist')->orderBy('id','desc')->paginate(10);
  

    $cart= Cart::count();
    $pendingOrders =  TrackOrders::where('order_status', 'Pending')->count();
    $pending = OrderListing::where('order_status', 'Confirmed')->count();
    $orderlist=OrderListing::all();
    $totalPendingAmount = OrderListing::where('order_status', 'Confirmed')->sum('total_amount');
    $trackOrders = TrackOrders::with('user', 'orderListing')->get();

    // Pass data to the view
    return view('customer.orderlist.view_orders', compact('trackOrders','totalPendingAmount','orderlist','cart','pendingOrders', 'customername', 'collegeType', 'department','pending','trackcustomer'));
}

        // customers all orders view
        public function CheckAllorders($trackNo){
            // Find orders with the specified track number or throw a 404 error if not found
            $checkorders = TrackOrders::where('trackno', $trackNo)->get();
            
    $cart= Cart::count();
    $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
    $pending = OrderListing::where('order_status', 'Confirmed')->count();
    $orderlist=OrderListing::all();
    $totalPendingAmount = OrderListing::where('order_status', 'Confirmed')->sum('total_amount');
   
       return view('customer.orderlist.all_orders_view',compact('checkorders','cart','pendingOrders','pending','orderlist','totalPendingAmount'));
       }



// track order page by customers

public function trackOrder(Request $request){
    $user = Auth::user();
    $status = $request->input('status', 'all'); // Default value is 'all'
    // $newOrder = OrderListing::where('users_id', $user->id)->get();
    //       // Fetch orders for the authenticated user based on status
    // if ($status != 'all') {
    //     $newOrders = OrderListing::where('users_id', $user->id)
    //                              ->where('order_status', $status)
    //                              ->get();
    // } else {
    //     $newOrders = OrderListing::where('users_id', $user->id)->get(); // Fetch all orders
    // }

    // $date = OrderListing::select('id', 'created_at')
    // ->where('users_id', $user->id)
    // ->where('order_status', 'Pending')
    // ->get();


    $usersid=$user->id;
    $cart=Cart::where('users_id','=',$usersid)->get();
    $total= Cart::sum('total_amount');
    $carter= Cart::count();
    $pending = TrackOrders::where('order_status', 'Confirmed')->count();
    $pendingOrders = OrderListing::where('order_status', 'Pending')->groupBy('trackno')->count();
    $customername =$user->firstname.' '.$user->lastname; // Customer/User ID
    // $orderId = $newOrders->pluck('id');
    $collegeType = $user->college; // Type of College
    $department = $user->department; // Department
    $groupedOrderIds = [];
    // foreach ($newOrders as $order) {
       
    //     if ($order->status == 'your_desired_status') {$orderId = $order->id;
    //     $groupedPart = substr($orderId, 0, 9); // Get the first 11 digits
    //     $lastTwoDigits = substr($orderId, -2); // Get the last two digits
    //     $groupedOrderIds[$groupedPart][] = $lastTwoDigits;
    // }
    $allOrder = OrderListing::where('users_id', $user->id)->get();
    $confirmOrders = TrackOrders::where('order_status', 'Confirmed')->groupBy('trackno')->count();
    $cancelledOrders = TrackOrders::where('order_status', 'Cancelled')->groupBy('trackno')->count();
    $orderslipOrders = TrackOrders::where('order_status', 'OrderSlip')->groupBy('trackno')->count();
    $paymentOrders = TrackOrders::where('order_status', 'Payment')->groupBy('trackno')->count();
    $processingOrders = TrackOrders::where('order_status', 'Processing')->groupBy('trackno')->count();
    $readyForPickupOrders = TrackOrders::where('order_status', 'Ready for Pick up')->groupBy('trackno')->count();
    $completedOrders = TrackOrders::where('order_status', 'Completed')->groupBy('trackno')->count();
    

    $trackcustomer= TrackOrders::with('usersName','orderlist');


    return view('customer.trackorders.view_track',compact('trackcustomer','cart','total','carter','pendingOrders','pending', 'customername', 'collegeType', 'department', 'groupedOrderIds', 'status',
'confirmOrders','orderslipOrders','paymentOrders','processingOrders','readyForPickupOrders','cancelledOrders','completedOrders','allOrder'));
}

// services adding cart to cart by customers

public function Servicescart(Request $request){
    try {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
            // dd($user);
            // Create a new cart instance
              // Find existing item in the cart with the same color and size
              $existingItem = Cart::where('users_id', $user->id)
              ->where('services', $request->services)
              ->where('type_services', $request->type_services)
              ->where('color', $request->color)
              ->where('sizeof', $request->sizeof)
              ->first();

          if ($existingItem) {
              // If item already exists, update its quantity and total amount
              $existingItem->quantity += $request->quantity;
              $existingItem->total_amount = $existingItem->unit_price * $existingItem->quantity;
            //   dd($existingItem);
              $existingItem->save();
          } else {
              // Create a new cart instance
             
            $cart = new Cart;
            
            // Assign user's information to the cart instance
            $cart->users_id = $user->id;
            $cart->lastname = $user->lastname;
            $cart->firstname = $user->firstname;
            $cart->email = $user->email;
            $cart->college = $user->college;
            $cart->department = $user->department;
            $cart->contact_no = $user->contact_no;
            $cart->cust_code = $user->cust_code;

            // Assign other relevant user information to corresponding columns in the cart table
            $cart->image = $request->image;
            $cart->type = $request->type;
            $cart->services = $request->services;
            $cart->type_services = $request->type_services;
            
            // Handle the "Other" color option
            if ($request->color === 'other') {
                $cart->color = $request->new_size; // Use the value entered in the "other_color" input field
            } else {
                $cart->color = $request->color; // Use the selected color from the dropdown
            }
                // Handle the "Other" color option
                if ($request->sizeof === 'add') {
                    $cart->sizeof = $request->other_color; // Use the value entered in the "other_color" input field
                } else {
                    $cart->sizeof = $request->sizeof; // Use the selected sizeof from the dropdown
                }
       
            $cart->unit = $request->unit;
            $cart->quantity = $request->quantity;
            $cart->unit_price = $request->unit_price;
            $cart->total_amount = $request->total_amount;
            $cart->service_category_id = $request->service_category_id;
            // dd($cart);
            // Save the cart instance
            $cart->save();
           
            }
            return redirect('/customer-upress-services')->with('message', 'Cart Added Successfully');

        } else {
            // User is not authenticated
            // You can handle this case accordingly
        }
    } catch (\Exception $e) {
        // Handle the exception
        // Log the error or return an error response
        dd($e);
        return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    }
}


// edit services cart by customers
public function cartEditServices($id){
    $cart= Cart::find($id);
    $carters= Cart::count();
    $pending = OrderListing::where('order_status', 'Confirmed')->count();
    $pendingOrders = TrackOrders::where('order_status', 'Pending')->count();
    return view('customer.addcart.edit_cart_services',compact('cart','carters','pendingOrders','pending'));
}
// UPDATE THE SERVICES ORDER BY CUSATOMERS
public function cartUpdateServices(Request $request,$id){
    try {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
            // dd($user);
            // Create a new cart instance
              // Find existing item in the cart with the same color and size
        //       $existingItem = Cart::where('users_id', $user->id)
        //       ->where('color', $request->color)
        //       ->where('sizeof', $request->sizeof)
        //       ->first();

        //   if ($existingItem) {
        //       // If item already exists, update its quantity and total amount
        //       $existingItem->quantity += $request->quantity;
        //       $existingItem->total_amount = $existingItem->unit_price * $existingItem->quantity;
        //       $existingItem->save();
        //   } else {
              // Create a new cart instance
              $cart = Cart::where('id', $id)->first();
       
            
            // Assign user's information to the cart instance
            $cart->users_id = $user->id;
            $cart->lastname = $user->lastname;
            $cart->firstname = $user->firstname;
            $cart->email = $user->email;
            $cart->college = $user->college;
            $cart->department = $user->department;
            $cart->contact_no = $user->contact_no;
            $cart->cust_code = $user->cust_code;

            // Assign other relevant user information to corresponding columns in the cart table
            $cart->image = $request->image;
            $cart->type = $request->type;
            $cart->services = $request->services;
            $cart->type_services = $request->type_services;
            
            // Handle the "Other" color option
            if ($request->color === 'other') {
                $cart->color = $request->new_size; // Use the value entered in the "other_color" input field
            } else {
                $cart->color = $request->color; // Use the selected color from the dropdown
            }
                // Handle the "Other" color option
                if ($request->sizeof === 'add') {
                    $cart->sizeof = $request->other_color; // Use the value entered in the "other_color" input field
                } else {
                    $cart->sizeof = $request->sizeof; // Use the selected sizeof from the dropdown
                }
       
            $cart->unit = $request->unit;
            $cart->quantity = $request->quantity;
            $cart->unit_price = $request->unit_price;
            $cart->total_amount = $request->total_amount;
            $cart->service_category_id = $request->service_category_id;
           dd($cart);
           
            // Save the cart instance
            $cart->save();
           
            return redirect('/customer-add-cart')->with('message', 'Updated Services order Successfully');

        } else {
            // User is not authenticated
            // You can handle this case accordingly
        }
    } catch (\Exception $e) {
        // Handle the exception
        // Log the error or return an error response
        // dd($e);
        return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    }
}





}


