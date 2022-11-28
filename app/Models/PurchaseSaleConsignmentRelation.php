<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseSaleConsignmentRelation extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function Purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }

    public function Congsinment()
    {
        return $this->belongsTo(Consignment::class,'consignment_id','id');
    }

}
