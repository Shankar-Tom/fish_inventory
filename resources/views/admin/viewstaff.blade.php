@extends('layouts.app')
@include('admin.sidebar')
        
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Staff </h4>
             
              <form class="forms-sample" method="post" action="{{route('admin.updatestaff',[$id->id])}}">
                @csrf
                <div class="row">
                
                  <div class="form-group">
                  <label for="exampleInputEmail3">Staff Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{$id->name}}">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail3">Email</label>
                  <input type="email" class="form-control" name="email" placeholder=" Staff Email / Login " value="{{$id->email}}" >
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Mobile Number" value="{{$id->mobile_number}}">
                  </div>
                <div class="form-group">
                  <label for="exampleInputCity1">Staff Password</label>
                  <input type="password" class="form-control" name="staff_password" placeholder="Staff Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputCity1">Your Password</label>
                    <input type="password" class="form-control" name="your_password" placeholder="Your Password">
                  </div>
               <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
        </div>       
 