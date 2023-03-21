@extends('layouts.app')
{{-- @extends('stocks.index') --}}

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashborad</h1>
            </div>

        </div>
    </div>
</section>
<div class="container">
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-lg-4 col-md-6 p-4">
                <div class="info-box bg-danger ">
                    <span class="info-box-icon"><i class="fa fa-cubes text-white fa-2x"></i></span>
                    <div class="info-box-content">

                        <h4 class="info-box-text text-center" >Total Items</h4>

                        {{-- <span class="info-box-text text-center">Total Items</span> --}}
                        <span class="info-box-number text-center"><?= ($totalItems) ? $totalItems : '0' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 p-4">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fa fa-shopping-basket text-white fa-2x"></i></span>
                    <div class="info-box-content">
                        <h4 class="info-box-text text-center text-white" >Total Requisitions</h4>

                        {{-- <span class="info-box-text text-center text-white">Total Requisitions</span> --}}
                        <span class="info-box-number text-center text-white"><?= ($totalRequisitions) ? $totalRequisitions : '0' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 p-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-cubes text-white fa-2x"></i></span>
                    <div class="info-box-content">
                        <h4 class="info-box-text text-center " >Total Assignments</h4>

                        {{-- <span class="info-box-text text-center text-white">Total Assignments</span> --}}
                        <span class="info-box-number text-center text-white"><?= ($totalAssignments) ? $totalAssignments : '0' ?></span>
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
