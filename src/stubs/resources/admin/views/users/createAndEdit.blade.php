@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row">
        <!-- Page Heading -->
        <header class="col col-md-12 d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h1 mb-0 text-gray-800">{{ Str::ucfirst(__('user')) }}@if($model) - <b>{{$model->name}}</b>@endif</h1>
            <a href="{{ route('admin.users.index') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                {{ Str::ucfirst(__('back')) }}
            </a>
        </header>

        <section class="col col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <div class="dropdown no-arrow">
                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div aria-labelledby="dropdownMenuLink" class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @isset($model)
                        {{ Form::model($model, ['route' => ['admin.users.update', $model->id], 'files' => true]) }}
                        @method('PUT')
                    @else
                        {{ Form::open(['route' => ['admin.users.store'], 'files' => true]) }}
                    @endisset
                    <div class="form-row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4 form-group">
                                    {{ Form::label('name', 'Nome') }}
                                    {{ Form::text('name', null, ['class'=>'form-control']) }}
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('email', 'E-Mail') }}
                                    {{ Form::email('email', null, ['class'=>'form-control']) }}
                                    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-4 form-group">
                                    {{ Form::label('roles', 'Grupos') }}
                                    {{ Form::select('roles[]', $roles, null, ['class'=>'form-control selectpicker', 'multiple']) }}
                                    @error('roles')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    {{ Form::label('password', 'Senha') }}
                                    {{ Form::password('password', ['class'=>'form-control']) }}
                                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-2 form-group">
                                    {{ Form::label('status', 'Ativo') }}
                                    <input type="hidden" name="status" value="0">
                                    {{ Form::checkbox('status', 1, null, [
                                        'class' => 'form-control',
                                        'data-toggle' => 'toggle',
                                        'data-on' => 'Sim',
                                        'data-off' => 'Não',
                                        'data-width' => 125,
                                        'data-onstyle' => 'success'
                                       ])
                                   }}
                                   @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2 form-group">
                                    {{ Form::label('avatar', 'Avatar') }}
                                    {{ Form::file('avatar', [
                                        'class' => 'form-control dropify',
                                        'data-height' => '150',
                                        'data-default-file' => old('file', optional($model)->avatar->url??null),
                                        'data-allowed-file-extensions' => 'jpg jpeg png gif'
                                       ])
                                    }}
                                    @error('file')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            {{ Form::submit('Salvar', ['class' => 'btn btn-md btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
