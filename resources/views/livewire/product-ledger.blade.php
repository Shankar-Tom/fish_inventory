<div>
    
    <div class="row">
        <div class="col-md-4">
            <select  class="form-control" wire:model="type" >
                <option value="NULL"  selected >Select Type</option>
                <option value="Purchase">Purchase</option>
                <option value="Sale">Sale</option>
            </select>
             </div>
        <div class="col-md-4">
    <select  class="form-control" wire:model="partyid" name="party_id">
        <option value="NULL"  selected >Select Party</option>
        @foreach ($parties as $party)
        <option value="{{$party->id}}">{{$type=='Sale'?$party->name:$party->party_name}}</option>
        @endforeach
    </select>
     </div>
 
     <div class="col-md-4">
        @php($products=\App\Models\Category::all())
        <select class="form-control" wire:model="productid">
            <option value="NULL"  selected >Select Product</option>
            @foreach ($products as $product)
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
        </select>
     </div>
    </div>
    <div class="table-responsive pt-3">
      <table class="table" id="puchaseledger">
        <thead class="table head-dark">
          <tr>
          <th>Date</th>
            <th>Weight</th>
            <th>Rate</th>
            <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php($totalamount=0)
         
            @foreach ($productdetails as $productdetail)
                <tr>
                    <td>{{$productdetail->created_at->format('d-M-Y')}}</td>
                    <td>{{$productdetail->weight}}</td>
                    <td>{{$productdetail->rate}}</td>
                    <td>{{ $productdetail->weight*$productdetail->rate}}</td>
                </tr>
                @php($totalamount+=$productdetail->weight*$productdetail->rate)
            @endforeach
           

        </tbody>
        <tfoot>
            <th>Total Amount </th><th>{{$totalamount}} </th>
        </tfoot>
      </table>
      
    </div>
    



