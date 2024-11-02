<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('MoneySafeTransferController@postAddMoneyToSafe', $money_safe_id),
            'method' => 'post',
            'id' => 'add_money_form',
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

            <h5 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;">@lang('lang.add_money_to_safe')
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div class="modal-body">
            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">


                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('source_type', __('lang.source_type') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('source_type', ['employee' => __('lang.employee'), 'safe' => __('lang.safe')], 'employee', [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                        ]) !!}

                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('source_id', __('lang.source') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('source_id', $emplooyes, false, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}

                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('job_type_id', __('lang.job') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('job_type_id', $job_types, false, [
                            'class' => 'form-control modal-input',
                            'style' => 'height:fit-content;!importnat',
                        
                            'required',
                            'readonly',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}

                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('store_id', __('lang.store') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('store_id', $stores, false, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}

                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('amount', __('lang.amount'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('amount', null, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.amount'),
                        ]) !!}

                    </div>
                </div>
                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('currency_id', __('lang.currency') . '*', [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::select('currency_id', $currencies, false, [
                            'class' => 'form-control selectpicker',
                            'data-live-search' => 'true',
                            'required',
                        ]) !!}
                    </div>
                </div>


                <div class="col-md-6 px-5">
                    <div class="form-group">
                        {!! Form::label('comments', __('lang.comments'), [
                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                        ]) !!}
                        {!! Form::text('comments', null, [
                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                            'placeholder' => __('lang.comments'),
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn col-md-3 btn-primary">@lang('lang.save')</button>
            <button type="button" class="btn col-md-3 btn-default" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $('.selectpicker').selectpicker();
    $('select#source_id').change();
    $(document).on('change', 'select#source_type', function() {
        let source_type = $(this).val();

        if (source_type == 'employee') {
            $.ajax({
                method: 'get',
                url: '/hrm/employee/get-dropdown',
                data: {},
                success: function(result) {
                    $('#source_id').html(result);
                    $('#source_id').selectpicker('refresh');
                },
            });
        }
        if (source_type == 'safe') {
            $.ajax({
                method: 'get',
                url: '/money-safe/get-dropdown',
                data: {},
                success: function(result) {
                    $('#source_id').html(result);
                    $('#source_id').selectpicker('refresh');
                },
            });
        }
    })

    $(document).on('change', 'select#source_id', function() {
        let source_type = $('#source_type').val();
        let source_id = $(this).val();

        if (source_type == 'employee') {
            $.ajax({
                method: 'get',
                url: '/hrm/get-employee-details-by-id/' + source_id,
                data: {},
                success: function(result) {
                    console.log(result.employee.store_id[0], 'result.employee.store_id');
                    $('#store_id').val(result.employee.store_id[0]);
                    $('#store_id').selectpicker('refresh');
                    $('#job_type_id').val(result.employee.job_type_id);
                    $('#job_type_id').selectpicker('refresh');
                    if ($('select#job_type_id :selected').text() == 'Cashier') {
                        $('#comments').val("{{ __('lang.closing_cash') }}");
                    } else {
                        $('#comments').val("");
                    }
                },
            });
        }
        if (source_type == 'safe') {
            $.ajax({
                method: 'get',
                url: '/money-safe/get-details-by-id/' + source_id,
                data: {},
                success: function(result) {
                    $('#store_id').val(result.store_id);
                    $('#store_id').selectpicker('refresh');
                    $('#job_type_id').val('');
                    $('#job_type_id').selectpicker('refresh');
                },
            });
        }
    })
</script>
