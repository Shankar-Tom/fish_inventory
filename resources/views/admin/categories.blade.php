@extends('layouts.app')
@include('admin.sidebar')
  <!-- partial -->
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Category Creation Form</h4>
              <p class="card-description">
              Enter Details
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storecategory')}}">
                <div class="row">
                 @csrf
                <div class="form-group">
                  <label for="exampleInputEmail3"> Product Name</label>
                  <input type="text" class="form-control" name="category_name" placeholder="Name" >
                </div>
            
           <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Product Details</h4>
             
              <div class="table-responsive pt-3">
                <table class="table">
                  <thead class="table head-dark">
                    <tr>
                      <th>Product  Name</th>
                      <th>Active Status </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @php($categories=\App\Models\Category::paginate(10))
                  <tbody>
                      @foreach ($categories as $category)
                          <tr>
                              <td>{{$category->name}}</td>
                              <td>{{$category->status?'Active':'In Active'}}</td>
                              <td>
                                @if($category->status)
                                <a href="{{route('admin.status.category',[$category->id,'0'])}}" class="btn btn-danger btn-sm">In Active</a>
      
                                  @else
                                  <a href="{{route('admin.status.category',[$category->id,'1'])}}" class="btn btn-success btn-sm">Activate</a>
      
                                  @endif
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
    </div>