<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Orders\OrderListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sales\ServiceCategoryController;
use App\Http\Controllers\sales\ServiceParameterController;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Orders\PurchaseOrderController;
use App\Http\Controllers\sales\MaterialController;
use App\Http\Controllers\sales\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Models\ServiceParameter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// view customers all orders
Route::get('/customer-view-all-orders/{trackNo}', [CustomerController::class, 'CheckAllorders'])->name('customer.orderlist.all_orders_view');

// viewl all order
Route::get('/admin-view-allCustomers-orders/{trackNo}',[AdminController::class,'AllCustomersOrd'])->name('admin.customerOrders.view_allorders');


// TrackCustomer admin.customerOrders.edit_trackorders
Route::get('/admin-view-track-customerOrders',[AdminController::class,'TrackCustomers'])->name('admin.customerOrders.TrackCustomerOrders');
Route::get('/admin-view-check-customerOrders/{trackNo}',[AdminController::class,'CheckTrackordrs'])->name('admin.customerOrders.check_orders');
Route::get('/admin-view-update-customerOrders/{trackNo}',[AdminController::class,'editTrackordrs'])->name('admin.customerOrders.edit_trackorders');
// Route::post('/admin-view-update-customerOrders/{id}',[AdminController::class,'ConfirmsOrdrs']);
// Route::get('/admin-view-edit-Orders/{viewdata}',[AdminController::class,'viewtrackers'])->name('admin.customerOrders.change');
// Route::post('/admin-view-edit-Orders/{viewdata}',[AdminController::class,'neworders']);


// add cart
Route::get('/cart',[CustomerController::class, 'ViewCart'])->name('cart.addcart');
// admiin addnew stock out
Route::get('/admin-add-stock-out',[AdminController::class,'AddStockOut'])->name('admin.stockout.newstokin');

// admin add new stock in
Route::get('/admin-add-stock-in',[AdminController::class,'AddStockIn'])->name('admin.stock-in.add_stock_in_out');
Route::post('/admin-add-stock-in',[AdminController::class,'Stockin']);
Route::get('/admin-update-stock-in/{editstock}',[AdminController::class,'EditStockInOut'])->name('admin.stock-in.edit_stockIn_out');
Route::post('/admin-update-stock-in/{editstock}',[AdminController::class,'StoreStockout']);
// admin add new color
Route::get('/admin-add-color',[AdminController::class,'AddColor'])->name('admin.color.add_color');
Route::post('/admin-add-color',[AdminController::class,'AddColors']);
// add new sizes access by admin
Route::get('/admin-add-sizes',[AdminController::class,'NewSize'])->name('admin.sizes.add_size_new');
Route::post('/admin-add-sizes',[AdminController::class,'AddNewSize']);

// add unique code
Route::get('/add-unique-code',[AdminController::class,'UniqueCode'])->name('code.add_codename');
Route::post('/add-unique-code',[AdminController::class, 'addcodes']);
Route::get('/admin-add-product',[AdminController::class, 'fetchcode'])->name('products.index');
Route::post('/admin-add-product',[AdminController::class, 'addproduct']);
// Route::get('/product-show',[ProductController::class, 'fetchcode'])->name('products.index');

//homepages content
Route::get('/',[HomePageController::class, 'Home'])->name('homepage.upress_homepage');
Route::get('/upress-product',[HomePageController::class,'OurProducts'])->name('homeproduct.view');
Route::get('/upress-services',[HomePageController::class,'OurServices'])->name('homeservices.serve');
Route::get('/upress-aboutus',[HomePageController::class,'OurAbout'])->name('homeabout.about');
Route::get('/upress-contactus',[HomePageController::class,'OurContact'])->name('homecontact.contacts');
// product orders by customer
Route::get('/purchase/product',[OrderListingController::class, 'CreateOrder'])->name('customer.product.add_orders');
Route::get('/purchase/services',[OrderListingController::class, 'CreateServices'])->name('customer.service.add_services');
//purchase order view
Route::get('/purchase',[PurchaseOrderController::class, 'addpurchase'])->name('customer.purchase.view_purchase');

//material insertt of datta by admin
Route::get('/material',[MaterialController::class,'material'])->name('material.new_materials');
Route::post('/material',[MaterialController::class,'addmaterials']);

//service parameter insertion of data
Route::get('/service-param',[ServiceParameterController::class,'servicedata'])->name('servicescat.index');
Route::post('/service-param',[ServiceParameterController::class,'addserviceParam']);

Route::get('/service-show',[ServiceParameterController::class,'show'])->name('servicescat.show');
Route::get('/service-param/{project}',[ServiceParameterController::class,'updateView'])->name('servicescat.serviceparam.update');
Route::post('/service-param/{project}',[ServiceParameterController::class,'updateservice']);
Route::delete('/service-param/{project}',[ServiceParameterController::class, 'servicedelete'])->name('servicescat.serviceparam.delete');
// Route::get('/service-param/{project}',[ServiceCategoryController::class,'servicenew'])->name('servicescat.serviceparam.update');


// services category
Route::get('/admin-view-services',[ServiceCategoryController::class,'ServicesCat'])->name('servicescat.add_services');//view of all of services by admin

Route::get('/admin-add-new-services',[ServiceCategoryController::class,'serviceParam'])->name('servicescat.new_servcat');//adding of new services access by admin
Route::post('/admin-add-new-services',[ServiceCategoryController::class,'Newstore']);

Route::get('/admin-updatee-services/{servicescat}',[ServiceCategoryController::class, 'serviceshow'])->name('servicescat.update_services');//edit page of services access only by admin
Route::post('/admin-updatee-services/{servicescat}',[ServiceCategoryController::class, 'updateservices']);
Route::delete('/admin-delete-services/{servicescat}',[ServiceCategoryController::class,'servicesdelete'])->name('servicescat.delete_services');

//products add controller 
Route::get('/admin-view-products',[ProductController::class, 'Product'])->name('products.add_product');

Route::delete('/productdelete/{product}',[ProductController::class,'productdelete'])->name('product.destroy');
Route::get('/admin-update-product/{product}',[ProductController::class, 'updateviews'])->name('products.update_product');
Route::post('/admin-update-product/{product}',[ProductController::class, 'productupdate']);




// //profile
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
  
// admin page
Route::middleware(['auth','role:admin','PreventBackHistory'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashb'])->name('admin.dashb');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/{profileData}',[AdminController::class,'updateAdmin']);
    // Route::patch('/admin/profile', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    // Route::get('/admin',[UserController::class,'Profiles'])->name('admin.body.header');
    Route::get('/admin-add',[AdminController::class,'accounts'])->name('admin.accounts.create_account');

});
  
// staff page
Route::get('/staff/dashboard', [StaffController::class, 'AgentDashboard'])->name('staff.staff_dashboard');

Route::get('/staff/logout', [StaffController::class, 'staffLogout'])->name('staff.logout');

Route::middleware(['auth','role:customer','PreventBackHistory'])->group(function () {
//customer page dashboard
    Route::get('/customer/dashboard', [CustomerController::class, 'CustomersDashboard'])->name('customer.customer_dashboard');
    Route::get('/customer/logout', [CustomerController::class, 'CustomerLogout'])->name('customer.logout');

   
// customer add services
Route::get('/customer-add-services',[ProductController::class, 'addServices'])->name('customer.product.add_services');
});

// update customer profiles
Route::get('/customer-profiles', [CustomerController::class, 'Customerprof'])->name('customer.profile.new_update');
Route::post('/customer-profiles', [CustomerController::class, 'custProfile']);

// customer product view, order
Route::get('/customer-upress-product', [CustomerController::class, 'displayProduct'])->name('customer.custproduct.prod_view');

// customer view the services offer by upress
Route::get('/customer-upress-services', [CustomerController::class, 'ViewOfferServices'])->name('customer.custservices.service_view');
// adding cart of services by customers
Route::post('/customer-upress-services', [CustomerController::class, 'Servicescart']);


// adding orders to cart
Route::get('/customer-add-cart', [CustomerController::class, 'AddToCart'])->name('customer.addcart.cart_order');
Route::delete('/customer-delete-cart/{cart}', [CustomerController::class, 'cartdelete'])->name('customer.addcart.delete');
Route::get('/customer-edit-product/{cart}', [CustomerController::class, 'cartforedit'])->name('customer.addcart.edit_cart');
Route::post('/customer-edit-product/{cart}', [CustomerController::class, 'UpdateCarts']);
// edit cart of services by customers
Route::get('/customer-edit-services/{cart}', [CustomerController::class, 'cartEditServices'])->name('customer.addcart.edit_cart_services');//edit link for services orders update
Route::post('/customer-edit-services/{cart}', [CustomerController::class, 'cartUpdateServices']);//fetch new update of services order customers

// adding orders to cart
Route::post('/customer-upress-product', [CustomerController::class, 'CartNew']);
Route::get('/getProductDetails/{cart}', [CustomerController::class, 'getProductDetails'])->name('getProductDetails');

// orderlisting of customer
Route::get('/customer-confirm-order',[CustomerController::class, 'confirmOrders'])->name('customer.orderlist.confirm_order');
Route::post('/customer-confirm-order',[CustomerController::class, 'OrderList']);
Route::get('/customer-orderslip',[CustomerController::class,'Receipt'])->name('customer.orderlist.receipt_order');
Route::get('/customer-orderlist',[CustomerController::class,'newlist'])->name('customer.orderlist.view_orders');


// rack orders by customers
Route::get('/customer-track-orders',[CustomerController::class,'trackOrder'])->name('customer.trackorders.view_track');


// creatimg accounts access by admin
Route::get('/admin-view-customer-accounts',[AdminController::class,'NewAccounts'])->name('admin.accounts.view_users_acc');//view customer accounts
Route::get('/admin-view-admin-accounts',[AdminController::class,'adminInfo'])->name('admin.accounts.view_admin');//view admin accounts
Route::get('/admin-view-staff-accounts',[AdminController::class,'staffInfo'])->name('admin.accounts.views_staff');//view staff accounts
Route::get('/admin-add-new-accounts',[AdminController::class,'createAcc'])->name('admin.accounts.add_new_acc');//adding new accounts 
Route::post('/admin-add-new-accounts',[AdminController::class,'AccountAdd']);//store new accounts
Route::get('/admin-update-account/{accounts}',[AdminController::class,'EditAccount'])->name('admin.accounts.update_acc');//fetch accounts id or find the  Id 
Route::post('/admin-update-account/{accounts}',[AdminController::class,'UpdateAccount']);//update the accounts
Route::delete('/admin-delete-accounts/{accounts}',[AdminController::class,'DeleteAcc'])->name('admin.accounts.delete');//deleting  accounts


// orders view by admin 
Route::get('/admin-view-customers-orders',[AdminController::class, 'customersOrders'])->name('admin.customerOrders.view_orders');
Route::get('/admin-check-customers-orders/{ordersEdit}',[AdminController::class,'ordersAdmin'])->name('admin.customerOrders.change');
Route::post('/admin-check-customers-orders/{ordersEdit}',[AdminController::class,'ordersCustoUpdate']);




