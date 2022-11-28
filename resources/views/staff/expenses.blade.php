@extends('layouts.app')
@include('staff.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Expenses </h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Expense Amount</th>
                <th>Expense for</th>
                <th>Expense Time</th>
                <th>Consigment Details</th>
                <th>Date Time</th>
              
              </tr>
            </thead>
            @php($expenses=\App\Models\Expense::where(['added_by'=>'staff','admin_staff_id'=>Auth('staff')->id()])->latest('created_at')->paginate(10))
            <tbody>
              @forelse ($expenses as $expense)
                  <tr>
                    <td>{{$expense->amount}} RS.</td>
                    <td>{{$expense->expense_for}}</td>
                    <td>{{$expense->expense_on??'Not Mentioned'}}</td>
                    <td>Created By : {{$expense->Consignment->Staff->name}} 
                      <br> Total Weight : {{$expense->Consignment->total_weight}} Kg
                      <br> Date Time :  {{$expense->Consignment->created_at}}
                    </td>
                    <td>{{$expense->created_at}}</td>
                  </tr>
              @empty
                  <tr>
                    <td>No Expense</td>
                  </tr>
              @endforelse
            </tbody>
          </table>
          {{$expenses->links()}}
        </div>
      </div>
    </div>
  </div>
</div>