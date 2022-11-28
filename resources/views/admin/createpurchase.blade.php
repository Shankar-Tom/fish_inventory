@extends('layouts.app')
@include('admin.sidebar')
 
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Enter Purchase </h4>
             
              <form class="forms-sample" method="post" action="{{route('admin.storepurchase')}}">
                @csrf
                <div class="row">
                
                  @livewire('port-seller')
                
                <div class="form-group col-4">
                  <label for="exampleInputEmail3">Select Product</label>
                  @php($categories=\App\Models\Category::where('status',1)->get())
                  <select name="category" id="" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-4">
                  <label for="exampleInputEmail3">Select Payment Mode</label>
                  <select name="payment_mode" id="" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="credit">Credit</option>

                  </select>
                </div>
                <div class="form-group col-4">
                    <label for="">Select Staff</label>
                    <select name="staff" id="" class="form-control">
                        @php($staffs=\App\Models\Staff::where('ban_status',0)->get())
                        @forelse ($staffs as $staff)
                        <option value="{{$staff->id}}">{{$staff->name}}</option>

                        @empty
                            
                        @endforelse
                    </select>
                </div>
              

                <div class="form-group col-6">
                  <label for="exampleInputCity1">Weight (in KG)</label>
                  <input type="number" class="form-control" name="weight" placeholder="Product Weight" value="{{old('weight')}}">
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputCity1">Rate</label>
                    <input type="number" class="form-control" name="rate" placeholder="Product Rate" value="{{old('rate')}}">
                  </div>

               <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
        </div>       
 
