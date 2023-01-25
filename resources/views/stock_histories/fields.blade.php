<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_name', 'Item Name:') !!}
    {!! Form::select('item_name', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Category Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_name', 'Category Name:') !!}
    {!! Form::select('category_name', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Added Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('date_added', 'Date Added:') !!}
    {!! Form::text('date_added', null, ['class' => 'form-control','id'=>'date_added']) !!}
</div> --}}

@push('page_scripts')
    <script type="text/javascript">
        $('#date_added').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
