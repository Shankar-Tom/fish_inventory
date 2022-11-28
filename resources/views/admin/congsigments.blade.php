@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Congsiments</h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Created By</th>
                <th>Vehicle Number</th>
                <th>Total Weight</th>
                <th>Total Expense</th>
                <th>Date Time</th>
                <th>Action</th>
              </tr>
            </thead>
            @php($consigments=\App\Models\Consignment::latest('created_at')->paginate(10))
            <tbody>
                @foreach ($consigments as $consigment)
                    <tr>
                        <td>{{$consigment->Staff->name}}</td>
                        <td>{{$consigment->vehicle_number}}</td>
                        <td>{{$consigment->total_weight}} kg</td>
                        <td>{{$consigment->Expenses->sum('amount')}} RS</td>
                        <td>{{$consigment->created_at}}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{route('admin.congsinment.details',[$consigment->id])}}">View </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>