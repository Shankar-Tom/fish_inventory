@extends('layouts.app')
@include('admin.sidebar')
  <!-- partial -->
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Buyers Creation Form</h4>
              <p class="card-description">
              Enter Details
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storebuyer')}}">
                <div class="row">
                 @csrf
                <div class="form-group col-6">
                  <label for="exampleInputEmail3"> Buyer Name</label>
                  <input type="text" class="form-control" name="buyer_name" placeholder="Name" >
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail3"> Address</label>
                    <input type="text" class="form-control" name="buyer_address" placeholder="Address" >
                  </div>
            
           <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Categories Details</h4>
             
              <div class="table-responsive pt-3">
                <table class="table">
                  <thead class="table head-dark">
                    <tr>
                      <th>Campany  Name</th>
                      <th>Address</th>
                      <th>Active Status </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @php($buyers=\App\Models\Buyer::paginate(10))
                  <tbody>
                      @forelse ($buyers as $buyer)
                          <tr>
                              <td>{{$buyer->name}}</td>
                              <td>{{$buyer->address}}</td>
                              <td>{{$buyer->status?'Active':'In Active'}}</td>
                              <td>
                                @if($buyer->status)
                                <a href="{{route('admin.status.buyer',[$buyer->id,'0'])}}" class="btn btn-danger btn-sm">In Active</a>
      
                                  @else
                                  <a href="{{route('admin.status.buyer',[$buyer->id,'1'])}}" class="btn btn-success btn-sm">Activate</a>
      
                                  @endif
                              </td>
                          </tr>
                          @empty
                          <tr>
                            <td>No Buyers found</td>
                          </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
       </div>
    </div>