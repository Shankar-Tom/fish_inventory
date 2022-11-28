<div>
<div class="row">
    <div class="col-md-3">
<select  class="form-control" wire:model="partyid">
    <option value="NULL"  selected >Select Party</option>
    @php($parties=\App\Models\Seller::all())
    @foreach ($parties as $party)
    <option value="{{$party->id}}">{{$party->party_name}}</option>
    @endforeach
</select>

</div>
<div class="col-md-3">
<input type="date" class="form-control" wire:model="startdate">
</div>
<div class="col-md-3">
<input type="date"  class="form-control" wire:model="enddate">
</div>
<div class="col-md-2">
    <select class="form-control" wire:model="type">
        <option value="NULL">Select Mode</option>
        <option vlaue="cash">Cash</option>
        <option value="credit">Credit</option>
    </select>
</div>
<div class="col-md-1">
    <button class="btn btn-success export">Export Excel</button>
</div>
</div>
<div class="table-responsive pt-3">
  
  <table class="table" id="puchaseledger">
    <thead class="table head-dark">
      <tr>
        <th>Party Name</th>
        <th>Purchase Date</th>
        <th>Product</th>
        <th>Port</th>
        <th>Weight</th>
        <th>Rate</th>
        <th>Total Amount</th>
        <th>Payment</th>
       
      </tr>
    </thead>
    <tbody>
    @php($totalamount=0)
        @forelse ($purchases as $purchase)
            <tr>
                <td>{{$purchase->Purchasefrom->party_name}}</td>
                <td>{{$purchase->created_at}}</td>
                <td>{{$purchase->Category->name}}</td>
                <td>{{$purchase->Port->port_name}} </td>
                <td>{{$purchase->weight}} kg</td>
                <td>{{$purchase->rate}}</td>
                <td>{{ $purchase->weight * $purchase->rate}}</td>
                <td>{{$purchase->payment_mode}}</td>
                @php($totalamount+= $purchase->weight * $purchase->rate)
            </tr>
        @endforeach
        <tr>
            <th colspan="5"></td>
            <th >Total Amount</th><th>{{$totalamount}} RS</th>
            <th>{{$type}}</th>
        </tr>
    </tbody>
  </table>
</div>

@push('script')
<script  src="{{asset('js/tableHTMLExport.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
   $(".export").click(function(){  
     $("#puchaseledger").tableHTMLExport({
      type:'csv',
      filename:'puchaseledger.csv',
    });
  });
});
</script>
@endpush
