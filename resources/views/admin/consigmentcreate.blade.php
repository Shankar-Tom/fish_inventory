@extends('layouts.app')
@include('admin.sidebar')
     
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Congsinment Creation </h4>
              <p class="card-description">
              Create new consigment with you purchases
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storeconsigment')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
           
                <div class="form-group col-3">
                  <label for="exampleInputName1">Vehicle Number</label>
                  <input type="text" class="form-control" name="vehicle_number" placeholder="Vehicle Number" value="{{old('vehicle_number')}}">

                  </div>
                <div class="form-group col-3">
                  <label for="exampleInputCity1">Vehicle Image</label>
                  <input type="file" class="form-control" name="vehicle_image" placeholder="Product Weight" value="{{old('vehicle_image')}}">
                </div>
                <div class="form-group col-3">
                  <label for="exampleInputCity1">Expense Amount(in Rupees)</label>
                  <input type="text" class="form-control" name="expense_amount" placeholder="Expense in Rupees" value="{{old('expense')}}">
                </div>
                <div class="form-group col-3">
                  <label for="exampleInputCity1">Expense For</label>
                  <input type="text" class="form-control" name="expense_for" placeholder="Reason of expense" value="{{old('expense_for')}}">
                </div>
                <div class="form-group">
                    <label for="">Select Staff</label>
                    <select name="staff" id="" class="form-control">
                        @php($staffs=\App\Models\Staff::where('ban_staus',0)))
                        @forelse ($staffs as $staff)
                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
                <h4 class="card-title">Purchases</h4>
                    @php($uncongsineds=\App\Models\Purchase::doesnthave('Consigned')->get())
                   <div class="table-responsive pt-3">
                        <table class="table">
                          <thead class="table head-dark">
                            <tr>
                              <th>Select</th>
                              <th>Product Name</th>
                              <th>Port </th>
                            
                              <th>Weight</th>
                              <th>Rate</th>
                              <th>Date Time</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php($i=0)
                            @forelse  ($uncongsineds as $uncongsined)
                                  <tr>
                                    <th> <input type="checkbox" name="select[]" id="" class="form-controle" value="{{$uncongsined->id}}">
                                    </th>
                                    <td>{{$uncongsined->Category->name}}</td>
                                      <td>{{$uncongsined->Port->port_name}}</td>
                                     
                                      <td>{{$uncongsined->weight}} Kg.</td>
                                      <td>{{$uncongsined->rate}} Rs./Kg.</td>
                                      <td>{{$uncongsined->created_at}}</td>
                                  </tr>
                              @empty
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                  <button type="submit" class="btn btn-primary me-2">Create Consigmnet</button>
              </form>
            </div>
          </div>
        </div>       
 