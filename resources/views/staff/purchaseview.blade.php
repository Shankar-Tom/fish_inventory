@extends('layouts.app')
@include('staff.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Purchases</h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Product Name</th>
                <th>Port </th>
                <th>Purchased From</th>
               
                <th> Weight </th>
                <th> Rate</th>
                <th>Payment Mode</th>
                <th>Date Time</th>
              </tr>
            </thead>
            @php($purchases=\App\Models\Purchase::where('staff_id',Auth('staff')->id())->latest('created_at')->paginate(10))
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                      <td>{{$purchase->Category->name}}</td>
                        <td>{{$purchase->Port->port_name}}</td>
                        <td>{{$purchase->Purchasefrom->party_name}}</td>
                       
                        <td>{{$purchase->weight}} Kg.</td>
                        <td>{{$purchase->rate}} Rs./Kg.</td>
                        <td>{{$purchase->payment_mode}}</td>
                        <td>{{$purchase->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          {{$purchases->links()}}
        </div>
      </div>
    </div>
  </div>
</div>
    
    
