<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function Billable()
    {
      return  $this->morphTo();
    }

    public function PaidAmount()
    {
      return $this->hasMany(Payment::class);
    }
}
