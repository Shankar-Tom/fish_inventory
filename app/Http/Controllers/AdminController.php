<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CreatePasswordCheck;
use App\Rules\VerifyAdminPassword;
use App\Models\Staff;
use App\Models\Port;
use App\Models\Category;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function login(Request $inputs)
    {
        $inputs->validate([
            'username'=>'required|email',
            'password'=>'required|min:6'
        ]);
        if(Auth('admin')->attempt(['email'=>$inputs->username,'password'=>$inputs->password],$inputs->remember))
        {
              return redirect()->route('admin.dashboard')->with('success','Login Success');
        }
        return back()->with('error','Invalid Credentials');
    }

    public function logout()
    {
        Auth('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function updateprofile(Request $inputs)
    {
        $inputs->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'old_password'=>['required',new VerifyAdminPassword()],
        ]);
    $admin=Auth('admin')->user();
        $admin->update([
            'name'=>$inputs->name,
            'email'=>$inputs->email,
            'mobile_number'=>$inputs->phone
        ]);
        if($inputs->filled('new_password'))
        {
            $inputs->validate([
                'new_password'=>['min:6',new CreatePasswordCheck()]
            ]);
            $admin->update(['password'=>\Hash::make($inputs->new_password)]);
        }
        return back()->with('success','Profile updated');

    }

    public function createataff(Request $inputs)
    {
            $inputs->validate([
                'name'=>'required',
                'email'=>'required|email|unique:staff,email',
                'phone'=>'required|numeric|unique:staff,mobile_number',
                'password'=>['required','min:6',new CreatePasswordCheck()]
            ]);
            Staff::create([
                'name'=>$inputs->name,
                'email'=>$inputs->email,
                'mobile_number'=>$inputs->phone,
                'password'=>\Hash::make($inputs->password),
                'created_by'=>Auth('admin')->id(),
            ]);
            return back()->with('success','Staff added');

    }

    public function banstatff(Staff $id,$status)
    {
        $id->update(['ban_status'=>$status]);
        return back()->with('info','Ban Status Updated');
    }

    public function viewstaff(Staff $id)
    {
        return view('admin.viewstaff',compact('id'));
    }

    public function updatestaff(Request $inputs,Staff $id)
    {
       
            $inputs->validate([
                'name'=>'required',
                'email'=>'required|email',
                'phone'=>'required|numeric',
                'your_password'=>['required',new VerifyAdminPassword()]
            ]);
            if($inputs->has('staff_password'))
            {
                $inputs->validate(['staff_password'=>['min:6',new CreatePasswordCheck()]]);
                $id->update(['password'=>\Hash::make($inputs->staff_password)]);
            }
            $id->update([
                'name'=>$inputs->name,
                'email'=>$inputs->email,
                'mobile_number'=>$inputs->phone
            ]);
            return back()->with('success','Staff details updated');

    }

    public function storeport(Request $inputs)
    {
        $inputs->validate([
            'port_name'=>'required',
            'city'=>'required',
            'state'=>'required'
        ],[
            'port_name.required'=>'Port name is mendatory',
            'city.required'=>'Port City is mendatory',
            'state.'=>'Port State is mendatory',
        ]);
        $address=$inputs->city .'   '.$inputs->state;
        Port::create([
            'port_name'=>$inputs->port_name,
            'port_address'=>$address,
        ]);
        return back()->with('success','Port Added');
    }

    public function portstatus(Port $id,$status)
    {
        $id->update(['status'=>$status]);
        return back()->with('success','Port Status Updated');
    }

    public function storecategory(Request $inputs)
    {
        $inputs->validate([
            'category_name'=>'required'
        ],[
            'category_name.required'=>'Category name is mendatory'
        ]);

        Category::create([
            'name'=>$inputs->category_name
        ]);
        return back()->with('success','Category Added');
    }
    public function categorystatus(Category $id,$status)
    {
        $id->update(['status'=>$status]);
        return back()->withSuccess('Category Status Updated');
    }

    public function storebuyer(Request $inputs)
    {
        $inputs->validate([
            'buyer_name'=>'required',
            'buyer_address'=>'required'
        ]);
       Buyer::create([
        'name'=>$inputs->buyer_name,
        'address'=>$inputs->buyer_address
       ]);
       return back()->with('success','Buyer detail stored');
    }
    
    public function buyerstatusupdate(Buyer $id,$status)
    {
            $id->update(['status'=>$status]);
            return back()->with('info','Buyer status updated');
    }
    
    public function storeseller(Request $inputs)
    {
        $inputs->validate([
            'seller_name'=>'required',
            'port'=>'required|exists:ports,id'
        ]);
        Seller::create([
                'port_id'=>$inputs->port,
                'party_name'=>$inputs->seller_name,
                'status'=>1
        ]);
        return back()->with('success','Seller Created');
    }

    public function sellerupdayestatus(Seller $id,$status)
    {
        $id->update(['status'=>$status]);
        return back()->with('info','Seller status updated');
    }


}
