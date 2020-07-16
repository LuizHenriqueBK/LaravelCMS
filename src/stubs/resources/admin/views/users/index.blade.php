@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row">
        <!-- Page Heading -->
        <header class="col col-md-12 d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h1 mb-0 text-gray-800">{{ Str::ucfirst(__('users')) }}</h1>
            <a href="{{ route('admin.users.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                {{ Str::ucfirst(__('create new user')) }}
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Grupos</th>
                                <th>Status</th>
                                <th width="175">Acões</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($model as $row)
                            <tr>
                                <td role="row">{{ $row->id }}</td>
                                <td class="d-flex justify-content-center">
                                    <img src="{{ $row->avatar->url ?? 'https://via.placeholder.com/125/FFFFFF/0000FF?text=Sem+Avatar' }}" width="125" />
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @forelse($row->roles as $role)
                                        <div class="badge badge-info ml-2">{{ $role->name }}</div>
                                    @empty
                                    &nbsp;
                                    @endforelse
                                </td>
                                <td>{{ $row->status ? 'Ativo' : 'Inativo' }}</td>
                                <td> @include('Admin::layouts.partials.list-actions-buttons')</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <p class="text-muted text-center">{{ Str::ucfirst(__('no records found')) }}</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @include('Admin::layouts.partials.pagination')
                </div>
            </div>
        </section>
    </div>
    <!--end row -->
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush
