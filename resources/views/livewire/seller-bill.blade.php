<div>
    <form action="{{route('admin.seller.bill.create')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-md-3">
    <select  class="form-control" wire:model="partyid" name="party_id">
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

    <div class="col-md-1">
        <button type="submit" class="btn btn-success export">Genrate Bill</button>
    </div>
    </div>
    <div class="table-responsive pt-3">
      
      <table class="table" id="puchaseledger">
        <thead class="table head-dark">
          <tr>
            <th>Select Purchases</th>
            <th>Party Name</th>
            <th>Purchase Date</th>
            <th>Product</th>
            <th>Category & Port</th>
            <th>Weight</th>
            <th>Rate</th>
            <th>Total Amount</th>
         
           
          </tr>
        </thead>
        <tbody>
        @php($totalamount=0)
            @forelse ($purchases as $key=>$purchase)
                <tr>
                    <td><input type="checkbox" name="selected[]" value="{{$purchase->id}}"></td>
                    <td>{{$purchase->Purchasefrom->party_name}}</td>
                    <td>{{$purchase->created_at}}</td>
                    <td>{{$purchase->product}}</td>
                    <td>{{$purchase->Port->port_name}} {{$purchase->Category->name}}</td>
                    <td>{{$purchase->weight}} kg</td>
                    <td>{{$purchase->rate}}</td>
                    <td>{{ $purchase->weight * $purchase->rate}}</td>
                </tr>
                @php($totalamount+=$purchase->weight * $purchase->rate)
            @endforeach
            <tr>
                <th colspan="5"></td>
                <th >Total Amount</th><th>  {{$totalamount}} RS</th>
               
            </tr>
        </tbody>
      </table>
    </div>
</form>
    @push('script')
    <script  src="{{asset('js/tableHTMLExport.js')}}" type="text/javascript"></script>

    @endpush
    