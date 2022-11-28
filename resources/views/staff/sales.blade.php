@extends('layouts.app')
@include('staff.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Sales By You </h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Buyer Name</th>
                <th>Product</th>
                <th>Weight</th>
                <th>Rate </th>
                <th>Total Sold  </th>
                <th> Payment</th>
              </tr>
            </thead>
            @php($sales=\App\Models\Sale::where('staff_id',Auth('staff')->id())->latest('created_at')->paginate(10))
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{$sale->Buyer->name}}</td>
                        <td>{{$sale->Purchase->Category->name}}</td>
                        <td>{{$sale->weight}} Kg</td>
                        <td>{{$sale->rate}} rs/kg</td>
                        <td>{{$sale->full_sold?'Yes':'No'}}</td>
                        <td>{{$sale->payment_mode}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    
    
