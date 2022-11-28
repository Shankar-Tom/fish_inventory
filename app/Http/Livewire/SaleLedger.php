<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
class SaleLedger extends Component
{
    public $sales=[];
    public $partyid,$startdate,$enddate,$type=NULL;
    
    public function updated()
    {
        $ssales=Sale::select();
        if($this->partyid!=NULL)
        {
            $ssales=$ssales->where('to',$this->partyid);
        }
        if($this->startdate!=NULL)
        {
            $ssales=$ssales->where('created_at','>=',$this->startdate); 
        }
        if($this->enddate!=NULL)
        {
            $ssales=$ssales->where('created_at','<=',$this->enddate); 
        }
          if($this->type!=NULL)
        {
            $ssales=$ssales->where('payment_mode',$this->type);
        }
        if($ssales)
        {
            $this->sales=$ssales->latest('created_at')->get();

        }
        
    }
    
    public function render()
    {

        
        return view('livewire.sale-ledger');
    }
}
