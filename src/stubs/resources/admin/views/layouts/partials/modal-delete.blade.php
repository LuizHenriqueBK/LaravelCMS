<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-delete-abel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-delete-Label">{{ Str::ucfirst(__('delete confirmation')) }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>{{ Str::ucfirst(__('are you sure you want to delete this item?')) }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{ Str::ucfirst(__('cancel')) }}</button>
                <button type="button" class="btn btn-sm btn-danger btn-delete">{{ Str::ucfirst(__('delete')) }}</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.form-delete', function(e) {
            e.preventDefault();
            var form = $(this);
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false })
            .on('click', '.btn-delete', function(){
                form.submit();
            });
        });
    </script>
@endpush
