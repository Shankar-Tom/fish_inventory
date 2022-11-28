<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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

    public function Port()
    {
        return $this->belongsTo(Port::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Consigned()
    {
        return $this->hasOne(PurchaseSaleConsignmentRelation::class);

    }

    public function Sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function SomeLeft()
    {
        return $this->hasMany(Sale::class)->where('full_sold',0);
    }
    

    public function Purchasefrom()
    {
        return $this->belongsTo(Seller::class,'seller_id');
    }
}



