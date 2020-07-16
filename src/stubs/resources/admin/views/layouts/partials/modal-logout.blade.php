<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="modal-logout-Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-logout-Label">{{ Str::ucfirst(__('ready to leave?')) }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>{{ Str::ucfirst(__('click "Sign out" below if you are ready to end your current session.')) }}</p>
            </div>
            <div class="modal-footer">
                <form id="form-logout" action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">{{ Str::ucfirst(__('cancel')) }}</button>
                    <button type="submit" class="btn btn-danger btn-delete">
                        {{ Str::ucfirst(__('logout')) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
