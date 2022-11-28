<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\Purchase;
use App\Models\Sale;
class ProductLedger extends Component
{
    public $parties=[];
    public $productdetails=[];
    public $type,$productid,$partyid=NULL;

    public function updated()
    {
        if($this->type=='Purchase')
        {
            $this->parties=Seller::all();
        }
        if($this->type=='Sale')
        {
            $this->parties=Buyer::all();
        }
        if(($this->productid!=NULL) && ($this->type=='Purchase'))
        {
            $products=Purchase::where('category_id',$this->productid);
            if($this->partyid!=NULL)
            {
                $products=$products->where('seller_id',$this->partyid);
            }
            $this->productdetails=$products->get();
        }
        if(($this->productid!=NULL) && ($this->type=='Sale'))
        {
            $productid=$this->productid;
            $products=Sale::whereHas('Purchase',function($query) use ($productid){
                    $query->where('category_id',$this->productid);
            });
            if($this->partyid!=NULL)
            {
                $products=$products->where('to',$this->partyid);
            }
            $this->productdetails=$products->get();
        }
       

    }

    public function render()
    {
        return view('livewire.product-ledger');
    }
}
