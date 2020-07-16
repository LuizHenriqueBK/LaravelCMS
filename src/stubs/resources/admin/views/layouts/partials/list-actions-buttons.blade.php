<div class="d-flex flex-wrap justify-content-around align-self-center">
    @php ($module = Str::plural(Str::lower(class_basename($row))))
    @can("{$module}.read")
    <a class="btn btn-info" href="{{ route('admin.'.$module.'.show', $row->id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
    @endcan

    @can("{$module}.update")
    <a class="btn btn-success" href="{{ route('admin.'.$module.'.edit', $row->id) }}">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
    @endcan

    @can("{$module}.delete")
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['admin.'.$module.'.destroy', $row->id],
            'class' =>'form-inline form-delete'
            ])
        !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>',[
            'type' => 'submit',
            'class' => 'btn btn-danger',
            ])
        !!}
        {!! Form::close() !!}
    @endcan
</div>
