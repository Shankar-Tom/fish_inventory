@extends('layouts.app')
@include('staff.sidebar')
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
       