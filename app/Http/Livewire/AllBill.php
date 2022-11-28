<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Payment;
class AllBill extends Component
{
    public $bills=[];
    public $parties=[];
    public $billtype,$partyid,$paybillid=NULL;
    public $amount="Amount";
    public $paymentmode='pending';
    protected $listeners=['payBill'=>'payBill'];
    public function updated()
    {
        $this->getBills();
    }

    public function getBills()
    {
        if($this->billtype=='seller')
        {
           $this->parties=Seller::where('status',1)->get();
           $billable_type='App\Models\Seller';
        }
        if($this->billtype=='buyer')
        {
            $this->parties=Buyer::where('status',1)->get();
            $billable_type='App\Models\Buyer';
        }
        if($this->partyid!=NULL)
        {
            $this->bills=Bill::where(['billable_id'=>$this->partyid,'payment_status'=>$this->paymentmode,'billable_type'=> $billable_type])->get();
        }
    }

    public function paid($id)
    {
        $this->paybillid=$id;
        $this->dispatchBrowserEvent('confirm');
    }

    public function payBill($amount)
    {
        
        $bill=Bill::find($this->paybillid);
        // =$bill->total_amount >= (float)$amount;
        $paid=$bill->PaidAmount()->sum('amount');
        $due=$bill->total_amount-$paid;
        if($due >=$amount)
        {
            Payment::create([
                'bill_id'=>$this->paybillid,
                'amount'=>$amount,
                'billed_type'=>$bill->billable_type,
                'billed_id'=>$bill->billable_id
                ]);
           $status=$due>$amount?'Partial Paid':'Paid';
           $this->amount=$bill->update(['payment_status'=>$status]);
           $this->getBills();

        }else{
            $this->dispatchBrowserEvent('error',['message'=>'Paid amount can\'t be more than due amount']);

        }
   
        

    }


    public function render()
    {
        return view('livewire.all-bill');
    }
}
