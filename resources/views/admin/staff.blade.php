@extends('layouts.app')
@include('admin.sidebar')
<!-- partial -->
        
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Staff Creation </h4>
              <p class="card-description">
              Create Staff to with login details
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storestaff')}}">
                @csrf
                <div class="row">
                
                  <div class="form-group">
                  <label for="exampleInputEmail3">Staff Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail3">Email</label>
                  <input type="email" class="form-control" name="email" placeholder=" Staff Email / Login " value="{{old('email')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Mobile Number" value="{{old('phone')}}">
                  </div>
             
           
                <div class="form-group">
                  <label for="exampleInputCity1">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password" value="{{old('password')}}">
                </div>
               <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
        </div>       
 