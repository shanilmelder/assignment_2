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
                <h2>Trade Energy Types</h2>
             </div>
             @if(Auth::user()->role == "Seller" || Auth::user()->role == "StoreManager")
             <div class="col-sm-4">
               <button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#SellerModal"><i class="fa fa-money"></i> Sell</button>
             </div>
             @endif
          </div>
       </div>
       <table class="table table-bordered">
          <thead>
             <tr>
                <th>Energy Type</th>
                <th>Volume (kWh)</th>
                <th>Price</th>
             </tr>
          </thead>
          <tbody>
             @foreach($sales as $sale)
             <tr>
                <td id="e_id">{{$sale->energy_type_id}}</td>
                <td id="e_description">{{$sale->energyType->description}}</td>
                <td id="e_volume">{{$sale->volume}}</td>
                <td id="e_price">{{$sale->price}}</td>
                <td>
                  @if(Auth::user()->role == "Buyer")
                   <button type="button" class="btnBuy btn btn-danger" title="" data-toggle="modal" data-target="#BuyerModal" data-original-title="Buy" data-id="{{$sale->energy_type_id}}">Buy</button>
                  @endif
                  @if(Auth::user()->role == "StoreManager")
                   <button type="button" class="btnBuy btn btn-danger" title="" data-toggle="modal" data-target="#BuyerModal" data-original-title="Buy" data-id="{{$sale->energy_type_id}}">Buy</button>
                  @endif
                </td>
             </tr>
             @endforeach
          </tbody>
       </table>
    </div>
    <!--Buyer Modal -->
   <div id="BuyerModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
   
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Buy Energy</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <input type="hidden" name="id" id="id" value=""/>
               <div class="col-md-6">
                  <label for="volume" class="col-md-4 control-label">Volume</label>
               </div>
               <div class="col-md-6">
                  <input id="volume" type="text" class="form-control" name="volume" required>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6 col-md-offset-10">
                  <button type="submit" class="btn btn-danger mdlBuy">Buy</button>
               </div>
            </div>
         </div>
      </div>
   
      </div>
   </div>

   <!--Seller Modal -->
   <div id="SellerModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
   
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sell Energy</h4>
         </div>
         <div class="modal-body">
            <input type="hidden" name="id" id="id" value=""/>
            <div class="row">
               <div class="col-md-6">
                  <label for="energyType" class="col-md-4 control-label">Volume</label>
               </div>
               <div class="col-md-6">
                  <select id="energyType" class="form-control" aria-label="">
                     <option selected>Select type of Energy</option>
                     @foreach($energyTypes as $energyType)
                       <option value="{{ $energyType->id }}">{{$energyType->description}}</option>
                     @endforeach
                   </select>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6">
                  <label for="sellvolume" class="col-md-4 control-label">Volume</label>
               </div>
               <div class="col-md-6">
                  <input id="sellvolume" type="text" class="form-control" name="sellvolume" required>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6">
                  <label for="price" class="col-md-4 control-label">Price</label>
               </div>
               <div class="col-md-6">
                  <input id="price" type="text" class="form-control" name="price" required>
              </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6 col-md-offset-10">
                  <button type="submit" class="btn btn-success mdlSell">Sell</button>
               </div>
            </div>
         </div>
      </div>
   
      </div>
   </div>
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