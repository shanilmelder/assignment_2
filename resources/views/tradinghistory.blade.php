@extends('layouts.app')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
	color: #404E67;
	background: #F5F7FA;
	font-family: 'Open Sans', sans-serif;
}

.table-wrapper {
	width: 700px;
	margin: 30px auto;
	background: #fff;
	padding: 20px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
	padding-bottom: 10px;
	margin: 0 0 10px;
}

.table-title h2 {
	margin: 6px 0 0;
	font-size: 22px;
}

.table-title .add-new {
	float: right;
	height: 30px;
	font-weight: bold;
	font-size: 12px;
	text-shadow: none;
	min-width: 100px;
	border-radius: 50px;
	line-height: 13px;
}

.table-title .add-new i {
	margin-right: 4px;
}

table.table {
	table-layout: fixed;
}

table.table tr th,
table.table tr td {
	border-color: #e9e9e9;
}

table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}

table.table th:last-child {
	width: 100px;
}

table.table td a {
	cursor: pointer;
	display: inline-block;
	margin: 0 5px;
	min-width: 24px;
}

table.table td a.add {
	color: #27C46B;
}

table.table td a.edit {
	color: #FFC107;
}

table.table td a.delete {
	color: #E34724;
}

table.table td i {
	font-size: 19px;
}

table.table td a.add i {
	font-size: 24px;
	margin-right: -1px;
	position: relative;
	top: 3px;
}

table.table .form-control {
	height: 32px;
	line-height: 32px;
	box-shadow: none;
	border-radius: 2px;
}

table.table .form-control.error {
	border-color: #f50000;
}

table.table td .add {
	display: none;
}

#e_id {
   display: none;
}
    </style>
@stop
@section('content')
<div class="container">
    <div class="table-wrapper">
       <div class="table-title">
          <div class="row">
             <div class="col-sm-8">
                <h2>Sales History</h2>
             </div>
          </div>
       </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th>Energy Type</th>
                <th>User</th>
                <th>Volume</th>
                <th>Price</th>
             </tr>
          </thead>
          <tbody>
             @foreach($sales as $sale)
             <tr>
                <td>{{$sale->energyType->description}}</td>
                <td>{{$sale->user->firstname. " " .$sale->user->lastname}}</td>
                <td>{{$sale->volume}}</td>
                <td>{{$sale->price}}</td>
             </tr>
             @endforeach
          </tbody>
       </table>
</div>


<div class="container">
    <div class="table-wrapper">
       <div class="table-title">
          <div class="row">
             <div class="col-sm-8">
                <h2>Purchase History</h2>
             </div>
          </div>
       </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th>Energy Type</th>
                <th>User</th>
                <th>Volume</th>
             </tr>
          </thead>
          <tbody>
             @foreach($purchases as $purchase)
             <tr>
                <td>{{$purchase->energyType->description}}</td>
                <td>{{$purchase->user->firstname.  " " .$purchase->user->lastname}}</td>
                <td>{{$purchase->volume}}</td>
             </tr>
             @endforeach
          </tbody>
       </table>
</div>
@endsection