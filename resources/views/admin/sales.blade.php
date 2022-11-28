@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Sales </h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Sale By</th>
                  <th>Product Detail </th>
                <th>Buyer Name</th>
                <th>Weight</th>
                <th>Rate </th>
                <th>Total Sold  </th>
                <th>Payment Mode  </th>
                <th>Edited By Admin</th>
                <th>Action</th>
              </tr>
            </thead>
            @php($sales=\App\Models\Sale::latest('created_at')->paginate(10))
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                      <td>{{$sale->Staff->name}}</td>
                      <td>{{$sale->Purchase->Category->name}} - {{$sale->Purchase->weight}} kg - From Port-  {{$sale->Purchase->Port->port_name}}</td>
                        <td>{{$sale->Buyer->name}}</td>
                        <td>{{$sale->weight}} Kg</td>
                        <td>{{$sale->rate}} rs/kg</td>
                        <td>{{$sale->full_sold?'Yes':'No'}}</td>
                        <td>{{$sale->payment_mode}}</td>
                        <td>{{$sale->Admin->name??'Not Edited'}}</td>
                        <td> <a href="{{route('admin.sale.edit',[$sale->id])}}" class="btn btn-secondary btn-sm">Edit</a> </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    
    
