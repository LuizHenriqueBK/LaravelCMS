@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row">
        <!-- Page Heading -->
        <header class="col col-md-12 d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h1 mb-0 text-gray-800">{{ Str::ucfirst(__('role')) }}@if($model) - <b>{{$model->title}}</b>@endif</h1>
            <a href="{{ route('admin.roles.index') }}"
                class="btn btn-sm btn-primary shadow-sm">
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
                        {{ Form::model($model, ['route' => ['admin.roles.update', $model->id], 'files' => true]) }}
                        @method('PUT')
                    @else
                        {{ Form::open(['route' => ['admin.roles.store'], 'files' => true]) }}
                    @endisset

                    <div class="form-group">
                        {{ Form::label('title', 'Título', ['class' => 'form-label']) }}
                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('name', 'Código', ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', 'Descrição', ['class' => 'form-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5]) }}
                        @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('permissions', 'Permissões', ['class' => 'form-label']) }}
                        <div class="col border rounded py-3">
                            @forelse($permissions as $title => $_permissions)
                                <div class="form-group row">
                                    <div class="col mx-2">
                                        <div class="row pt-2 pl-2 title-module">
                                            {{ Str::ucfirst(__($title)) }}
                                        </div>
                                        <div class="row p-2 pt-5 bg-light rounded">
                                        @foreach($_permissions as $permission)
                                            <div class="col d-flex flex-column">
                                                <label class="form-label">{{ Str::title(__(trim(str_replace($title, '', $permission->title)))) }}</label>
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    class="form-control"
                                                    @if(in_array($permission->id, old('permissions', Arr::pluck(optional($model)->permissions??[], 'id'))))
                                                        checked="checked"
                                                    @endif
                                                    value="{{ $permission->id }}"
                                                    data-toggle="toggle"
                                                    data-on="Ativa"
                                                    data-off="Inativa"
                                                    data-width="125"
                                                    data-onstyle="primary"
                                                    data-offstyle="danger"
                                                />
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        @error('permissions')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="row mt-4">
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
