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
                <h2>User List</h2>
             </div>
             <div class="col-sm-4">
               <button type="button" class="btn btn-info add-new" onclick="window.location='/register'"><i class="fa fa-plus"></i> Add New</button>
             </div>
          </div>
       </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th></th>
             </tr>
          </thead>
          <tbody>
             @foreach($users as $user)
             <tr>
                <td id="fname">{{$user->firstname}}</td>
                <td id="lanme">{{$user->lastname}}</td>
                <td id="email">{{$user->email}}</td>
                <td id="btnEdit">
                    <button type="button" class="btnBuy btn btn-success" onclick="window.location='/user-edit/{{$user->id}}'">Edit</button>
                </td>
             </tr>
             @endforeach
          </tbody>
       </table>
    </div>
@endsection

@section('scripts')
<script>
   $(document).on("click", ".btnBuy", function () {
     var id = $(this).data('id');
     $(".modal-body #id").val( id );
   });

   $(document).on("click", ".mdlSell", function(){
      $.ajax({
         type: "POST",
         url: '/trading-sell',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: { 
            id: $(".modal-body #energyType").val(),
            volume: $(".modal-body #sellvolume").val(),
            price: $(".modal-body #price").val(),
         }
         }).done(function( msg ) {
            $('#SellerModal').modal('toggle');
         });
      });

      $(document).on("click", ".mdlBuy", function(){
      $.ajax({
         type: "POST",
         url: '/trading-buy',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: { 
            id: $(".modal-body #id").val(),
            volume: $(".modal-body #volume").val(),
         }
         }).done(function( msg ) {
            $('#BuyerModal').modal('toggle');
         });
      });
</script>
@endsection