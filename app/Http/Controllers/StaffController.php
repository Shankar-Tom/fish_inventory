<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseSaleConsignmentRelation;
use App\Models\Consignment;
use App\Models\Sale;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
class StaffController extends Controller
{
    public function login(Request $inputs)
    {
        $inputs->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
           if( Auth('staff')->attempt(['email'=>$inputs->username,'password'=>$inputs->password],$inputs->remember))
           {
                return redirect()->route('staff.dashboard')->with('success','Login Success');
           }
           return back()->with('error','Invalid Credentials');
    }

    public function logout()
    {
        Auth('staff')->logout();
        return redirect()->route('staff.login')->with('info','Logged Out');
    }

    public function storepurchase(Request $inputs)
    {
            $inputs->validate([
                'portid'=>'required|exists:ports,id',
                'categoryid'=>'required|exists:categories,id',
               
                'weight'=>'required|numeric',
                'rate'=>'required|numeric',
                'paymentmode'=>'required'
            ]);
            $purchase=Purchase::create([
                'staff_id'=>Auth('staff')->id(),
                'category_id'=>$inputs->categoryid,
                
                'port_id'=>$inputs->portid,
                'seller_id'=>$inputs->seller,
                'weight'=>$inputs->weight,
                'rate'=>$inputs->rate,
                'payment_mode'=>$inputs->paymentmode
                ]);
               return back()->with('success','Purchase Stored');

    }

    public function storecongsignment(Request $inputs)
    {
       $inputs->validate([
        'vehicle_number'=>'required',
        'vehicle_image'=>'nullable|file|mimes:png,jpg,jpeg',
        'select'=>'required',
        'expense_amount'=>'required|numeric',
        'expense_for'=>'required'
        ],[
            'select.required'=>'Select at-least One purchase to create new Congsinment',
            'expense.numeric'=>'Enter amount only in number'
        ]);
        $path='';
        if($inputs->hasFile('vehicle_image'))
        {
             $path=$inputs->file('vehicle_image')->store('public/vehicleimages');
        }
       
        $congsingment=Consignment::create([
            'vehicle_image'=>$path,
            'vehicle_number'=>$inputs->vehicle_number,
            'staff_id'=>Auth('staff')->id(),
            'total_weight'=>0
        ]);
        Expense::create([
            'added_by'=>'staff',
            'admin_staff_id'=>Auth('staff')->id(),
            'amount'=>$inputs->expense_amount,
            'congsigment_id'=>$congsingment->id,
            'expense_for'=>$inputs->expense_for,
            'expense_on'=>'Purchasing',
        ]);

        foreach($inputs->select as $purchase)
        {
            PurchaseSaleConsignmentRelation::create([
                'purchase_id'=>$purchase,
                'consignment_id'=>$congsingment->id
            ]);
            $weight=Purchase::find($purchase)->weight;
            $congsingment->increment('total_weight',$weight);
        }
       return back()->with('success','Congsiment Created');
    }



    public function viewconsigment(Consignment $id)
    {
     return view('staff.singleviewcongsiment',compact('id'));
    }

    public function viewsaleable($id)
    {
       
      $PurchasesUnSold=Purchase::whereHas('Consigned',function($query) use ($id){
                $query->where('consignment_id',$id);
        })->whereHas('SomeLeft')->orWhereDoesntHave('Sale')->get();
        $id=Consignment::find($id);
         return view('staff.sale',compact('id','PurchasesUnSold'));
    }

    public function storesale(Request $inputs,$id)
    {
       $inputs->validate([
        'buyer'=>'required|exists:buyers,id',
        'selected'=>'required',
        'expense_amount'=>'nullable|numeric',
        'expense_for'=>'required_with:expense_amount',
        'payment_mode'=>'required'
       ],[
        'selected.required'=>'Select at-least one product to sale',
        'buyer.required'=>'Select your buyer',
        'buyer.exists'=>'Invalid buyer or buyer is banned for saling'
       ]);
     
       foreach($inputs->selected as $key=>$value)
       {
        if($inputs->weight[$key]!='' )
        {
            $sale=Sale::create([
                'purchase_id'=>$value,
                'to'=>$inputs->buyer,
                'weight'=>$inputs->weight[$key],
                'rate'=>$inputs->rate[$key] ??0,
                'full_sold'=>$inputs->allsold[$key]??0,
                'staff_id'=>Auth('staff')->id(),
                'payment_mode'=>$inputs->payment_mode
           ]);
           PurchaseSaleConsignmentRelation::where('purchase_id',$value)->update(['sale_id'=>$sale->id]);
        }
        else{
            return back()->withErrors('Fill weight for all selected ');
        }
        
        }
        if($inputs->filled('expense_amount'))
        {

            Expense::create([
                'added_by'=>'staff',
                'admin_staff_id'=>Auth('staff')->id(),
                'amount'=>$inputs->expense_amount,
                'congsigment_id'=>$id,
                'expense_for'=>$inputs->expense_for,
                'expense_on'=>'Selling',
            ]);
        }
     
       return back()->with('success','Product Sales stored');
    }

    public function storeexpense(Request $inputs,$id)
    {
        $inputs->validate([
                'amount'=>'required|numeric',
                'note'=>'required'
        ]);
        Expense::create([
            'added_by'=>'staff',
            'admin_staff_id'=>Auth('staff')->id(),
            'amount'=>$inputs->amount,
            'congsigment_id'=>$id,
            'expense_for'=>$inputs->note,
            'expense_on'=>NULL,
        ]);
        return back()->with('success','Expense Added');
    }

    
    
    
    
    public function relationtest()
    {
       return Expense::first()->Consignment;
    }

}
