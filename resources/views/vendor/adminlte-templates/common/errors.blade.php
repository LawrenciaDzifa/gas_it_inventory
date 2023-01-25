@if(!empty($errors))
    @if($errors->any())
        <ul class="alert alert-danger" style="list-style-type: none">
            @foreach($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    @endif
@endif
{{-- @if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors')->first() }}
    </div>
@endif --}}
