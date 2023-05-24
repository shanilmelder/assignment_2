@extends('layouts.app')

@section('content')
<!-- Full Page Image Header with Vertically Centered Content -->
<header
      class="masthead"
      style="
        height: 70vh;
        min-height: 500px;
        background-image: url('images/header.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      "
    >
      <div class="container">
        <div class="row h-50 align-items-center">
          <div
            class="col-12 text-center"
            style="
              background-color: black;
              padding-top: 80px;
              padding-bottom: 80px;
              margin-top: 120px;
              opacity: 0.6;
            "
          >
            <h1 class="fw-light" style="color: rgb(255, 255, 255)">
              Tassie Green Energy Trading Company (TaGET)
            </h1>
            <p class="lead" style="color: rgb(255, 255, 255)">
              Tasmania's Most Trusted Energy Trading Company
            </p>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
<section class="py-5">
   <div class="container">
   <div class="row">
      <div class="col-md-12">
      <h2>Search for available renewable energy</h2>
      <form class="form-inline">
         <div class="form-group mb-2">
            <select class="form-control" aria-label="">
              <option selected>Select type of Energy</option>
              @foreach($energyTypes as $energyType)
                <option value="{{ $energyType->id }}">{{$energyType->description}}</option>
              @endforeach
            </select>
         </div>
         <div class="form-group mx-sm-3 mb-2">
         <select class="form-control" aria-label="Select Zone">
              <option selected>Select zone</option>
              @foreach ($zones as $zone)
                <option value="{{ $zone->id }}">{{$zone->description}}</option>
              @endforeach
            </select>
         </div>
         <button type="submit" class="btn btn-primary mb-2">Search</button>
      </form>
      </div>
   </div>
</section>

@endsection
