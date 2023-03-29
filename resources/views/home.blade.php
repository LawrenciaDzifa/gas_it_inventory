@extends('layouts.app')
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
                    <span class="info-box-icon"><i class="fa fa-cubes text-white "></i></span>
                    <div class="info-box-content">

                        <h6 class="info-box-text text-center" >Total Items</h6>

                        {{-- <span class="info-box-text text-center">Total Items</span> --}}
                        <span class="info-box-number text-center"><?= ($totalItems) ? $totalItems : '0' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 p-4">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fa fa-shopping-basket text-white "></i></span>
                    <div class="info-box-content">
                        <h6 class="info-box-text text-center text-white" >Total Requisitions</h6>

                        {{-- <span class="info-box-text text-center text-white">Total Requisitions</span> --}}
                        <span class="info-box-number text-center text-white"><?= ($totalRequisitions) ? $totalRequisitions : '0' ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 p-4">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-cubes text-white "></i></span>
                    <div class="info-box-content">
                        <h6 class="info-box-text text-center " >Total Assignments</h6>

                        {{-- <span class="info-box-text text-center text-white">Total Assignments</span> --}}
                        <span class="info-box-number text-center text-white"><?= ($totalAssignments) ? $totalAssignments : '0' ?></span>
                    </div>
                </div>
            </div>

        </div>


    </div>

  </div>
<div class="card">
    <div class="card-body p-10">

@include('requisitions.table')
{{-- {!! $dataTable->table(['class' => 'table table-bordered']) !!} --}}


        <div class="card-footer clearfix">
            <div class="float-right">

            </div>
        </div>
    </div>
</div>

@endsection
