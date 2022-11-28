<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function Buyer()
    {
        return $this->belongsTo(Buyer::class,'to','id');
    }

    public function Consigment()
    {
        return $this->hasOne(PurchaseSaleConsignmentRelation::class);
    }

    public function Purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

}
