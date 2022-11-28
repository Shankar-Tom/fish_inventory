<body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
          <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
            <a class="navbar-brand brand-logo" href="{{route('staff.dashboard')}}"> 
               <img src="{{asset('logo.png')}}" alt="logo">
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{route('staff.dashboard')}}">                 
               <img src="{{asset('logo.png')}}" alt="logo">
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
                
                <span class="nav-profile-name">{{Auth('staff')->user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="{{route('staff.logout')}}">
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
              <a class="nav-link" href="{{route('staff.dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="ui-basic">
                  <i class="mdi mdi-circle-outline menu-icon"></i>
                  <span class="menu-title">Purcahse Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="purchase">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.purchase.entry')}}">Purchase Entry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.purchase.view')}}">Purchase View</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#congsigment" aria-expanded="false" aria-controls="ui-basic">
                  <i class="mdi mdi-circle-outline menu-icon"></i>
                  <span class="menu-title">Congsigment Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="congsigment">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.view.consigment')}}">View Consigments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.create.consigment')}}">Create Congsinment</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="ui-basic">
                  <i class="mdi mdi-circle-outline menu-icon"></i>
                  <span class="menu-title">Sales Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="sales">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.sales')}}">Sales View</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('staff.saleable')}}">Sale Entry</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('staff.expenses')}}">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">View Expenses</span>
                </a>
              </li>
           
       
          
            
          </ul>
        </nav>