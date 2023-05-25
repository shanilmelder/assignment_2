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

.table-title .view-history {
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

.table-title .view-history i {
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
             <div class="col-sm-6">
                <h2>Renewable Energy Types</h2>
             </div>
             <div class="col-sm-3">
                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
             </div>
             <div class="col-sm-3">
               <button type="button" class="btn btn-info view-history" onclick="window.location='/trading-history'"><i class="fa fa-eye"></i> View Trading History</button>
            </div>
          </div>
       </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th>Energy Type</th>
                <th>Market Price</th>
                <th>Administration Fee</th>
                <th>Tax Rate</th>
             </tr>
          </thead>
          <tbody>
             @foreach($energyTypes as $energyType)
             <tr>
                <td id="e_id">{{$energyType->id}}</td>
                <td id="e_description">{{$energyType->description}}</td>
                <td id="e_price">{{$energyType->market_price}}</td>
                <td id="e_fee">{{$energyType->admin_fee}}</td>
                <td id="e_tax">{{$energyType->tax_rate}}</td>
                <td>
                   <a class="add" title="" data-toggle="tooltip" data-original-title="Add"><i class="material-icons"></i></a>
                   <a class="edit" title="" data-toggle="tooltip" data-original-title="Edit"><i class="material-icons"></i></a>
                   <a class="delete" title="" data-toggle="tooltip" data-original-title="Delete"><i class="material-icons"></i></a>
                </td>
             </tr>
             @endforeach
          </tbody>
       </table>
    </div>
 </div>

@endsection

@section('scripts')
    <script>
   $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var actions = $("table td:last-child").html();
    // Append table with add row form on add new button click
    $(".add-new").click(function(){
    $(this).attr("disabled", "disabled");
      var index = $("table tbody tr:last-child").index();
      var row = '<tr>' +
      '<td id="e_id"><input type="text" class="form-control" name="id" id="e_id" value="-9999"></td>' +
      '<td><input type="text" class="form-control" name="description" id="description"></td>' +
      '<td><input type="text" class="form-control" name="market_price" id="market_price"></td>' +
      '<td><input type="text" class="form-control" name="admin_fee" id="admin_fee"></td>' +
      '<td><input type="text" class="form-control" name="tax_rate" id="tax_rate"></td>' +
      '<td>' + actions + '</td>' +
      '</tr>';
      $("table").append(row);
      $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
      $('[data-toggle="tooltip"]').tooltip();
    });
    // Add row on add button click
    $(document).on("click", ".add", function(){
      var empty = false;
      var input = $(this).parents("tr").find('input[type="text"]');
      input.each(function(){
         if(!$(this).val()){
            $(this).addClass("error");
            empty = true;
         } else{
            $(this).removeClass("error");
         }
      });

      var id =  input[0].value;
      var description = input[1].value;
      var market_price = input[2].value;
      var admin_fee = input[3].value;
      var tax_rate = input[4].value;

      $.ajax({
         type: "POST",
         url: '/trading-master-save',
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: {
            id: id,
            market_price: market_price, 
            description: description, 
            admin_fee: admin_fee, 
            tax_rate: tax_rate
         }
      }).done(function( msg ) {
      });

      $(this).parents("tr").find(".error").first().focus();
      console.log(empty);
      if(!empty){
         input.each(function(){
            $(this).parent("td").html($(this).val());
         });
         $(this).parents("tr").find(".add, .edit").toggle();
         $(".add-new").removeAttr("disabled");
      }
    });
    // Edit row on edit button click
    $(document).on("click", ".edit", function(){
      $(this).parents("tr").find("td:not(:last-child)").each(function(){
      $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
      });
      $(this).parents("tr").find(".add, .edit").toggle();
      $(".add-new").attr("disabled", "disabled");
   });

      // Delete row on delete button click
      $(document).on("click", ".delete", function(){
         $(this).parents("tr").find("td:not(:last-child)").each(function(){
            if($(this).is("#e_id")){
               $.ajax({
               type: "POST",
               url: '/trading-master-delete',
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               data: { 
                  id: $(this).text()
               }
               }).done(function( msg ) {
               });
            }
            });
            $(this).parents("tr").remove();
            $(".add-new").removeAttr("disabled");
      });
    });
    </script>
@stop