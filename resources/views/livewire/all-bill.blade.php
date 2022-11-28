<div>
    
    <div class="row">
        <div class="col-md-4">
            <select  class="form-control" wire:model="billtype" >
                <option value="NULL"  selected >Select Type</option>
                <option value="seller">Seller</option>
                <option value="buyer">Buyer</option>
            </select>
             </div>
        <div class="col-md-4">
    <select  class="form-control" wire:model="partyid" name="party_id">
        <option value="NULL"  selected >Select Party</option>
        @foreach ($parties as $party)
        <option value="{{$party->id}}">{{$billtype=='buyer'?$party->name:$party->party_name}}</option>
        @endforeach
    </select>
     </div>
 
     <div class="col-md-4">
        <select  class="form-control" wire:model="paymentmode" >
           
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
            <option value="Partial Paid">Partial Paid</option>
        </select>
    </div>
 </div>
    <div class="table-responsive pt-3">
      
      <table class="table" id="puchaseledger">
        <thead class="table head-dark">
          <tr>
            <th>Biil Date</th>
            <th>Party Name</th>
            <th>Total Amount</th>
            <th>Paid Amount</th>
            <th>Due Amount</th>
           
            <th>Payment Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @php $totalamount=$paidamount=0 @endphp
            @forelse ($bills as $key=>$bill)
                <tr>
                    <td>{{$bill->created_at->format('d-m-Y')}}</td>
                <td>{{$billtype=='buyer'?$bill->Billable->name:$bill->Billable->party_name}}</td>
                    <td>{{$bill->total_amount}}</td>
                    <td>{{$bill->PaidAmount()->sum('amount')}}</td>
                    <td>{{$bill->total_amount - $bill->PaidAmount()->sum('amount')}}</td>
                    <td>{{$bill->payment_status}}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{route('admin.bill.download',[$bill->id])}}">Download</a>
                    @if($paymentmode!='Paid')
                            <button class="btn btn-success btn-sm" wire:click.prevent="paid('{{$bill->id}}')">Add Payemnt</button> 

                  @endif
                </td>
                </tr>
                @php $totalamount+=$bill->total_amount; $paidamount+=$bill->PaidAmount()->sum('amount') @endphp
            @endforeach
            <tr>
                <th colspan="2"></td>
                <th >Total Amount</th><th>  {{$totalamount}} RS</th>
                <th>Paid Amount</th><th>{{$paidamount}}</th>
                <th>Due Amount</th> <th>{{$totalamount-$paidamount}}</th>
              
            </tr>
        </tbody>
      </table>
      
    </div>
    @push('script')
    <script>
        window.addEventListener('confirm', event => {
           swal("Enter Amount:", {
                    content: "input",
                    })
                    .then((value) => {
                        if(value!='')
                        {
                            Livewire.emit('payBill',value);
                        }else{
                            swal("Enter Amount to payment in this bill");
                        }
                    });
            
         });
         window.addEventListener('error',event=>{
            swal('',event.detail.message,'error');
         });

</script>
    @endpush
   

