@extends('layouts.app')
@include('admin.sidebar')
  <!-- partial -->
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Port Creation Form</h4>
              <p class="card-description">
              Enter Details
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.createport')}}">
                <div class="row">
                 @csrf
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail3"> Port Name</label>
                  <input type="text" class="form-control" name="port_name" placeholder="Name" value="{{old('port_name')}}">
                </div>
             <div class="form-group col-md-4">
                  <label for="exampleInputCity1">City</label>
                  <input type="text" class="form-control" name="city" placeholder="Location" value="{{old('city')}}">
                </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail3">State</label>
                    <input type="text" class="form-control" name="state" placeholder="State" value="{{old('state')}}">
                  </div>
           <button type="submit" class="btn btn-primary me-2">Submit</button>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ports Details</h4>
             
              <div class="table-responsive pt-3">
                <table class="table">
                  <thead class="table head-dark">
                    <tr>
                      <th>Port  Name</th>
                      <th> Address </th>
                      <th>Active Status </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @php($ports=\App\Models\Port::paginate(10))
                  <tbody>
                      @foreach ($ports as $port)
                          <tr>
                              <td>{{$port->port_name}}</td>
                              <td>{{$port->port_address}}</td>
                              <td>{{$port->status?'Active':'Not Active'}}</td>
                              <td>
                                @if($port->status)
                                <a href="{{route('admin.port.status',[$port->id,'0'])}}" class="btn btn-danger btn-sm">In Active</a>
      
                                  @else
                                  <a href="{{route('admin.port.status',[$port->id,'1'])}}" class="btn btn-success btn-sm">Activate</a>
      
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