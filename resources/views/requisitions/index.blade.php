@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Requisitions</h1>
                </div>
                <div class="col-sm-6">
                    @if (Auth::user()->role == 'admin')
                        <a class="btn btn-primary float-right"
                           href="{{ route('requisitions.create') }}">
                            Add New
                        </a>

                    @else
                        <a class="btn btn-primary float-right"
                           href="{{ route('requisitions.create') }}">
                            Place Request
                        </a>

                    @endif
                    {{-- <a class="btn btn-primary float-right"
                       href="{{ route('requisitions.create') }}">
                        Add New
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-10">

                @include('requisitions.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

