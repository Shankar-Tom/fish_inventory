@extends('layouts.app')
@include('admin.sidebar')
     
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sale From </h4>
              <p class="card-description">
              Create new consigment with you purchases
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storesale',[$id->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
           
                <div class="form-group col-md-3">
                  <label for="exampleInputName1">Select Buyer</label>
                    @php($buyers=\App\Models\Buyer::where('status',1)->get())
                    <select name="buyer" id="" class="form-control">
                        <option value="">Select</option>
                        @forelse ($buyers as $buyer)
                        <option value="{{$buyer->id}}">{{$buyer->name}}( {{$buyer->address}})</option>
                        @empty
                            <option value="">No Buyer available</option>
                        @endforelse
                    </select>
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputCity1">Expense Amount(in Rupees)</label>
                    <input type="text" class="form-control" name="expense_amount" placeholder="Expense in Rupees" value="{{old('expense')}}">
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputCity1">Expense For</label>
                    <input type="text" class="form-control" name="expense_for" placeholder="Reason of expense" value="{{old('expense_for')}}">
                  </div>
                  <div class="form-group col-3">
                    <label for="exampleInputCity1">Selling Payment Mode</label>
                    <select name="payment_mode" id="" class="form-control">
                      <option value="Cash">Cash</option>
                      <option value="Credit">Credit</option>
                    </select>
                  </div>
              <div class="form-group">
                <label for="">Staff</label>
                <select name="staff" id="" class="form-control">
                    @php($staffs=\App\Models\Staff::where('ban_status',0)->get())
                    @forelse ($staffs as $staff)
                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                    @empty
                        
                    @endforelse
                </select>
              </div>
                <h4 class="card-title">Product in Consigment</h4>
                  <div class="table-responsive pt-3">
                        <table class="table">
                          <thead class="table head-dark">
                            <tr>
                            <th>Select</th>
                              <th>Product Name</th>
                              <th>Port </th>
                              <th>Category </th>
                              <th> Weight </th>
                              <th> Rate</th>
                              <th>All Sold</th>
                              
                            </tr>
                          </thead>
                          <tbody>
                            @php($i=0)
                            @forelse  ($PurchasesUnSold as $product)
                                  <tr>
                                    <td> <input type="checkbox" name="selected[{{$i}}]" id=""  value="{{$product->Purchase->id}}"></td>
                                      <td>{{$product->product}}</td>
                                      <td>{{$product->Purchase->Port->port_name}}</td>
                                      <td>{{$product->Purchase->Category->name}}</td>
                                      <td><input type="text" name="weight[{{$i}}]" > Kg</td>
                                      <td><input type="text" name="rate[{{$i}}]" > /Kg</td>
                                      <td><input type="checkbox" name="allsold[{{$i}}]" value="1"></td>
                                  </tr>
                                  @php($i++)
                                
                            @empty
                            <tr>
                                <td>No Products available in this congsingment </td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                <button type="submit" class="btn btn-primary me-2">Sale </button>
              </form>
            </div>
          </div>
        </div>       
 