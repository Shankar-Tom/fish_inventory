<div>
    
    <div class="row">
        <div class="col-md-3">
            <select  class="form-control" wire:model="partytype" >
                <option value="NULL"  selected >Select Type</option>
                <option value="seller">Seller</option>
                <option value="buyer">Buyer</option>
            </select>
             </div>
        <div class="col-md-3">
    <select  class="form-control" wire:model="partyid" name="party_id">
        <option value="NULL"  selected >Select Party</option>
        @foreach ($parties as $party)
        <option value="{{$party->id}}">{{$partytype=='buyer'?$party->name:$party->party_name}}</option>
        @endforeach
    </select>
     </div>
 
     <div class="col-md-3">
       <input type="date" wire:model="startdate" class="form-control">
    </div>
    <div class="col-md-3">
        <input type="date" wire:model="enddate" class="form-control">
     </div>


    </div>
    <div class="table-responsive pt-3">
      
      <table class="table" id="puchaseledger">
        <thead class="table head-dark">
          <tr>
          
          
            <th>Payment Date</th>
            <th>Paid Amount</th>
            <th>Action</th>
           
          </tr>
        </thead>
        <tbody>
            @php($totalamount=0)
            @foreach ($payments as $payment)
                <tr>
                    <td>{{$payment->created_at->format('d-M-Y')}}</td>
                    <td>{{$payment->amount}}</td>
                    <td><a class="btn btn-danger btn-sm" wire:click.prevent="delete('{{$payment->id}}')">Delete</a></td>
                </tr>
                @php($totalamount+=$payment->amount)
            @endforeach

        </tbody>
        <tfoot>
            <th>Total Amount </th><th>{{$totalamount}} RS  {{$partytype=='seller'?'Paid':'Received'}}</th>
        </tfoot>
      </table>
      
    </div>
    


