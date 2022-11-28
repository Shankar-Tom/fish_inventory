@extends('layouts.app')
@include('admin.sidebar')
       
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Admin Details </h4>
             @php($admin=Auth('admin')->user())
              <form class="forms-sample" method="post" action="{{route('admin.update.profile',[$admin->id])}}">
                @csrf
                <div class="row">
                
                  <div class="form-group">
                  <label for="exampleInputEmail3">Admin Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{$admin->name}}">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail3">Email</label>
                  <input type="email" class="form-control" name="email" placeholder=" Admin Email / Login " value="{{$admin->email}}" >
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Mobile Number" value="{{$admin->mobile_number}}">
                  </div>
                <div class="form-group">
                  <label for="exampleInputCity1">Old Password</label>
                  <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputCity1">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="New Password">
                  </div>
               <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
        </div>       
 