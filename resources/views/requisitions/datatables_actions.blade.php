{!! Form::open(['route' => ['requisitions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('requisitions.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye "></i>
    </a>
    <a href="{{ route('requisitions.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit "></i>
    </a>

    <a href="{{ route('approve', $id) }}" class="btn btn-default btn-xs">
        <i class="fa fa-check text-success"></i>
    </a>
    <a href="{{ route('decline', $id) }}" class="btn btn-default btn-xs">
        <i class="fa fa-times text-danger"></i>
    </a>

    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
