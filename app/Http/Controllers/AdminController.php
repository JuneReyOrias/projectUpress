<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\OrderListing;
use App\Models\Product;
use App\Models\ProductStockColor;
use App\Models\ProductStockColors;
use App\Models\ProductStockOuts;
use App\Models\StockIns;
use App\Models\StockOuts;
use App\Models\TrackOrders;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sizes;
use App\Models\Color;
use App\Models\Colors;
use App\Models\Notification;

use App\Models\ServiceCategory;
use App\Models\UniqueCode;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{


    public function accounts(){
        return view('admin.accounts.create_account');
    }
    public function adminDashb(){
        $Customer= User::count();
        $Orderlist= OrderListing::count();

         // Calculate total amount of orders
    $totalAmountOfOrders = OrderListing::sum('total_amount');
   // Calculate total count of ordered products
   $totalOrderedProducts = OrderListing::whereNotNull('product_id')->sum('quantity');

   // Calculate total count of ordered services
   $totalOrderedServices = OrderListing::whereNotNull('service_category_id')->sum('quantity');

       // Assuming you have the cost of each product and service stored in the database
       $totalCostOfGoodsSold = Product::sum('unit_price') + ServiceCategory::sum('unit_price');

       // Calculate profits earned
       $profitsEarned = $totalAmountOfOrders - $totalCostOfGoodsSold;
   
        return view('admin.index',compact('Customer','Orderlist','totalOrderedProducts','totalOrderedServices','totalAmountOfOrders','profitsEarned'));
    }//end method

        public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//end 
    public function AdminLogin(){
         return view('admin.admin_login');
    }//end

    public function AdminProfile(){
        $id =Auth::user()->id;
        $admin = User:: find($id);
        return view('admin.admin_profile', compact('admin'));
    }
  
    public function updateAdmin(Request $request){
       
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
                $image->move('adminimages', $imagename);

                // Delete the previous image file, if exists
                if ($data->image) {
                    Storage::delete('adminimages/' . $data->image);
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



public function fetchcode(){
    $sizes=Sizes::all();
    $colors= Colors::all();
    return view('products.index',compact('sizes','colors'));
}


// adding new productyadmin
public function addProduct(ProductRequest $request)
{
    try {
        // Create a new Product instance
        $data = new Product;
    
        // Check if a file is present in the request and if it's valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Retrieve the image file from the request
            $image = $request->file('image');
    
            // Generate a unique image name using the current timestamp and file extension
            $imagename = time() . '.' . $image->getClientOriginalExtension();
    
            // Move the uploaded image to the 'productimages' directory with the generated name
            $image->move('productimages', $imagename);
    
            // Set the image name in the Product data
            $data->image = $imagename;
        } else {
            // Handle case where no valid image was uploaded
            throw new \Exception('No valid image uploaded.');
        }
    
        // Assign other fields from the request to the Product data
    
        $data->product_name = $request->product_name;
        $data->descritpion = $request->descritpion; // Typo in the variable name fixed
        $data->unit_price = $request->unit_price;
        $data->stocks = $request->stocks;
        $data->status = $request->status;
        // dd($data);
        // Save the Product data to the database
        $data->save();


        // Get arrays of colors and sizes from the request
        // $colorsIds = array_unique($request->input('colors_id', []));
        // $sizesIds = array_unique($request->input('sizes_id', []));
        
        // // Ensure that colorsIds and sizesIds are arrays
        // if (!is_array($colorsIds)) {
        //     $colorsIds = explode(',', $colorsIds);
        // }
        // if (!is_array($sizesIds)) {
        //     $sizesIds = explode(',', $sizesIds);
        // }
        
        // // Loop through the arrays of colors and sizes
        // foreach ($colorsIds as $colorsId) {
        //     foreach ($sizesIds as $sizesId) {
        //         // Create a new instance of ProductStockColors for each combination
        //         $productStockColor = new ProductStockColors;
                
        //         // Set product_id, colors_id, and sizes_id
        //         $productStockColor->product_id = $data->id;
        //         $productStockColor->colors_id = $colorsId;
        //         $productStockColor->sizes_id = $sizesId;
                
        //         // Save the instance to the database
        //         $productStockColor->save();
        //     }
        // }
        $sizesIds = $request->input('sizes_id', []);
        $quantities = $request->input('quantity', []);

        // Ensure that sizesIds and quantities are arrays and have the same length
        if (!is_array($sizesIds)) {
            $sizesIds = explode(',', $sizesIds);
        }
        if (!is_array($quantities)) {
            $quantities = explode(',', $quantities);
        }

        // Check if the sizes and quantities arrays have the same length
        if (count($sizesIds) !== count($quantities)) {
            // Handle the error case where sizes and quantities arrays do not match in length
            return response()->json(['error' => 'Sizes and quantities must have the same number of items'], 400);
        }

        // Loop through the arrays of sizes and quantities
        foreach ($sizesIds as $index => $sizesId) {
            // Get the corresponding quantity from the quantities array
            $quantity = $quantities[$index];

            // Validate the quantity to be non-negative
            if ($quantity < 0) {
                // Skip invalid quantity values
                continue;
            }

            // Create a new instance of StockIns or your model to represent the combination
            $productStockColor = new ProductStockColors;
            // $newStock->id = $id;
            
            $productStockColor->product_id = $data->id;
           $productStockColor->sizes_id = $sizesId;
           $productStockColor->quantity = $quantity;
     
            // dd($newStock);
            // Save the new stock entry to the database
            $productStockColor->save();
        }




        

        // Redirect back after processing
        return redirect()->route('products.add_product')->with('message', 'Product added successfully');
    } catch (\Exception $e) {
        dd($e);
        // Handle any exceptions that occur during the process
        return redirect()->back()->with('error', $e->getMessage());
    }
}



// creating view customers accounts acess by admin
public function NewAccounts(){
    $accounts=User::orderBy('id','desc')->paginate(10);
    return view('admin.accounts.view_users_acc',compact('accounts'));
}
// view the admin accounts
// creating view customers accounts acess by admin
public function adminInfo(){
    $accounts=User::orderBy('id','desc')->paginate(10);
    return view('admin.accounts.view_admin',compact('accounts'));
}
// view the staffs accounts
// creating view customers accounts acess by admin
public function staffInfo(){
    $accounts=User::orderBy('id','desc')->paginate(10);
    return view('admin.accounts.views_staff',compact('accounts'));
}

// adding new users accounts
public function createAcc(){

    return view('admin.accounts.add_new_acc');
}

public function AccountAdd(Request $request){
    try{
        // dd($request->all());
        // $data= $request->validated();
        // $data= $request->all();
        $users= User::create([
            'username' => $request->input('username'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'college' => $request->input('college'),
            'department' => $request->input('department'),
            'email' => $request->input('email'),
            'contact_no' => $request->input('contact_no'),
            'cust_code' => $request->input('cust_code'),
            
            'password' => $request->input('password'),
            'role' => $request->input('role'),
           
        ]);
    //    dd($users);
        $users->save();
        // Determine the redirect URL based on the role
        $redirectUrl = '/admin-view-accounts';
        if ($users->role === 'customer') {
            $redirectUrl = '/admin-view-customer-accounts';
        } elseif ($users->role === 'admin') {
            $redirectUrl = '/admin-view-admin-accounts';
        } elseif ($users->role === 'staff') {
            $redirectUrl = '/admin-view-staff-accounts';
        }

        return redirect($redirectUrl)->with('message', 'Account added Successfully');
    }
    catch(\Exception $ex){
        dd($ex);
        return redirect('/admin-add-new-accounts')->with('message','Someting went wrong');
    }

 


}
public function EditAccount($id){
    $accounts=User::find($id);
    return view('admin.accounts.update_acc',compact('accounts'));
}

public function UpdateAccount(Request $request, $id)
{
    try {
        $users = User::find($id);
        $users->username = $request->username;
        $users->firstname = $request->firstname;
        $users->lastname = $request->lastname;
        $users->college = $request->college;
        $users->department = $request->department;
        $users->email = $request->email;
        $users->contact_no = $request->contact_no;
        $users->cust_code = $request->cust_code;
        $users->password = $request->password;
        $users->role = $request->role;
        
        $users->save();
        
        // Determine the redirect URL based on the role
        $redirectUrl = '/admin-view-accounts';
        if ($users->role === 'customer') {
            $redirectUrl = '/admin-view-customer-accounts';
        } elseif ($users->role === 'admin') {
            $redirectUrl = '/admin-view-admin-accounts';
        } elseif ($users->role === 'staff') {
            $redirectUrl = '/admin-view-staff-accounts';
        }

        return redirect($redirectUrl)->with('message', 'Account Updated Successfully');
    } catch (\Exception $ex) {
        return redirect('/admin-update-account/{accounts}')->with('message', 'Something went wrong');
    }
}

// deletion of account access by admin
public function DeleteAcc($id) {
    try {
        // Find the personal information by ID
       $accounts = User::find($id);

        // Check if the personal information exists
        if (!$accounts) {
            return redirect()->back()->with('error', 'Accounts not found');
        }

        // Delete the personal information data from the database
       $accounts->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Account Deleted Successfully');

    } catch (\Exception $e) {
        // Handle any exceptions and redirect back with error message
        return redirect()->back()->with('error', 'Error deleting personal information: ' . $e->getMessage());
    }
}

// admin view the customers orders only admin can access
public function customersOrders(){
    $trackcustomer= TrackOrders::with('usersName','orderlist')->orderBy('id','desc')->paginate(10);
    // $ordersCust->load('product','service_category','users'); // Assuming 'product' is the relationship name between OrderListing and Product
    $pendingOrders = OrderListing::where('order_status', 'Pending')->count();
    return view('admin.customerOrders.view_orders',compact('trackcustomer','pendingOrders'));
}
// updating 
public function ordersAdmin($id){
    $ordersEdit=TrackOrders::find($id);
    return view('admin.customerOrders.change',compact('ordersEdit'));
}

// update customer orders accessby admin
public function ordersCustoUpdate(Request $request,$id){
    try {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch the authenticated user
            $user = Auth::user();
         
        
            // $prefix = "31182000"; 
            // $id=IdGenerator::generate(['table'=> 'service_parameter','field'=> 'id','length'=>6,'prefix'=>$prefix]);
            // Create a new cart instance
            $cart = Trackorders::where('id', $id)->first();

            // Assign user's information to the cart instance
 // Handle image update if provided in the request
 if ($request->hasFile('image') && $request->file('image')->isValid()) {
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move('receiptimages', $imageName);

    // Delete old image file if it exists
    if ($cart ->image) {
        Storage::delete('receiptimages/' . $cart ->image);
    }

    // Update the cart 's image
    $cart ->image = $imageName;
}

            
            // Assign other relevant user information to corresponding columns in the cart table
            // $cart->id=$id;
            $cart->order_status= $request->order_status;
            // $cart->users_id= $request->users_id;
            // $cart->image= $request->image;
            // $cart->item_name= $request->item_name;
            // $cart->type= $request->type;
            // $cart->services= $request->services;
            // $cart->type_services= $request->type_services;
            // $cart->color= $request->color;
            // $cart->sizeof= $request->sizeof;
            // $cart->unit= $request->unit;
            // $cart->quantity= $request->quantity;
            // $cart->unit_price= $request->unit_price;
            // $cart->total_amount= $request->total_amount;
            // $cart->product_id= $request->product_id;
            // $cart->service_category_id= $request->service_category_id;
         
            // dd($cart);
            // Save the cart instance
            $cart->save();

            return redirect('/admin-view-customers-orders')->with('message', 'Order Updated Successfully');

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

// admin creating a new sizez
    public function NewSize(){

        $sizes= Sizes::orderBy('id','desc')->paginate(10);
        return view('admin.sizes.add_size_new',compact('sizes'));
    }
    // admin create new sizes
    public function AddNewSize(Request $request){
        try{
            // dd($request->all());
            // $data= $request->validated();
            // $data= $request->all();
            $newSize= new Sizes;
            $newSize->name_size=$request->name_size=== 'add_new' ? $request->new_sizes_name : $request->name_size;
        //    dd($newSize);
            $newSize->save();
            // Determine the redirect URL based on the role
           
    
            return redirect('/admin-add-sizes')->with('message', 'New Size added Successfully');
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect('/admin-add-sizes')->with('message','Wrong Input');
        }
    }

    // admin creating color
    public function AddColor(){
        $color= Colors::orderby('id','desc')->paginate(10);
        return view('admin.color.add_color',compact('color'));
    }
        // admin create new sizes
        public function AddColors(Request $request){
            try{
                // dd($request->all());
                // $data= $request->validated();
                // $data= $request->all();
                $newSize= new Colors;
                $newSize->color_name=$request->color_name=== 'add_new' ? $request->new_color_name: $request->color_name;
            //    dd($newSize);
                $newSize->save();
                // Determine the redirect URL based on the role
           
                
        
                return redirect('/admin-add-color')->with('message', 'New Color added Successfully');
            }
            catch(\Exception $ex){
                dd($ex);
                return redirect('/admin-add-color')->with('message','Wrong Input');
            }
        }
// admin creating new stock in
    public function addStockIn(){
        $stockin = ProductStockColors::with('sizes','product')
        ->orderBy('id', 'desc')
        ->paginate(10);
        $stockout = ProductStockOuts::with('sizestockout','productstockout','userstockout')
        ->orderBy('id', 'desc')
        ->paginate(10);
        $productColors = Product::all();
        $colors =Colors::all();
        $sizes =Sizes::all();
        return view('admin.stock-in.add_stock_in_out',compact('stockin','stockout','productColors','sizes','colors'));
    }

    public function Stockin(Request $request){
        try{
            // dd($request->all());
            // $data= $request->validated();
            // $data= $request->all();
          
            // Determine the redirect URL based on the role
                       
                // $colorsIds = array_unique($request->input('colors_id', []));
                // $sizesIds = array_unique($request->input('sizes_id', []));
                // $quantities = $request->input('quantities', []); // Get the array of quantities if provided

                // // Ensure that colorsIds, sizesIds, and quantities are arrays
                // if (!is_array($colorsIds)) {
                //     $colorsIds = explode(',', $colorsIds);
                // }
                // if (!is_array($sizesIds)) {
                //     $sizesIds = explode(',', $sizesIds);
                // }
                // if (!is_array($quantities)) {
                //     $quantities = explode(',', $quantities);
                // }

                // // Loop through the arrays of colors and sizes
                // foreach ($colorsIds as $colorsIndex => $colorsId) {
                //     foreach ($sizesIds as $sizesIndex => $sizesId) {
                //         // Ensure a valid quantity for the given combination
                //         $quantity = $quantities[$colorsIndex * count($sizesIds) + $sizesIndex] ?? 0;

                //         // Validate the quantity to be non-negative
                //         if ($quantity < 0) {
                //             // Handle invalid quantity (e.g., log an error or set quantity to zero)
                //             continue;
                //         }

                //         // Create a new instance of StockIns for each combination
                //         $newStock = new StockIns;
                //         $newStock->product_id = $request->product_id;
                //         $newStock->colors_id = $colorsId;
                //         $newStock->sizes_id = $sizesId;
                //         $newStock->quantity = $quantity;
                //         $newStock->stock_type = $request->stock_type;
                //         dd( $newStock);
                //         // Save the new stock entry to the database
                //         $newStock->save();
                //     }
                // }
            //     $prefix = "1915"; 
            // $id=IdGenerator::generate(['table'=> 'stock_ins','field'=> 'id','length'=>6,'prefix'=>$prefix]);
                // Retrieve and process the sizes and quantities from the request
                $sizesIds = $request->input('sizes_id', []);
                $quantities = $request->input('quantity', []);

                // Ensure that sizesIds and quantities are arrays and have the same length
                if (!is_array($sizesIds)) {
                    $sizesIds = explode(',', $sizesIds);
                }
                if (!is_array($quantities)) {
                    $quantities = explode(',', $quantities);
                }

                // Check if the sizes and quantities arrays have the same length
                if (count($sizesIds) !== count($quantities)) {
                    // Handle the error case where sizes and quantities arrays do not match in length
                    return response()->json(['error' => 'Sizes and quantities must have the same number of items'], 400);
                }

                // Loop through the arrays of sizes and quantities
                foreach ($sizesIds as $index => $sizesId) {
                    // Get the corresponding quantity from the quantities array
                    $quantity = $quantities[$index];

                    // Validate the quantity to be non-negative
                    if ($quantity < 0) {
                        // Skip invalid quantity values
                        continue;
                    }

                    // Create a new instance of StockIns or your model to represent the combination
                    $newStock = new StockIns();
                    // $newStock->id = $id;
                    $newStock->product_id = $request->product_id;
                    $newStock->sizes_id = $sizesId;
                    $newStock->quantity = $quantity;
                    $newStock->stock_type = $request->stock_type; // If stock_type is provided in the request
                    // dd($newStock);
                    // Save the new stock entry to the database
                    $newStock->save();
                }

    
            return redirect('/admin-add-stock-in')->with('message', 'New Stocks added Successfully');
        }
        catch(\Exception $ex){
            dd($ex);
            return redirect('/admin-add-stock-in')->with('message','Wrong Input');
        }
    }

    // pass dat of the product stock in to stock out
    public function EditStockInOut(Request $request,$id){

       
        $editstock = ProductStockColors::with('product','sizes')->findOrFail($id);
        $customer = User::all();
        return view('admin.stock-in.edit_stockIn_out',compact('editstock','customer'));

        // / Before using $editstock, check if it is valid
if (!$editstock) {
    // Handle the case where the record is not found
    abort(404, 'Product stock color not found.');
}

    }

    public function StoreStockout(Request $request,$id){
        try {
            // Retrieve the ProductStockColors instance
            $editstock = ProductStockColors::findOrFail($id);

// Convert inputs to arrays if necessary
$sizesIds = (array) $request->input('sizes_id');
$quantities = (array) $request->input('quantity');

// Ensure sizes and quantities arrays match in length
if (count($sizesIds) !== count($quantities)) {
    return redirect()->back()->with('error', 'Sizes and quantities must have the same number of items.')->withInput();
}

// Iterate through each size and quantity
foreach ($sizesIds as $index => $sizeId) {
    $quantity = $quantities[$index];

    // Check for negative quantities and return an error message if found
    if ($quantity < 0) {
        return redirect()->back()->with('error', 'Quantities cannot be negative. Please enter valid values.')->withInput();
    }

    // Find existing `ProductStockColors` entry
    $stockColor = ProductStockColors::where('product_id', $editstock->product_id)
                                    ->where('sizes_id', $sizeId)
                                    ->first();

    if ($stockColor) {
        // Update the existing entry's quantity
        $stockColor->quantity = $quantity; // Adjust quantity accordingly
        $stockColor->save();
    } else {
        // Create a new `ProductStockColors` entry with the quantity
        $newStockColor = new ProductStockColors();
        $newStockColor->product_id = $editstock->product_id;
        $newStockColor->sizes_id = $sizeId;
        $newStockColor->quantity = $quantity; // The quantity should not be negative for stock out
        
        // Save the new entry
        $newStockColor->save();
    }
}

                                    // Extract request data
                    $product_id = $editstock->product_id;
                    $sizes_id =  $editstock->sizes_id;
                    $users_id =  $request->users_id;;
                    $quantities = $request->quantities;

            // Create a new instance of `ProductStockOuts`
         // Find an existing ProductStockOuts entry with the same product_id, sizes_id, and users_id
                        $existingProductStockOut = ProductStockOuts::where('product_id', $product_id)
                        ->where('sizes_id', $sizes_id)
                        ->where('users_id', $users_id)
                        ->first();

                    if ($existingProductStockOut) {
                    // If an existing entry is found, update its quantity
                    $existingProductStockOut->quantities += $quantities;

                    // Save the updated entry
                    $existingProductStockOut->save();
                    } else {
                    // If no existing entry is found, create a new entry
                    $productStockOut = new ProductStockOuts();
                    $productStockOut->prodcut_stock_colors_id = $editstock->id;
                    $productStockOut->product_id = $editstock->product_id;
                    $productStockOut->sizes_id =  $editstock->sizes_id;
                    $productStockOut->users_id = $request->users_id;
                    $productStockOut->quantities = $request->quantities;
                    // dd( $productStockOut);
                    $productStockOut->save(); //check first the sizes id then add only quantities

                    // Save the new entry
                    $productStockOut->save();
}
    
    
            
    
            // Redirect back after processing
            return redirect()->route('admin.stock-in.add_stock_in_out')->with('message', 'Product Stock  Updated ');
        } catch (\Exception $e) {
            dd($e);
            // Handle any exceptions that occur during the process
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    // admin creating new stockout
    public function AddStockOut(){
        $stockout= StockOuts::orderBy('id','desc')->paginate(10);
        return view('admin.stockout.newstokin',compact('stockout'));

    }

    // admin check trackorders of customers
    public function TrackCustomers(){
        $trackcustomer= TrackOrders::with('usersName','orderlist')->orderBy('id','desc')->paginate(10);
        return view('admin.customerOrders.TrackCustomerOrders',compact('trackcustomer'));
    }

    // edit the track customers based on trackno
    public function CheckTrackordrs($trackNo){
         // Find orders with the specified track number or throw a 404 error if not found
         $checkorders = TrackOrders::where('trackno', $trackNo)->get();
         

    return view('admin.customerOrders.check_orders',compact('checkorders'));
    }
    public function editTrackordrs($trackNo){
        // Find orders with the specified track number or throw a 404 error if not found
        $OrdersStatus = TrackOrders::where('trackno', $trackNo)->get();
        

   return view('admin.customerOrders.edit_trackorders',compact('OrdersStatus'));
   }


    // storing of data
    public function viewtrackers($id){

        $viewdata= TrackOrders::find($id);
        return view('admin.customerOrders.change',compact('viewdata'));
    }


//    updata data
   public function neworders(Request $request,$id){
    try{
         // Find the order by ID
         $orderstatus = Trackorders::where('id', $id)->first();
        
         // Update the order status
        
         $orderstatus ->order_status = $request->status;   
        //  dd($orderstatus);
         $orderstatus ->save();
        return redirect('/admin-view-edit-customerOrders/{viewdata}')->with('message', 'New Size added Successfully');
    }
    catch(\Exception $ex){
        dd($ex);
        return redirect('/admin-view-edit-customerOrders/{viewdata}')->with('message','Wrong Input');
    }
}

// view all orders of the customer absed on track no
public function AllCustomersOrd($trackNo){
    // Find orders with the specified track number or throw a 404 error if not found
    $checkcustomers = TrackOrders::where('trackno', $trackNo)->get();
    

return view('admin.customerOrders.view_allorders',compact('checkcustomers'));
}
   }

