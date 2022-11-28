
<body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
          <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
            <a class="navbar-brand brand-logo" href="{{route('admin.dashboard')}}">                  <img src="{{asset('logo.png')}}" alt="logo">
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{route('admin.dashboard')}}">                  <img src="{{asset('logo.png')}}" alt="logo">
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-sort-variant"></span>
            </button>
          </div>  
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
         
          <ul class="navbar-nav navbar-nav-right">
            
          
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="images/faces/face5.jpg" alt="profile"/>
                <span class="nav-profile-name">{{Auth('admin')->user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{route('admin.profile')}}">
                  <i class="mdi mdi-settings text-primary"></i>
                 Profile
                </a>
                <a class="dropdown-item" href="{{route('admin.logout')}}">
                  <i class="mdi mdi-logout text-primary" ></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#staff" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Staff  Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="staff">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.createstaff')}}">Create Staff</a></li>
                  <li class="nav-item"> <a class="nav-link"href="{{route('admin.liststaff')}}">View Staff</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.ports')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Ports</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.categories')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Products</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.sellers')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Seller Party</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.buyers')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Buyers Party</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Purchase  Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="purchase">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.create.puchase')}}">Create Purchase</a></li>
                  <li class="nav-item"> <a class="nav-link"href="{{route('admin.purchases')}}">View Purchases</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#consigment" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Consigments  Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="consigment">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.congsinments.create')}}">Create Consigments</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.congsinments')}}">View Consigments</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#sale" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Sale Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="sale">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.sale.create')}}">Create Sale</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.sales')}}">View Sale</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.general.expense')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">General Expenses</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ledger" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Ledger Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ledger">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.purchase.ledger')}}">Purchase Ledger</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.sale.ledger')}}">Sale Ledger</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.party.ledger')}}">Party Ledger</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.product.ledger')}}">Product Ledger</a></li>

                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#bill" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Bill Management</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="bill">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link"  href="{{route('admin.bill.seller')}}">Seller Bills</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.bill.buyer')}}">Buyer Bills</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('admin.bill.all')}}">All Bills</a></li>

                </ul>
              </div>
            </li>
          
       
          
          </ul>
        </nav>