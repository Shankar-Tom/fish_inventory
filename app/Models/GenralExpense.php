<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenralExpense extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function Category()
    {
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }
}
