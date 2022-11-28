@extends('layouts.app')
@include('admin.sidebar')
  <!-- partial -->
  <div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Seller Creation Form</h4>
              <p class="card-description">
              Enter Details
              </p>
              <form class="forms-sample" method="post" action="{{route('admin.storeseller')}}">
                <div class="row">
                 @csrf
                <div class="form-group col-6">
                  <label for="exampleInputEmail3"> Seller Name</label>
                  <input type="text" class="form-control" name="seller_name" placeholder="Name" value="{{old('seller_name')}}">
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail3"> Select Port</label>
                    <select name="port" id="" class="form-control">
                        @php($ports=\App\Models\Port::whereStatus('1')->get())
                        @foreach ($ports as $port)
                        <option value="{{$port->id}}">{{$port->port_name}}</option>

                        @endforeach
                    </select>
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
                      <th>Seller Name</th>
                      <th>Port</th>
                      <th>Active Status </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @php($buyers=\App\Models\Seller::paginate(10))
                  <tbody>
                      @forelse ($buyers as $buyer)
                          <tr>
                              <td>{{$buyer->party_name}}</td>
                              <td>{{$buyer->Port->port_name}}</td>
                              <td>{{$buyer->status?'Active':'In Active'}}</td>
                              <td>
                                @if($buyer->status)
                                <a href="{{route('admin.status.seller',[$buyer->id,'0'])}}" class="btn btn-danger btn-sm">In Active</a>
      
                                  @else
                                  <a href="{{route('admin.status.seller',[$buyer->id,'1'])}}" class="btn btn-success btn-sm">Activate</a>
      
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