<div class="row align-items-center">
    <div class="col-sm-12 col-md-5">
        @php
            $text = __('viewing ? to ? of ? records');
            $values = [$model->firstItem(), $model->lastItem(), $model->total()];
        @endphp
        {{ Str::ucfirst(Str::replaceArray('?', $values, $text)) }}
    </div>
    <div class="col-sm-12 col-md-7 d-flex justify-content-end">
        {{ $model->withQueryString()->onEachSide(3)->links() }}
    </div>
</div>
