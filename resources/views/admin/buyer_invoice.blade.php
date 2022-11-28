<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPM Bill</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
		@page {
      size: A4;
 }
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">SPM SEA FOOD </h1>
                </div>
               
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No.: INV-SAL-{{$bill->id}}</h2>
                    <p class="sub-heading">Date : {{$bill->created_at->format('d M Y')}} </p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Name: {{$bill->Billable->name}} </p>
                    
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Purchase Details</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
						<th>Date</th>
                        <th>Product - Category</th>
                        <th>Weight</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
					@php($purchases=\App\Models\Billdetail::where('bill_id',$bill->id)->get())
					@foreach ($purchases as $purchase)
						@php($purchasedetail=\App\Models\Sale::find($purchase->purchase_sale_id))
					    <tr>
							<td>{{$purchasedetail->created_at->format('d M Y')}}</td>
							<td>{{$purchasedetail->Purchase->product }} - {{$purchasedetail->Purchase->Category->name}}</td>
							<td>{{$purchasedetail->weight}} Kg</td>
							<td>{{$purchasedetail->rate}} rs/kg</td>
							<td>{{$purchasedetail->weight * $purchasedetail->rate}} Rs</td>
						</tr>
					@endforeach
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td> {{$bill->total_amount}} Rs</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status: {{ strtoupper($bill->payment_status)}}</h3>
        </div>
  </div>      

</body>
</html>