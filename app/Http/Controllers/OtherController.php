<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\GenralExpense;
class OtherController extends Controller
{
    //
    
    public function saveexpensecategory(Request $inputs)
    {
        $inputs->validate([
            'category_name'=>'required|unique:expense_categories,name'
        ]);
        ExpenseCategory::create(['name'=>$inputs->category_name]);
        return back()->with('success','Expense Category added');
    }
    public function savegeneralexpense (Request $inputs)
    {
        $inputs->validate([
            'category'=>'required',
            'amount'=>'required|numeric',
            'note'=>'required'
        ]);
        GenralExpense::create([
            'expense_category_id'=>$inputs->category,
            'amount'=>$inputs->amount,
            'note'=>$inputs->note
        ]);
        return back()->with('success','Expense Saved');
    }

    public function deletegeneralexpense(GenralExpense $id)
    {
        $id->delete();
        return back()->with('info','Expense Deleted');
    }

}
