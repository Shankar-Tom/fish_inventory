@extends('layouts.app')
@include('admin.sidebar')
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
    </div>
  </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
      <h4 class="card-title mt-3">Products Details</h4>
      <div class="table-responsive">
        <table class="table">
          <thead class="table head-dark">
            <tr>
              <th>Product</th>
            
              <th>Port</th>
              <th>Purchased By</th>
              <th>Purchasing Weight</th>
              <th>Purchasing Rate</th>
              <th>Purchasing Payment Mode</th>
              <th>Sold By</th>
              <th>Selling Weights</th>
              <th>Total Weight</th>
              <th>Selling Rates</th>
              <th>Avg. Rate</th>
              <th>Selling Payment Mode</th>
              <th>Weight Diffrence </th>
              <th>Rate Diffrence</th>
              <th>Total Aamount Diffrence</th>
            
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Purchases as $purchase)
              
            @php
             $totalsellingweight=0;$avgsalerate=0; $i=0;

            @endphp


              <tr>
               
                <td>{{$purchase->Category->name}}</td>
                <td>{{$purchase->Port->port_name}}</td>
                <td>{{$purchase->Staff->name}}</td>
                <td>{{$purchase->weight}} KG</td>
                <td>{{$purchase->rate}} / Kg.</td>
                <td>{{$purchase->payment_mode}}</td>

                <td>@foreach ($purchase->Sale as $sale)
                  <span>{{$sale->Staff->name}}</span> <br>
                @endforeach</td>
                 <td>@foreach ($purchase->Sale as $sale)
                  <span>{{$sale->weight}} KG</span><br>
                  @php($totalsellingweight=$totalsellingweight+$sale->weight)
                @endforeach</td>
                <td>{{$totalsellingweight}}</td>


               
                <td>@foreach ($purchase->Sale as $sale)
                  <span>{{$sale->rate}} Rs/Kg</span> <br>
                  @php($avgsalerate=$avgsalerate+$sale->rate)
                  @php($i++)
                @endforeach</td>
                    <td>{{number_format($avgsalerate/$i,2)}}</td>


                <td>@foreach ($purchase->Sale as $sale)
                  <span>{{$sale->payment_mode}}</span> <br>
                @endforeach</td>
                @if($purchase->Sale )
                 <td>{{$totalsellingweight-$purchase->weight}} Kg</td>
                <td>{{number_format($avgsalerate/$i,2)-(float)$purchase->rate}} rs/g</td>
                <td> {{ (number_format($avgsalerate/$i,2)*$totalsellingweight)- ($purchase->weight*$purchase->rate) }}   rs </td>
                @else
                <td>Not Sold Yet</td>
                <td>Not Sold Yet</td>
                <td>Not Sold Yet</td>

                @endif
              @if(!$purchase->Sale)
                <td><a href="{{route('admin.delete.consigment.purchase',[$id->id,$purchase->id])}}" class="btn btn-sm btn-danger"> Delete</a></td>
                @else
                <td>Can't Delete</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title mt-3">Expenses On the Consigments</h4>
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Amount</th>
                <th>Expense For</th>
                <th>Expense By</th>
                <th>User details</th>
                <th>Action Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($id->Expenses as $expense)
                <tr>
                  <td>{{$expense->amount}}</td>
                  <td>{{$expense->expense_for}}</td>
                  <td>{{$expense->added_by}}</td>
                  @if($expense->added_by=='staff')
                  <td>{{$expense->Staff->name}}</td>
                  @elseif ($expense->added_by=='admin')
                  <td>{{$expense->Admin->name}}</td>
                  @endif
                  <td><a href="{{route('admin.deleteexpense',[$expense->id])}}" class="btn btn-danger btn-sm"> Delete</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <h4 class="card-title mt-3">Add Expense</h4>
          <form action="{{route('admin.saveexpense',[$id->id])}}" method="post">
            @csrf
            <input type="text" name="amount"  placeholder="Amount" class="form-control m-2" value="{{old('amount')}}" autofocus>
            <input type="text" name="expense_for"  placeholder="Expense For" class="form-control mb-2" value="{{old('expense_for')}}">
            <button type="submit" class="btn btn-primary">Save Expense</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>