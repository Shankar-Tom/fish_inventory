<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SPM Seafoods</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" />
</head>
@livewireStyles()

@yield('page')
   
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
     
            <!-- partial -->
          </div>
          <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.layroad.com/" target="_blank">LayRoad </a>{{date('Y')}}</span>
        </div>
        </footer>
      <!-- plugins:js -->
      <script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
      <script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
      <script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="{{asset('js/off-canvas.js')}}"></script>
      <script src="{{asset('js/hoverable-collapse.js')}}"></script>
      <script src="{{asset('js/template.js')}}"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="{{asset('js/dashboard.js')}}"></script>
      <script src="{{asset('js/data-table.js')}}"></script>
      <script src="{{asset('js/jquery.dataTables.js')}}"></script>
      <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
      <!-- End custom js for this page-->
      @livewireScripts()
      <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
      @include('layouts.flashmsg')
      
      @stack('script')

    </body>
    
    </html>
    
    