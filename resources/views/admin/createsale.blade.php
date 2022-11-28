@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Consigments For Sale</h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Vehicle Number</th>
                <th>Total Weight</th>
                <th>Consignment Created By</th>
                <th>Date Time</th>
                <th>Action</th>
              </tr>
            </thead>
            @php($consigments=\App\Models\Consignment::whereHas('SomeLeft')->orWhereDoesntHave('Sale')->paginate(10))
            <tbody>
              @forelse ($consigments as $consigment)
                  <tr>
                    <td>{{$consigment->vehicle_number}}</td>
                    <td>{{$consigment->total_weight}}</td>
                    <td>{{$consigment->Staff->name??'n/a'}}</td>
                    <td>{{$consigment->created_at}}</td>
                    <td><a class="btn btn-sm btn-secondary" href="{{route('admin.sale.congsinment',[$consigment->id])}}">Sale</a></td>
                  </tr>
              @empty
                  <tr>
                    <td>No UnSold Consignment</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
          {{$consigments->links()}}
        </div>
      </div>
    </div>
  </div>
</div>