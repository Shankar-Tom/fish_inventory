@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Staff List</h4>
        <div class="table-responsive pt-3">
          <table class="table">
            <thead class="table head-dark">
              <tr>
                <th>Staff Name</th>
                <th> Mobile Number </th>
                <th> Email </th>
                <th>  Ban Status </th>
                <th> Action</th>
              </tr>
            </thead>
            @php($staffs=\App\Models\Staff::paginate(10))
            <tbody>
                @foreach ($staffs as $staff)
                    <tr>
                        <td>{{$staff->name}}</td>
                        <td>{{$staff->mobile_number}}</td>
                        <td>{{$staff->email}}</td>
                        <td>{{$staff->ban_status?'Banned':''}}</td>
                        <td>
                          @if($staff->ban_status)
                          <a href="{{route('admin.banstaff',[$staff->id,'0'])}}" class="btn btn-danger btn-sm" onclick="ask()">Remove Ban</a>

                            @else
                            <a href="{{route('admin.banstaff',[$staff->id,'1'])}}" class="btn btn-danger btn-sm" onclick="confirm('Are Your Sure ?')">Ban</a>

                            @endif
                            <a href="{{route('admin.viewstaff',[$staff->id])}}"  class="btn btn-secondary btn-sm">View & Edit</a>
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

@push('script')
  <script>
    function ask(e){
      e.preventDefault();
      
      swal({

title: `Are you sure you want to delete this record?`,

text: "If you delete this, it will be gone forever.",

icon: "warning",

buttons: true,

dangerMode: true,

})

.then((willDelete) => {

if (willDelete) {

form.submit();

}

});
    }

    </script>
@endpush
    
    