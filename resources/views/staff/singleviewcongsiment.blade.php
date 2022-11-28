@extends('layouts.app')
@include('staff.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <div class="row">
        <div class=" col-6">
          <h4 class="card-title">Consigment Details</h4>
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Vehicle Number</th>
                <th>Total Weight</th>
                <th>Date Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$id->vehicle_number}}</td>
                <td>{{$id->total_weight}} KG</td>
                <td>{{$id->created_at}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-6">
          <h4 class="card-title">Vehicle Image</h4>
          <img src="{{asset($id->vehicle_image)}}" alt="">
        </div>
      </div>
        <h4 class="card-title">Products Details</h4>
        <table class="table">
          <thead class="table head-dark">
            <tr>
              <th>Product</th>
              <th>Category</th>
              <th>Port</th>
              <th>Weight</th>
              <th>Rate</th>
              <th>Payment Mode</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($id->Purchases as $purchase)
              <tr>
                <td>{{$purchase->product}}</td>
                <td>{{$purchase->Category->name}}</td>
                <td>{{$purchase->Port->port_name}}</td>
                <td>{{$purchase->weight}} KG</td>
                <td>{{$purchase->rate}} / Kg.</td>
                <td>{{$purchase->payment_mode}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
      <form action="{{route('staff.store.expense',[$id->id])}}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Expense Amount</label>
          <input type="text" name="amount" id="" placeholder="Expense Amount" class="form-control">

        </div>
        <div>
          <label for="">Expense Note</label>
          <input type="text" name="note" placeholder="Expense Note" class="form-control">

        </div>
          <input type="submit" value="Add Expense" class="btn btn-primary btn-lg mt-3">
      </form>
    </div>
    </div>
  </div>
</div>