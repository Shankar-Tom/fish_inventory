<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
class SellerBill extends Component
{
    public $purchases=[];
    public $partyid,$startdate,$enddate=NULL;

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
        
        if($ppurchases)
        {
            $ppurchases->where('payment_mode','credit');
            $this->purchases=$ppurchases->latest('created_at')->get();

        }
    }
       


    public function render()
    {
        return view('livewire.seller-bill');
    }
}
