<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Seller;
class PortSeller extends Component
{
    public $portid=NULL;
    public $sellers=[];

    public function render()
    {
        if($this->portid!=NULL)
        {
            $this->sellers=Seller::where(['port_id'=>$this->portid,'status'=>1])->get();
        }

        return view('livewire.port-seller');
    }
}
