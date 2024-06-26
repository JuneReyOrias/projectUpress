<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        UPRESS
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('admin.dashb')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
          <li class="nav-item nav-category">Components</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#stockin" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="hard-drive"></i>
              <span class="link-title">Stock</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="stockin">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.stock-in.add_stock_in_out') }}" class="nav-link">Stock list</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.stock-in.stock_records') }}" class="nav-link">Stock Records</a>
                    </li>
                </ul>
            </div>


            
          </li>
         
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sizes" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="layout"></i>
              <span class="link-title">Sizes</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="sizes">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.sizes.add_size_new')}}" class="nav-link">Add Sizes</a>
                </li>
               

                
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#color" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="hexagon"></i>
              <span class="link-title">Color</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="color">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.color.add_color')}}" class="nav-link">Add Color</a>
                </li>
  
              </ul>
            </div>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
              <i class="link-icon" data-feather="shopping-bag"></i>
              <span class="link-title">Products</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="uiComponents">
              <ul class="nav sub-menu">
                <!-- <li class="nav-item">
                  <a href="{{route('products.add_product')}}" class="nav-link">Add Products</a>
                </li> -->
                <li class="nav-item">
                  <a href="{{route('products.add_product')}}" class="nav-link">Product list</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.sizes.add_size_new')}}" class="nav-link">Sizes</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.color.add_color')}}" class="nav-link">Color</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
              <i class="link-icon" data-feather="layers"></i>
              <span class="link-title">Services</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="advancedUI">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('servicescat.add_services')}}" class="nav-link">Service Lists</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Pending Services</a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">Approved Services</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">Completed Services</a>
                </li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
              <i class="link-icon" data-feather="shopping-cart"></i>
              <span class="link-title">Orders</span> {{--<span class="badge bg-primary"> 0</span>---}}
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="forms">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.customerOrders.view_orders')}}" class="nav-link">Customer Orders</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.customerOrders.TrackCustomerOrders')}}" class="nav-link">Track Customer Orders</a>
                </li>
              </ul>
            </div>
          </li> -->
          <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#orders" role="button" aria-expanded="false" aria-controls="orders">
            <i class="link-icon" data-feather="shopping-cart"></i>
            <span class="link-title">Orders</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="orders">
            <ul class="nav sub-menu">
              <li class="nav-item">
                  <a href="{{ route('product.ordering') }}" class="nav-link">Product Ordering</a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{ route('admin.customerOrders.view_orders') }}" class="nav-link">Customer Orders</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.customerOrders.TrackCustomerOrders') }}" class="nav-link">Track Customer Orders</a>
              </li> -->
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#transaction" role="button" aria-expanded="false" aria-controls="transaction">
            <i class="link-icon" data-feather="credit-card"></i>
            <span class="link-title">Transaction Records</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="transaction">
            <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('admin.transaction_records') }}" class="nav-link">Transaction Records</a>
            </li>

              <!-- Additional transaction record links can be added here -->
            </ul>
          </div>
        </li>



          {{-- <li class="nav-item">
            <a class="nav-link"  data-bs-toggle="collapse" href="#sales" role="button" aria-expanded="false" aria-controls="calendar">
              <i class="link-icon" data-feather="bar-chart-2"></i>
              <span class="link-title">Sales</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="sales">
              <ul class="nav sub-menu">
                <li class="nav-item">
          
                  <li class="nav-item">
                    <a href="p" class="nav-link">Weekly Sales</a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">Monthly Sales</a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">Annual Sales</a>
                  </li>
                 
              </ul>
            </div>
          </li> <li class="nav-item">
            <a class="nav-link"  data-bs-toggle="collapse" href="#revenue" role="button" aria-expanded="false" aria-controls="charts">
              <i class="link-icon" data-feather="pie-chart"></i>
              <span class="link-title">Revenue</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="revenue">
              <ul class="nav sub-menu">
              
                <li class="nav-item">
                  <a href="" class="nav-link">Monthly Revenue</a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">Yearly Revenue</a>
                </li>
              </ul>
            </div>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
              <i class="link-icon" data-feather="book"></i>
              <span class="link-title">Note List</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav sub-menu">
                <li class="nav-item"> 
                  <a href="pages/tables/basic-table.html" class="nav-link">Note List</a>
                </li>
              
              </ul>
            </div>
          </li> --}}
          
          <li class="nav-item nav-category">Accounts</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Users</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="general-pages">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{route('admin.accounts.view_users_acc')}}" class="nav-link">Account informations</a>
                </li>
                <!-- <li class="nav-item">
                  <a href="{{route('admin.accounts.view_admin')}}" class="nav-link"> Admin</a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.accounts.views_staff')}}" class="nav-link">Staff
                    </a>
                </li> -->
        </ul>
      </div>
    </nav>