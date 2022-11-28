@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
              <div class="me-md-3 me-xl-5">
                <h2>Welcome back,</h2>
                <p class="mb-md-0">Your report is Here</p>
              </div>
           
            </div>
           
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body dashboard-tabs p-0">
              <ul class="nav nav-tabs px-4" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Todays Overview</a>
                </li>
              
              </ul>
              <div class="tab-content py-0 px-0">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                  <div class="d-flex flex-wrap justify-content-xl-between">
                    <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                      <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                      <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Date</small>
                        <div class="dropdown">
                          <a class="btn btn-secondary  p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" >
                            <h5 class="mb-0 d-inline-block">{{date('d M Y')}}</h5>
                          </a>
                         
                        </div>
                      </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                      <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Total Purchase </small>
                        <h5 class="me-2 mb-0">{{\App\Models\Purchase::whereDate('created_at',date('d M Y'))->sum('weight')}} Kg</h5>
                      </div>
                    </div>
           
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                      <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Total Sale</small>
                        <h5 class="me-2 mb-0">{{\App\Models\Sale::whereDate('created_at',date('d M Y'))->sum('weight')}} Kg</h5>
                      </div>
                    </div>
                    <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                      <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Total Genral Expense</small>
                        <h5 class="me-2 mb-0">{{\App\Models\GenralExpense::where('created_at',date('d M Y'))->sum('amount')}}</h5>
                      </div>
                    </div>
                    <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                      <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Total Genral Expense</small>
                        <h5 class="me-2 mb-0">{{\App\Models\Expense::where('created_at',date('d M Y'))->sum('amount')}}</h5>
                      </div>
                    </div>
                  </div>
                </div>
  
              
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <div class="col-md-6">
          <div class="card">
            <div id="barchart_values" style="height: auto;" ></div>
         
            @php($purchases=\App\Models\Purchase::selectRaw("sum(weight) as total_weight ,(DATE_FORMAT(created_at, '%d-%m-%Y')) as date")->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->limit(10)->get())

                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ["Date", "Weight", { role: "style" } ],
                            @foreach ($purchases as $purchase)
                              ["{{$purchase->date}}",{{$purchase->total_weight}},'green'],
                            @endforeach
                            
                           
                          ]);

                          var view = new google.visualization.DataView(data);
                          view.setColumns([0, 1,
                                          { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                          2]);

                          var options = {
                            title: "Total Purchase Weight in day",
                            width: 600,
                            height: 400,
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                          };
                          var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                          chart.draw(view, options);
                      }
                      </script>
                      </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div id="sales" style="height: auto;" ></div>
         
@php($sales=\App\Models\Sale::selectRaw("sum(weight) as total_weight ,(DATE_FORMAT(created_at, '%d-%m-%Y')) as date")->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))->limit(10)->get())

                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ["Date", "Weight", { role: "style" } ],
                            @foreach ($sales as $sale)
                              ["{{$sale->date}}",{{$sale->total_weight}},'red'],
                            @endforeach
                            
                           
                          ]);

                          var view = new google.visualization.DataView(data);
                          view.setColumns([0, 1,
                                          { calc: "stringify",
                                            sourceColumn: 1,
                                            type: "string",
                                            role: "annotation" },
                                          2]);

                          var options = {
                            title: "Total Sale Weight in day",
                            width: 600,
                            height: 400,
                            bar: {groupWidth: "95%"},
                            legend: { position: "none" },
                          };
                          var chart = new google.visualization.BarChart(document.getElementById("sales"));
                          chart.draw(view, options);
                      }
                      </script>

        
        </div>
         
        </div>
        <div class="col-md-6">
          <div class="card">
            <div id="piechart_3d" style="height: 30vh;"></div>
            @php($expenses=\App\Models\GenralExpense::selectRaw('sum(amount) as total_amount,expense_category_id')->with('Category')->groupBy('expense_category_id')->get())
         
            <script type="text/javascript">
              google.charts.load("current", {packages:["corechart"]});
              google.charts.setOnLoadCallback(drawChart);
              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Category', 'Expense In Amount'],
                  @foreach ($expenses as $expense)
                  ['{{$expense->Category->name}}', {{$expense->total_amount}}],
                  @endforeach
                 
                 
                ]);
        
                var options = {
                  title: 'Category Wise Expenses',
                  is3D: true,
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
              }
            </script>
        
          </div>
        </div>
      </div>