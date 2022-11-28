<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['as'=>'staff.'],function(){
    Route::view('/','staff.login')->name('login');
    Route::controller(StaffController::class)->group(function(){
        Route::post('/login','login')->name('dologin');
    Route::middleware('staff')->group(function(){
        Route::get('/logout','logout')->name('logout');
        Route::post('/purchase/store','storepurchase')->name('storepurchase');
        Route::post('/consigment/create','')->name('create.consigment');
        Route::post('/consignment/store','storecongsignment')->name('storeconsigment');
        Route::get('/consignment/view/{id}','viewconsigment')->name('single.view.congsinment');
        Route::get('/consignment/sale/{id}','viewsaleable')->name('sale.congsinment');
        Route::post('/storesale/{id}','storesale')->name('storesale');
        Route::post('expense/store/{id}','storeexpense')->name('store.expense');
    });
       
    });
    Route::middleware('staff')->group(function(){
    Route::view('/dashboard','staff.dashboard')->name('dashboard');
    Route::view('/purchase/entry','staff.purchaseentry')->name('purchase.entry');
    Route::view('/purchase/view','staff.purchaseview')->name('purchase.view');
    Route::view('/consignment/create','staff.createconsignment')->name('create.consigment');
    Route::view('/consignment/view','staff.viewconsignment')->name('view.consigment');
    Route::view('/saleable/congsigment','staff.saleable')->name('saleable');
    Route::view('/sale/list','staff.sales')->name('sales');
    Route::view('/expense/view','staff.expenses')->name('expenses');
    });

});





Route::group(['prefix'=>'admin','as'=>'admin.'],function(){
    Route::redirect('/','login');
    Route::view('/login','admin.login')->name('login');
    Route::controller(AdminController::class)->group(function(){
            Route::post('dologin','login')->name('dologin');
        Route::middleware('admin')->group(function(){
            Route::get('/logout','logout')->name('logout');
            Route::post('/update/profile','updateprofile')->name('update.profile');
            Route::post('/staff/store','createataff')->name('storestaff');
            Route::get('/staff/ban/{id}/{status}','banstatff')->name('banstaff');
            Route::get('/staff/view/{id}','viewstaff')->name('viewstaff');
            Route::post('/staff/update/{id}','updatestaff')->name('updatestaff');
            Route::post('/port/create','storeport')->name('createport');
            Route::get('/port/status/{id}/{status}','portstatus')->name('port.status');
            Route::post('/category/store','storecategory')->name('storecategory');
            Route::get('/category/status/{id}/{status}','categorystatus')->name('status.category');
            Route::post('/buyer/store','storebuyer')->name('storebuyer');
            Route::post('store/seller','storeseller')->name('storeseller');
            Route::get('/buyer/status/{id}/update/{status}','buyerstatusupdate')->name('status.buyer');
            Route::get('/seller/status/{id}/update/{status}','sellerupdayestatus')->name('status.seller');
        });
      });
      Route::middleware('admin')->group(function(){
    Route::controller(OperationController::class)->group(function(){
            Route::post('/store/purchase','storepurchase')->name('storepurchase');
            Route::get('/purchse/edit/{id}','purchaseedit')->name('purchase.edit');
            Route::post('/purchase/update/{id}','updatepurchase')->name('updatepurchase');
            Route::get('congsinment/details/{id}','congsimentdetails')->name('congsinment.details');
            Route::post('consigment/store','consigmentstore')->name('storeconsigment');
            Route::get('delete/consigment/{cid}/purchase/{pid}','deleteconsigmentpurchase')->name('delete.consigment.purchase');
            Route::get('/sale/consigment/{id}','saleconsigment')->name('sale.congsinment');
            Route::post('/sale/store/{id}','storesale')->name('storesale');
            Route::get('/sale/edit/{id}','saleedit')->name('sale.edit');
            Route::post('/sale/update/{id}','updatesale')->name('updatesale');
            Route::post('/seller/bill/create','sellerbillstore')->name('seller.bill.create');
            Route::post('/buyer/bill/create','buyerrbillstore')->name('buyer.bill.create');
            Route::get('/bill/download/{id}','billdownload')->name('bill.download');
            Route::post('expense/save/{id}','savexpense')->name('saveexpense');
            Route::get('expense/delete/{id}','deleteexpense')->name('deleteexpense');

    });
    Route::controller(OtherController::class)->group(function(){
        Route::post('/expense/general/save','savegeneralexpense')->name('save.generalexpense');
        Route::get('/expense/general/delete/{id}','deletegeneralexpense')->name('delete.general.expense');
        Route::post('expense/category/save','saveexpensecategory')->name('save.expensecategory');
        Route::get('/payment/delete/{id}','deletepayment')->name('payment.delete');
     });
     Route::view('/profile','admin.profile')->name('profile');
    Route::view('/bill/seller','admin.sellerbill')->name('bill.seller');
    Route::view('/bill/buyer','admin.buyerbill')->name('bill.buyer');
    Route::view('/bill/all','admin.allbill')->name('bill.all');
    Route::view('/dashboard','admin.dashboard')->name('dashboard');
    Route::view('/staff/create','admin.staff')->name('createstaff');
    Route::view('/staff/list','admin.stafflist')->name('liststaff');
    Route::view('/ports','admin.ports')->name('ports');
    Route::view('/categories','admin.categories')->name('categories');
    Route::view('/buyers','admin.buyers')->name('buyers');
    Route::view('/sellers','admin.seller')->name('sellers');
    Route::view('/purchases','admin.purchases')->name('purchases');
    Route::view('purchase/ledger','admin.purchaseledger')->name('purchase.ledger');
    Route::view('/sales','admin.sales')->name('sales');
    Route::view('sale/ledger','admin.saleledger')->name('sale.ledger');
    Route::view('party/ledger','admin.partyledger')->name('party.ledger');
    Route::view('product/ledger','admin.productledger')->name('product.ledger');
    Route::view('/congsinments','admin.congsigments')->name('congsinments');
    Route::view('/purchase/create','admin.createpurchase')->name('create.puchase');
    Route::view('/consigment/create','admin.consigmentcreate')->name('congsinments.create');
    Route::view('/sale/create','admin.createsale')->name('sale.create');
    Route::view('/expense/general','admin.generalexpense')->name('general.expense');
    Route::view('/expense/all','admin.allexpense')->name('all.expense');
    });
});


