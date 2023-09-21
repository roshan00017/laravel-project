<div class="modal fade" id="dataSubmitModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content text-center modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    @if (systemSetting())
                        {{ getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
                    @else
                        {{ trans('message.pages.common.app_short_name') }}
                    @endif
                </h4>
            </div>

            <div class="modal-body">
                <i class="fas fa-6x fa-sync-alt fa-spin text-primary" style="margin: 20px;"></i>

                <h5 class="{{ setFont() }}">
                    {{ trans('common.data_submit_message') }}
                </h5>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
