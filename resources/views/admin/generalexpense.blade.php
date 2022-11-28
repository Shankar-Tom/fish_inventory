@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">

  <div class="col-lg-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      
          <h4 class="card-title">Create Expense Category</h4>
          <form  method="post" action="{{route('admin.save.expensecategory')}}" class="row">
            @csrf
            <div class="form-group">
              <label for="">Category Name</label>
            <input type="text" name="category_name"  placeholder="Expense Category" class="form-control m-2" value="{{old('category_name')}}" autofocus>
          </div>
          <button type="submit" class="btn btn-primary">Save Category</button>

          </form>
        </div>
       
      </div>
    </div>

<div class="col-lg-8 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
      <h4 class="card-title mt-3">Create Expense</h4>
      <form  method="post" action="{{route('admin.save.generalexpense')}}" class="row">
        @csrf
        <div class="form-group col-6">
          <label for="">Select Category</label>
          <select name="category" id="" class="form-control">
            @php($categories=\App\Models\ExpenseCategory::all())
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-6">
          <label for="">Amount</label>
        <input type="text" name="amount"  placeholder="Expense Amount" class="form-control m-2" value="{{old('amount')}}" autofocus>
      </div>
      <div class="form-group">
        <label for="">Expense Note</label>
      <input type="text" name="note"  placeholder="Expense Note" class="form-control m-2" value="{{old('note')}}" autofocus>
    </div>
      <button type="submit" class="btn btn-primary">Save Expense</button>

      </form>
      </div>
    </div>
  </div>

<div class="col-lg-4 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title mt-3">Expense Categories</h4>
        <table class="table">
          <thead>
            <th>Sl No</th>
          <th>Category Name</th>
          </thead>
          <tbody>
            @php($categories=\App\Models\ExpenseCategory::paginate(10))
            @foreach ($categories as $key=>$category)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$category->name}}</td>
              </tr>
            @endforeach
          </tbody>
        
        </table>
        {{$categories->links()}}
        </div>
      </div>
    </div>

  <div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <h4 class="card-title mt-3">Expenses</h4>
          <table class="table">
            <thead>
              <th>Sl No</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Note</th>
            </thead>
            <tbody>
              @php($expenses=\App\Models\GenralExpense::paginate(10))
              @foreach ($expenses as $key=>$expense)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$expense->Category->name}}</td>
                  <td>{{$expense->amount}}</td>
                  <td>{{$expense->note}}</td>
                </tr>
              @endforeach
            </tbody>
           
            
            
          </table>
          {{$expenses->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>