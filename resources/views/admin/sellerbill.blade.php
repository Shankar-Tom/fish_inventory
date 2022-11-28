@extends('layouts.app')
@include('admin.sidebar')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
   
  <!--port ledger-->
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create bills for Seller</h4>
            @livewire('seller-bill')
        </div>
      </div>
    </div>
  </div>
</div>