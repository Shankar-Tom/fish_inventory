@extends('layouts.app')
@include('admin.sidebar')

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
        
                <th>Purchased By</th>
                <th>Product Name</th>
                <th>Port </th>
                <th>Purchased From</th>
                <th>Weight </th>
                <th>Rate</th>
                <th>Payment Mode</th>
                <th>Congsigned</th>
                <th>Edit Admin</th>
                <th>Action</th>
           
            </thead>
            @php($purchases=\App\Models\Purchase::latest('created_at')->paginate(10))
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                      <td>{{$purchase->Staff->name}}</td>
                      <td>{{$purchase->Category->name}}</td>
                        <td>{{$purchase->Port->port_name}}</td>
                        <td>{{$purchase->Purchasefrom->party_name}}</td>
                         <td>{{$purchase->weight}} Kg.</td>
                        <td>{{$purchase->rate}} Rs./Kg.</td>
                        <td>{{$purchase->payment_mode}}</td>
                        <td>{{$purchase->Consigned?'Yes':'No'}} </td>
                        <td>{{$purchase->Admin->name??'Not Edited'}}</td>
                        <td><a href="{{route('admin.purchase.edit',[$purchase->id])}}" class="btn btn-sm btn-secondary">Edit</a></td>
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
    
    
