<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Payment;
class PartyLedger extends Component
{
    public $parties=[];
    public $payments=[];
    public $partytype,$partyid,$startdate,$enddate=NULL;

    public function updated()
    {
       $this->getPayments();
    }
    public function getPayments()
    {
        if($this->partytype=='seller')
        {
           $this->parties=Seller::where('status',1)->get();
           $billed_type='App\Models\Seller';
        }
        if($this->partytype=='buyer')
        {
            $this->parties=Buyer::where('status',1)->get();
            $billed_type='App\Models\Buyer';
        }
        if($this->partyid!=NULL)
        {
            $payments=Payment::where(['billed_id'=>$this->partyid,'billed_type'=>$billed_type]);
            if($this->startdate!=NULL)
            {
                $payments=$payments->where('created_at','>=',$this->startdate); 
            }
            if($this->enddate!=NULL)
            {
                $payments=$payments->where('created_at','<=',$this->enddate); 
            }
            $this->payments=$payments->get();
        }
    }
    public function delete($id)
    {
        Payment::find($id)->delete();
        $this->getPayments();
    }

    public function render()
    {
        return view('livewire.party-ledger');
    }
}
