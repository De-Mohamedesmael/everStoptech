<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">


            <h4 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.view_payments')
            </h4>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">

            @include('gift_card.partials.payment_table', [
                'payments' => $transaction_payments,
                'show_action' => 'yes',
            ])
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="button" class="btn btn-danger col-md-3" data-dismiss="modal">@lang('lang.close')</button>
        </div>



    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
