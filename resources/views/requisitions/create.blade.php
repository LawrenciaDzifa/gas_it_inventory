@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Requisition</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'requisitions.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('requisitions.fields')
                </div>

            </div>

            <div class="card-footer">
                {{-- {!! Form::submit(if(auth()user()->role=='admin'? 'Save':'Place Request'), ['class' => 'btn btn-primary']) !!} --}}
                {!! Form::submit(auth()->user()->role=='admin' ? 'Save' : 'Place Request', ['class' => 'btn btn-primary']) !!}



                <a href="{{ route('requisitions.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
