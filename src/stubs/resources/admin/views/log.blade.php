@extends('Admin::layouts.app')

@push('styles')
    <style type="text/css"></style>
@endpush

@section('content')
    <div class="row mb-4">
        <!-- Page Heading -->
        <header class="row col col-md-12 d-sm-flex align-items-center mb-4">
            <h1 class="col-10 h1 mb-0 text-gray-800">{{ Str::ucfirst(__('logs')) }}</b></h1>
        </header>

        <div class="col col-md-12">
            <pre style="height:600px;width:100%;overflow: auto;">{{ $log }}</pre>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript"></script>
@endpush

