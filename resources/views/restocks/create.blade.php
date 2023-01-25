@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Restock</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'restocks.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('restocks.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary','id' => 'save-button']) !!}
                <a href="{{ route('restocks.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

{{-- restock items modal box --}}
<div id="restocked-items-modal" style="display: none,color:#000000;">
    <div id="restocked-items-container"></div>
    <button id="close-modal">Close</button>
</div>


