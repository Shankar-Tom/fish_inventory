<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
class PurchaseLedger extends Component
{
    public $purchases=[];
    public $partyid,$startdate,$enddate,$type=NULL;
    
    public function updated()
    {
              $ppurchases=Purchase::select();
        if($this->partyid!=NULL)
        {
            $ppurchases=$ppurchases->where('seller_id',$this->partyid);
        }
        if($this->startdate!=NULL)
        {
            $ppurchases=$ppurchases->where('created_at','>=',$this->startdate); 
        }
        if($this->enddate!=NULL)
        {
            $ppurchases=$ppurchases->where('created_at','<=',$this->enddate); 
        }
        if($this->type!=NULL)
        {
            $ppurchases=$ppurchases->where('payment_mode',$this->type);
        }
        if($ppurchases)
        {
            $this->purchases=$ppurchases->latest('created_at')->get();

        }
    }
        
    
   
    public function render()
    {
  
        return view('livewire.purchase-ledger');
    }
}
