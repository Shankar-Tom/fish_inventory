<div>
    <div class="row">
        <div class="col-md-3">
    <select  class="form-control" wire:model="partyid">
        <option value="NULL"  selected >Select Party</option>
        @php($parties=\App\Models\Buyer::all())
        @foreach ($parties as $party)
        <option value="{{$party->id}}">{{$party->name}}</option>
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
      
      <table class="table" id="saleledger">
        <thead class="table head-dark">
             <th>Party Name</th>
            <th>Purchase Date</th>
             <th>Weight</th>
            <th>Rate</th>
            <th>Total Amount</th>
            <th>Payment</th>
          </thead>
            @php($totalamount=0)
        <tbody>
            @forelse ($sales as $sale)
                <tr>
                    <td>{{$sale->Buyer->name}}</td>
                    <td>{{$sale->created_at}}</td>
                    <td>{{$sale->weight}} kg</td>
                    <td>{{$sale->rate}}</td>
                    <td>{{$sale->weight * $sale->rate}}</td>
                    <td>{{$sale->payment_mode}}</td>
                    
                </tr>
                @php($totalamount+=$sale->weight * $sale->rate)
            @endforeach
             <tr>
            <td colspan="3"></td>
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
     $("#saleledger").tableHTMLExport({
      type:'csv',
      filename:'saleledger.csv',
    });
  });
});
</script>
@endpush
