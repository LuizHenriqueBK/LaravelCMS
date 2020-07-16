@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row mb-4">
        <!-- Page Heading -->
        <header class="row col col-md-12 d-sm-flex align-items-center mb-4">
            <h1 class="col-10 h1 mb-0 text-gray-800">{{ Str::ucfirst(__('user')) }} - <b>{{ $model->name }}</b></h1>
            <div class="col justify-content-end">
                <a href="{{ route('admin.users.index') }}"
                    class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    {{ Str::ucfirst(__('back')) }}
                </a>
                <a href="{{ route('admin.users.edit', $model->id) }}"
                    class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                    {{ Str::ucfirst(__('edit')) }}
                </a>
            </div>
        </header>

        <div class="col col-md-12">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="col">
                                <img class="img-thumbnail" alt="{{ $model->name }}" src="{{  $model->avatar->url }}" style="width:100%;height:275px" />
                            </div>
                            <div class="col">
                                <h4 class="mt-2 mb-0">{{ $model->name }}</h4>
                                @php
                                    $text = '<span class="badge badge-success m-1 p-2">?</span>';
                                    $values = $model->roles->pluck('title')->toArray();
                                @endphp
                                <p class="text-muted mb-1">
                                    {!! Str::replaceArray('?', $values, str_repeat($text, count($values))) !!}
                                </p>
                                <a href="{{ route('admin.users.edit', $model->id) }}"
                                    class="btn btn-primary btn-sm ripple">
                                    <i class="far fa-edit mr-1"></i>
                                    {{ Str::ucfirst(__('edit')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table row table-borderless">
                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                        <tr>
                                            <td><strong>Nome: </strong> {{ $model->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email: </strong> {{ $model->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status: </strong> {{ $model->status ? 'Ativo' :'Inativo' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush

