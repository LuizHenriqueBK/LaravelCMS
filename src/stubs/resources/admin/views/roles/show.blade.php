@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row mb-4">
        <!-- Page Heading -->
        <header class="row col col-md-12 d-sm-flex align-items-center mb-4">
            <h1 class="col-10 h1 mb-0 text-gray-800">{{ Str::ucfirst(__('role')) }} - <b>{{ $model->title }}</b></h1>
            <div class="col justify-content-end">
                <a href="{{ route('admin.roles.index') }}"
                    class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                    {{ Str::ucfirst(__('back')) }}
                </a>
                <a href="{{ route('admin.roles.edit', $model->id) }}"
                    class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i>
                    {{ Str::ucfirst(__('edit')) }}
                </a>
            </div>
        </header>

        <div class="col col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table row table-borderless">
                            <tbody class="col-lg-12 col-xl-6 p-0">
                                <tr>
                                    <td><strong>Titulo: </strong> {{ $model->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Código: </strong> {{ $model->name }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Descrição: </strong>
                                        <p>{{ $model->description }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush

