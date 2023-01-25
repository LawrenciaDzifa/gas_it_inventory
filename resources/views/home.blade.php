@extends('layouts.app')
{{-- @extends('stocks.index') --}}

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row mt-20">
            <div class="col-12 col-sm-2 col-md-4 bg-success">
              <!-- Column 1 content goes here -->
              <div class=" mb-2">
                  <span class="info-box-icon theme-bg-default "><i class="fa fa-cubes text-white"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Items</span>
                        {{-- <span class="info-box-number"><?= ($dashboard['tot_vehicles']!='') ? $dashboard['tot_vehicles']:'0' ?>  </span> --}}
                     </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-4 bg-danger ">
              <!-- Column 2 content goes here -->
              <div class=" mb-2">
                  <span class="info-box-icon theme-bg-default "><i class="fa fa-shopping-basket text-white"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Requisitions</span>
                        {{-- <span class="info-box-number"><?= ($dashboard['tot_vehicles']!='') ? $dashboard['tot_vehicles']:'0' ?>  </span> --}}
                     </div>
              </div>
            </div>
            <div class="col-12 col-sm-2 col-md-4 bg-warning">
              <!-- Column 3 content goes here -->
              <div class=" mb-2">
                  <span class="info-box-icon theme-bg-default "><i class="fa fa-cubes text-white"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text text-white">Total Assignments</span>
                        {{-- <span class="info-box-number"><?= ($dashboard['tot_vehicles']!='') ? $dashboard['tot_vehicles']:'0' ?>  </span> --}}
                     </div>
              </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="card">
                <div class="card-body p-0">
                    @include('stocks.table')

                    <div class="card-footer clearfix">
                        <div class="float-right">

                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
    </div>

  </div>
@endsection
