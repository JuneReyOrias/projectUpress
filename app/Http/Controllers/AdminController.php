<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\OrderListing;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        return view('admin.index');
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
  
    return view('products.index');
}


// adding new productyadmin
public function addproduct(ProductRequest $request){
    try {
        // Create a new Product instance
        // $prefix = "161815400"; 
        // $id=IdGenerator::generate(['table'=> 'product','field'=> 'id','length'=>7,'prefix'=>$prefix]);
        // Generate a new unique ID
  

        $data = new Product;
    
        // Check if a file is present in the request and if it's valid
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Retrieve the image file from the request
            $image = $request->file('image');
    
            // Generate a unique image name using current timestamp and file extension
            $imagename = time() . '.' . $image->getClientOriginalExtension();
    
            // Move the uploaded image to the 'productimages' directory with the generated name
            $image->move('productimages', $imagename);
    
            // Set the image name in the Product data
            $data->image = $imagename;
        } else {
            // Handle case where no valid image was uploaded
            // You can throw an exception or perform any other action
            throw new \Exception('No valid image uploaded.');
        }
    
        // Assign other fields from the request to the Product data
        // $data->id = $id;
        $data->prod_code = $request->prod_code;
        $data->product_name = $request->product_name;
        $data->descritpion = $request->descritpion;
        $data->size = $request->size;  
        $data->color = $request->color;
        $data->unit_price = $request->unit_price;
        $data->stocks = $request->stocks;
        $data->status = $request->status;
        // dd($data);
        // Save the Product data to the database
        $data->save();
    
        // Redirect back after processing
        return redirect()->route('products.add_product')->with('message','Product Added Successfully');
    
    } catch (\Exception $e) {
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
    $ordersCust= OrderListing::OrderBy('id','desc')->paginate(10);
    // $ordersCust->load('product','service_category','users'); // Assuming 'product' is the relationship name between OrderListing and Product
    $pendingOrders = OrderListing::where('order_status', 'Pending')->count();
    return view('admin.customerOrders.view_orders',compact('ordersCust','pendingOrders'));
}
// updating 
public function ordersAdmin($id){
    $ordersEdit=OrderListing::find($id);
    return view('admin.customerOrders.edit_orders',compact('ordersEdit'));
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
            $cart = OrderListing::where('id', $id)->first();

            // Assign user's information to the cart instance


            
            // Assign other relevant user information to corresponding columns in the cart table
            // $cart->id=$id;
            $cart->order_status= $request->order_status;
            $cart->users_id= $request->users_id;
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

}
