<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function Purchases()
    {
        return $this->belongsToMany(Purchase::class,PurchaseSaleConsignmentRelation::class);
    }

    public function Sale()
    {
        return $this->belongsToMany(Sale::class,PurchaseSaleConsignmentRelation::class);
    }

    public function PurchasesUnSold()
    {
        return $this->belongsToMany(Purchase::class,PurchaseSaleConsignmentRelation::class)->where('sale_id',NULL);
    }

    public function Expenses()
    {
        return $this->hasMany(Expense::class,'congsigment_id');
    }

    public function SomeLeft()
    {
        return $this->belongsToMany(Sale::class,PurchaseSaleConsignmentRelation::class)->where('full_sold',0);
    }
    
}