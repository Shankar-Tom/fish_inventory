@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">        
    <div class="content-wrapper">
      <div class="row">
       <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Edit Purchase</h4>
              
              <form class="forms-sample" method="post" action="{{route('admin.updatepurchase',[$id->id])}}">
                <div class="row">
                 @csrf
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail3">Port</label>
                  <input type="text" class="form-control" name="port_name"  value="{{$id->Port->port_name}}" readonly>
                </div>
             <div class="form-group col-md-4">
                  <label for="exampleInputCity1">Category</label>
                  <input type="text" class="form-control" name="city"  value="{{$id->Category->name}}" readonly>
                </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail3">Product</label>
                    <input type="text" class="form-control" name="state" placeholder="State" value="{{$id->product}}" readonly>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail3">Purchased By</label>
                        <input type="text" class="form-control" name="state" placeholder="State" value="{{$id->Staff->name}}" readonly>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail3">Weight</label>
                            <input type="text" class="form-control" name="weight" placeholder="State" value="{{$id->weight}}" >
                          </div>
                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Rate</label>
                                <input type="text" class="form-control" name="rate" placeholder="State" value="{{$id->rate}}" >
                          </div>
                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Payment Mode</label>
                            <select name="payment_mode" id="" class="form-control">
                              <option value="cash" {{$id->payment_mode=='cash'?'selected':''}}>Cash</option>
                              <option value="credit" {{$id->payment_mode=='credit'?'selected':''}}>Credit</option>
                            </select>
                          </div>
           <button type="submit" class="btn btn-primary me-2">Update Purchase</button>
              </form>
            </div>
          </div>
          
        </div>
       </div>
    </div>