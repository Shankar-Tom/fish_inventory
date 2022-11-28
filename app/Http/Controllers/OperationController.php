<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Consignment;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\PurchaseSaleConsignmentRelation;

use Barryvdh\DomPDF\Facade\Pdf;
class OperationController extends Controller
{
 

   public function storepurchase(Request $inputs)
   {
        $inputs->validate([
            'port'=>'required|exists:ports,id',
            'category'=>'required|exists:categories,id',
            'staff'=>'required|exists:staff,id',
            'payment_mode'=>'required',
            
            'weight'=>'required|numeric',
            'rate'=>'required|numeric'
        ]);
        Purchase::create([
            'staff_id'=>$inputs->staff,
            'category_id'=>$inputs->category,
            'port_id'=>$inputs->port,
            'seller_id'=>$inpus->seller,
            'admin_id'=>Auth('admin')->id(),
           
            'weight'=>$inputs->weight,
            'rate'=>$inputs->rate,
            'payment_mode'=>$inputs->payment_mode
        ]);
        return back()->with('success','Purchase Added');
   } 
    public function purchaseedit(Purchase $id)
    {
       return view('admin.editpurchase',compact('id'));
    }

    public function updatepurchase(Request $inputs,Purchase $id)
    {
        $inputs->validate([
            'weight'=>'required|numeric',
            'rate'=>'required|numeric',
            'payment_mode'=>'required'
        ]);
        $id->update([
            'weight'=>$inputs->weight,
            'rate'=>$inputs->rate,
            'payment_mode'=>$inputs->payment_mode,
            'admin_id'=>Auth('admin')->id()
        ]);
        if($id->Consigned)
        {
            $consigment=Consignment::find($id->Consigned->consignment_id);
            $totalweight=0;
            foreach($consigment->Purchases as $purchase)
            {
                $totalweight=$totalweight+$purchase->weight;
            }
            $consigment->update(['total_weight'=>$totalweight]);
        }
        return back()->with('success','Purchase Details Updated. ');
    }

    public function saleconsigment($id)
    {
        $PurchasesUnSold=Purchase::whereHas('Consigned',function($query) use ($id){
            $query->where('consignment_id',$id);
    })->whereHas('SomeLeft')->orWhereDoesntHave('Sale')->get();
        $id=Consignment::find($id);
        return view('admin.sale',compact('id','PurchasesUnSold'));
    }

    public function storesale(Request $inputs,$id)
    {
        $inputs->validate([
            'buyer'=>'required|exists:buyers,id',
            'selected'=>'required',
            'expense_amount'=>'nullable|numeric',
            'expense_for'=>'required_with:expense_amount',
            'payment_mode'=>'required',
            'staff'=>'required'
           ],[
            'selected.required'=>'Select at-least one product to sale',
            'buyer.required'=>'Select your buyer',
            'buyer.exists'=>'Invalid buyer or buyer is banned for saling'
           ]);
         
           foreach($inputs->selected as $key=>$value)
           {
            if($inputs->weight[$key]!=''  )
            {
                $sale=Sale::create([
                    'purchase_id'=>$value,
                    'to'=>$inputs->buyer,
                    'weight'=>$inputs->weight[$key],
                    'rate'=>$inputs->rate[$key]??0,
                    'full_sold'=>$inputs->allsold[$key]??0,
                    'staff_id'=>$inputs->staff,
                    'payment_mode'=>$inputs->payment_mode,
                    'admin_id'=>Auth('admin')->id()
               ]);
              PurchaseSaleConsignmentRelation::where(['purchase_id'=>$value])->update(['sale_id'=>$sale->id]);
              
            }
            else{
                return back()->withErrors('Fill weight for all selected');
            }
           }
           if($inputs->expense_amount!='')
            {
                Expense::create([
                    'added_by'=>'admin',
                    'admin_staff_id'=>Auth('admin')->id(),
                    'amount'=>$inputs->expense_amount,
                    'congsigment_id'=>$id,
                    'expense_for'=>$inputs->expense_for,
                    'expense_on'=>'Selling',
                ]);
            }
           return back()->with('success','Product Sales stored');
    }




    public function saleedit(Sale $id)
    {
      return view('admin.saleedit',compact('id'));
    }

    public function updatesale(Request $inputs,Sale $id)
    {
            $inputs->validate([
                'payment_mode'=>'required',
                'rate'=>'required|numeric',
                'weight'=>'required|numeric'
            ]);
            $id->update(['payment_mode'=>$inputs->payment_mode,'rate'=>$inputs->rate,'weight'=>$inputs->weight,'admin_id'=>Auth('admin')->id()]);
            return back()->with('success','Sale details updated');
    }

    public function congsimentdetails(Consignment $id)
    {
            $Purchases=$id->Purchases;
        return view('admin.consigmentdetails',compact('id','Purchases'));
    }

    public function consigmentstore(Request $inputs)
    {
        $inputs->validate([
            'vehicle_number'=>'required|alpha_num',
            'vehicle_image'=>'nullable|mimes:jpg,jpeg,png',
            'expense_amount'=>'nullable|numeric',
            'expense_for'=>'required_with:expense_amount',
            'select'=>'required',
            'staff'=>'required'
        ],[
            'select.required'=>'Select at-least one purchase to create consigment'
        ]);
       // return true;
        $path='';
        if($inputs->hasFile('vehicle_image'))
        {
            $path=$inputs->file('vehicle_image')->store('public/vehicleimages');
        }
        $congsingment=Consignment::create([
            'vehicle_image'=>$path,
            'vehicle_number'=>$inputs->vehicle_number,
            'staff_id'=>$inputs->staff,
            'total_weight'=>0,
            'note'=>'Added By  admin -'.Auth('admin')->user()->name.' on behalf of staff '
        ]);
        if($inputs->expense_amount!='')
        {
        Expense::create([
            'added_by'=>'admin',
            'admin_staff_id'=>Auth('admin')->id(),
            'amount'=>$inputs->expense_amount,
            'congsigment_id'=>$congsingment->id,
            'expense_for'=>$inputs->expense_for,
            'expense_on'=>'Purchasing',
        ]);
        }
        foreach($inputs->select as $purchase)
        {
            PurchaseSaleConsignmentRelation::create([
                'purchase_id'=>$purchase,
                'consignment_id'=>$congsingment->id
            ]);
            $weight=Purchase::find($purchase)->weight;
            $congsingment->increment('total_weight',$weight);
        }
        return back()->with('suucess','Consigment Created');
    }

    public function deleteconsigmentpurchase($cid,$pid)
    {
        PurchaseSaleConsignmentRelation::where(['purchase_id'=>$pid,'consignment_id'=>$cid])->first()->delete();
        return back()->with('info','Purchase remove from the consigment');
    }
    public function savexpense(Request $inputs,$id)
    {
        $inputs->validate([
            'amount'=>'required|numeric',
            'expense_for'=>'required',
            'accepted'=>'required_with:anotherfield'
                ]);
        Expense::create([
                'added_by'=>'admin',
                'admin_staff_id'=>Auth('admin')->id(),
                'amount'=>$inputs->amount,
                'expense_for'=>$inputs->expense_for,
                'congsigment_id'=>$id
        ]);
        return back()->with('success','Expense added');
    }

   public function deleteexpense(Expense $id)
   {
        $id->delete();
        return back()->with('info','Expense Deleted');
   } 

   public function sellerbillstore(Request $inputs)
   {
       if($inputs->selected)
       {
          $bill=Bill::create([
            'billable_type'=>'App\Models\Seller',
            'billable_id'=>$inputs->party_id
          ]);
            $totalamount=0;
            foreach($inputs->selected as $value)
            {
              $purchase=Purchase::find($value);
            $amount=$purchase->weight*$purchase->rate;
              $purchase->update(['payment_mode'=>'bill generate']);
                BillDetail::create([
                    'bill_id'=>$bill->id,
                    'purchase_sale_id'=>$value
                ]);
                $totalamount+=$amount;
            } 
            $bill->update(['total_amount'=>$totalamount]);
            return back()->with('success','Bill generated for the seller');
       }
       return back()->withErrors('Select purchases to create bill');
   }

   public function buyerrbillstore(Request $inputs)
   {
    if($inputs->selected)
       {
          $bill=Bill::create([
            'billable_type'=>'App\Models\Buyer',
            'billable_id'=>$inputs->party_id
          ]);
            $totalamount=0;
            foreach($inputs->selected as $value)
            {
              $purchase=Sale::find($value);
            $amount=$purchase->weight*$purchase->rate;
              $purchase->update(['payment_mode'=>'bill generate']);
                BillDetail::create([
                    'bill_id'=>$bill->id,
                    'purchase_sale_id'=>$value
                ]);
                $totalamount+=$amount;
            } 
            $bill->update(['total_amount'=>$totalamount]);
            return back()->with('success','Bill generated for the seller');
       }
       return back()->withErrors('Select purchases to create bill');
    }

    public function billdownload($id)
    {
        $bill=Bill::find($id);
        if($bill->billable_type=='App\Models\Seller')
        {
            $pdf = PDF::loadView('admin.seller_invoice', compact('bill'));
            return $pdf->download('invoice_seller_'.$bill->Billable->party_name.'_'.$bill->created_at.'.pdf');
        }
        if($bill->billable_type=='App\Models\Buyer')
        {
            $pdf = PDF::loadView('admin.buyer_invoice', compact('bill'));
            return $pdf->download('invoice_buyer_'.$bill->Billable->name.'_'.$bill->created_at.'.pdf');
        }
        abort(404);
        
    }

}
