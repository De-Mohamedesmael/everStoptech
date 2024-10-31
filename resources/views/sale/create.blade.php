@extends('layouts.app')
@section('title', __('lang.add_sale'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/product.css') }}">
@endsection
@section('content')
    <section class="forms py-0">
        <div class="container-fluid no-print">
            <div class="row">
                <div class="col-md-12 px-1">
                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.add_sale')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    {!! Form::open([
                        'url' => action('SellPosController@store'),
                        'method' => 'post',
                        'files' => true,
                        'class' => 'pos-form',
                        'id' => 'add_sale_form',
                    ]) !!}
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                {{-- <input type="hidden" name="is_add_stock" id="is_add_stock" value="1"> --}}
                                <input type="hidden" name="default_customer_id" id="default_customer_id"
                                    value="@if (!empty($walk_in_customer)) {{ $walk_in_customer->id }} @endif">
                                <input type="hidden" name="row_count" id="row_count" value="0">

                                <div class="col-md-3 px-5">
                                    {!! Form::label('customer_id', __('lang.customer'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <div class="input-group my-group select-button-group">
                                        {!! Form::select('customer_id', $customers, !empty($walk_in_customer) ? $walk_in_customer->id : null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'id' => 'customer_id',
                                        ]) !!}
                                        <span class="input-group-btn">
                                            @can('customer_module.customer.create_and_edit')
                                                <button class="btn-modal btn-flat select-button "
                                                    data-href="{{ action('CustomerController@create') }}?quick_add=1"
                                                    data-container=".view_modal"><i class="fa fa-plus"></i></button>
                                            @endcan
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    {!! Form::label('transaction_date', __('lang.date_and_time'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    <input type="datetime-local" id="transaction_date" name="transaction_date"
                                        value="{{ date('Y-m-d\TH:i') }}"
                                        class="form-control modal-input @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_id', __('lang.store') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_id', $stores, $store_pos->store_id ?? null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('store_pos_id', __('lang.pos') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('store_pos_id', $store_poses, $store_pos->id ?? null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'required',
                                            'style' => 'width: 80%',
                                            'placeholder' => __('lang.please_select'),
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                        <div class="col-md-10 mb-3">
                            <div class="search-box input-group"
                                style="background-color: #e6e6e6;border-radius: 6px!important">
                                <button type="button" class="select-button " style="height: auto !important"
                                    id="search_button"><i class="fa fa-search"></i></button>
                                <input type="text" name="search_product" id="search_product"
                                    placeholder="@lang('lang.enter_product_name_to_print_labels')"
                                    class="form-control ui-autocomplete-input modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                    style="width: 80% !important" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            @include('quotation.partial.product_selection')
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="col-md-12">
                                <div class="table-responsive transaction-list">
                                    <table id="product_table" style="width: 100% " class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 20%">{{ __('lang.product') }}</th>
                                                <th style="width: 15%">{{ __('lang.quantity') }}</th>
                                                <th style="width: 10%">{{ __('lang.price') }}</th>
                                                <th style="width: 10%">{{ __('lang.discount') }}</th>
                                                <th style="width: 15%">{{ __('lang.category_discount') }}</th>
                                                <th style="width: 10%">{{ __('lang.sub_total') }}</th>
                                                @if (session('system_mode') != 'restaurant')
                                                    <th style="width: 10%">{{ __('lang.current_stock') }}</th>
                                                @endif
                                                <th style="width: 10%;">
                                                    @lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <th style="text-align: right">@lang('lang.total')</th>
                                                <th><span class="grand_total_span"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="display: none;">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="hidden" id="final_total" name="final_total" />
                                <input type="hidden" id="grand_total" name="grand_total" />
                                <input type="hidden" id="gift_card_id" name="gift_card_id" />
                                <input type="hidden" id="coupon_id" name="coupon_id">
                                <input type="hidden" id="total_tax" name="total_tax" value="0.00">
                                <input type="hidden" id="is_direct_sale" name="is_direct_sale" value="1">
                                <input type="hidden" name="discount_amount" id="discount_amount">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                            for="tax_id">@lang('lang.tax')</label>
                                        <select class="form-control" name="tax_id" id="tax_id">
                                            <option value="" selected>No Tax</option>
                                            @foreach ($taxes as $tax)
                                                <option data-rate="{{ $tax->rate }}" value="{{ $tax->id }}">
                                                    {{ $tax->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('discount_type', __('lang.discount_type') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('discount_type', ['fixed' => 'Fixed', 'percentage' => 'Percentage'], 'fixed', [
                                            'class' => 'form-control',
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('discount_value', __('lang.discount_value') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::text('discount_value', null, [
                                            'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                                            'placeholder' => __('lang.discount_value'),
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-md-3 px-5">
                                    <div class="form-group">
                                        {!! Form::label('status', __('lang.status') . '*', [
                                            'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                        ]) !!}
                                        {!! Form::select('status', ['final' => 'Completed', 'pending' => 'Pending'], 'final', [
                                            'class' => 'form-control',
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div id="payment_rows" class="col-md-12">
                                <div
                                    class="row payment_row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                    <div class="col-md-3 px-5">
                                        <div class="form-group">
                                            {!! Form::label('payment_status', __('lang.payment_status') . '*', [
                                                'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                            ]) !!}
                                            {!! Form::select('payment_status', $payment_status_array, null, [
                                                'class' => 'selectpicker form-control',
                                                'data-live-search' => 'true',
                                                'required',
                                                'style' => 'width: 80%',
                                                'placeholder' => __('lang.please_select'),
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3  payment_fields hide">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">@lang('lang.payment_method')</label>
                                        {!! Form::select('payments[0][method]', $payment_types, null, [
                                            'class' => 'form-control',
                                            'id' => 'method',
                                            'required',
                                            'data-live-search' => 'true',
                                        ]) !!}
                                    </div>
                                    <div class="col-md-3 payment_fields hide">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">@lang('lang.received_amount')
                                            *</label>
                                        <input type="text" name="payments[0][amount]"
                                            class="form-control numkey received_amount" required id="amount"
                                            step="any">
                                    </div>
                                    <div class="col-md-3 mt-1 payment_fields hide">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">@lang('lang.paying_amount')
                                            *</label>
                                        <input type="text" name="paying_amount" class="form-control numkey"
                                            id="paying_amount" step="any">
                                    </div>
                                    <div class="col-md-3 payment_fields hide ">
                                        <label
                                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif change_text  ">@lang('lang.change')
                                        </label>
                                        <span class="change" class="ml-2">0.00</span>
                                        <input type="hidden" name="payments[0][change_amount]" class="change_amount"
                                            value="0">
                                        <input type="hidden" name="payments[0][pending_amount]" class="pending_amount">
                                    </div>

                                    <div class="col-md-12 hide">
                                        <div class="i-checks">
                                            <input id="print_the_transaction" name="print_the_transaction"
                                                type="checkbox" checked value="1" class="form-control-custom">
                                            <label for="print_the_transaction"><strong>@lang('lang.print_the_transaction')</strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 mt-3 card_field payment_fields hide">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>@lang('lang.card_number') *</label>
                                                <input type="text" name="payments[0][card_number]"
                                                    class="form-control">
                                            </div>
                                            {{-- <div class="col-md-3 px-5">
                                        <label>@lang('lang.card_security')</label>
                                        <input type="text" name="payments[0][card_security]" class="form-control">
                                    </div> --}}
                                            <div class="col-md-2">
                                                <label>@lang('lang.month')</label>
                                                <input type="text" name="payments[0][card_month]"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>@lang('lang.year')</label>
                                                <input type="text" name="payments[0][card_year]" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 cheque_field payment_fields hide">
                                        <label>@lang('lang.cheque_number') *</label>
                                        <input type="text" name="payments[0][cheque_number]" class="form-control">
                                    </div>
                                    <div class="form-group col-md-12 gift_card_field hide">
                                        <div class="col-md-12">
                                            <label>@lang('lang.gift_card_number') *</label>
                                            <input type="text" name="payments[0][gift_card_number]"
                                                id="gift_card_number" class="form-control"
                                                placeholder="@lang('lang.enter_gift_card_number')">
                                            <span class="gift_card_error" style="color: red;"></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label><b>@lang('lang.current_balance'):</b> </label><br>
                                                <span class="gift_card_current_balance"></span>
                                                <input type="hidden" name="payments[0][gift_card_current_balance]"
                                                    id="gift_card_current_balance">
                                            </div>
                                            <div class="col-md-4">
                                                <label>@lang('lang.enter_amount_to_be_used') </label>
                                                <input type="text" name="payments[0][amount_to_be_used]"
                                                    id="amount_to_be_used" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>@lang('lang.remaining_balance') </label>
                                                <input type="text" name="payments[0][remaining_balance]"
                                                    id="remaining_balance" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label><b>@lang('lang.final_total'):</b> </label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="payments[0][gift_card_final_total]"
                                                    id="gift_card_final_total" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="row w-100 flex-column">

                                            <div
                                                class="d-flex my-2  @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                                                <button class="text-decoration-none toggle-button mb-0" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#detailsCollapse"
                                                    aria-expanded="false" aria-controls="detailsCollapse">
                                                    <i class="fas fa-arrow-down"></i>
                                                    @lang('lang.product_details')
                                                    <span class="toggle-pill"></span>
                                                </button>
                                            </div>
                                            <div class="collapse" id="detailsCollapse">
                                                <div class="card mb-2">
                                                    <div class="card-body p-2">
                                                        <div class="form-group col-md-12">
                                                            <label
                                                                class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif">@lang('lang.payment_note')</label>
                                                            <textarea id="payment_note" rows="2"
                                                                class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                                                name="payment_note"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2 btn-add-payment">
                                <button type="button" id="add_payment_row" class="btn btn-primary btn-block">
                                    @lang('lang.add_payment_row')</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>@lang('lang.sale_note')</label>
                                    <textarea rows="3" class="form-control" name="sale_note"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>@lang('lang.staff_note')</label>
                                    <textarea rows="3" class="form-control" name="staff_note"></textarea>
                                </div>
                                <div class="col-md-4">
                                    {!! Form::label('terms_and_condition_id', __('lang.terms_and_conditions'), []) !!}
                                    <div class="input-group my-group">
                                        {!! Form::select('terms_and_condition_id', $tac, null, [
                                            'class' => 'selectpicker form-control',
                                            'data-live-search' => 'true',
                                            'style' => 'width: 80%',
                                            'id' => 'terms_and_condition_id',
                                        ]) !!}
                                    </div>
                                    <div class="tac_description_div"><span></span></div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <button type="submit" name="action" value="submit"
                                        class="btn btn-primary">@lang('lang.save')</button>
                                    <button type="button" class="btn btn-success" name="action" value="print"
                                        id="print-btn">
                                        @lang('lang.print')
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#sendModal">
                                        @lang('lang.send')
                                    </button>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="sendModal" tabindex="-1" role="dialog"
                                aria-labelledby="sendModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sendModalLabel">@lang('lang.emails')</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="text-muted"
                                                        style="font-size: 12px">@lang('lang.separated_by_comma')</small>
                                                    {!! Form::text('emails', null, ['class' => 'form-control', 'id' => 'emails']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">@lang('lang.close')</button>
                                            <button type="submit" name="action" value="send" id="send-btn"
                                                class="btn btn-primary">@lang('lang.send')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </section>
    <!-- This will be printed -->
    <section class="invoice print_section print-only" id="receipt_section"> </section>
@endsection

@section('javascript')
    <script src="{{ asset('js/pos.js') }}"></script>
    <script src="{{ asset('js/product_selection.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script>
        // Add an event listener for the 'show.bs.collapse' and 'hide.bs.collapse' events
        $('#detailsCollapse').on('show.bs.collapse', function() {
            // Change the arrow icon to 'chevron-up' when the content is expanded
            $('button[data-bs-target="#detailsCollapse"] i').removeClass('fa-arrow-down').addClass(
                'fa-arrow-up');
        });

        $('#detailsCollapse').on('hide.bs.collapse', function() {
            // Change the arrow icon to 'chevron-down' when the content is collapsed
            $('button[data-bs-target="#detailsCollapse"] i').removeClass('fa-arrow-up').addClass(
                'fa-arrow-down');
        });
    </script>
    <script>
        $(document).on('click', '#add-selected-btn', function() {
            $('#select_products_modal').modal('hide');
            $.each(product_selected, function(index, value) {
                get_label_product_row(value.product_id, value.variation_id);
            });
            product_selected = [];
            product_table.ajax.reload();
        })
        $(document).on("change", "#method", function(e) {
            let method = $(this).val();


            if (method === "cheque") {
                $(".cheque_field").removeClass("hide");
            } else {
                $(".cheque_field").addClass("hide");
            }
            if (method === "card") {
                $(".card_field").removeClass("hide");
            } else {
                $(".card_field").addClass("hide");
            }
            if (method === "gift_card") {
                $(".gift_card_field").removeClass("hide");
            } else {
                $(".gift_card_field").addClass("hide");
            }
            if (method === "cash") {
                $(".qc").removeClass("hide");
            } else {
                $(".qc").addClass("hide");
            }
        });

        //payment related script

        $('#payment_status').change(function() {
            var payment_status = $(this).val();

            if (payment_status === 'paid' || payment_status === 'partial') {
                $('.not_cash_fields').addClass('hide');
                $('#method').change();
                $('.payment_fields').removeClass('hide');
            } else {
                $('.payment_fields').addClass('hide');
            }
            if (payment_status === 'pending' || payment_status === 'partial') {
                $('.due_fields').removeClass('hide');
            } else {
                $('.due_fields').addClass('hide');
            }
            if (payment_status === 'pending') {
                $('.not_cash_fields').addClass('hide');
                $('.not_cash').attr('required', false);
                $('#method').val();
                $('#amount').val(0);
                $('#method').selectpicker('refresh');
            }
            if (payment_status === 'paid') {
                $('.due_fields').addClass('hide');
            }

            $('#method').change();
        })

        //on click event jquery
        $(document).on('click', '#send-btn', function() {
            if ($('#add_sale_form').valid()) {
                $('#add_sale_form').submit()
            }
        });

        $(document).on('click', '#print-btn', function() {
            var form = $('#add_sale_form');
            if (form.valid()) {
                var data = $(form).serialize();
                data =
                    data + "&action=print"
                var url = $(form).attr("action");
                $.ajax({
                    method: "POST",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function(result) {
                        if (result.success == 1) {
                            pos_print(result.html_content);
                            reset_pos_form();
                        } else {
                            toastr.error(result.msg);
                        }

                    },
                });
            }
        });

        $(document).on('change', '#emails', function() {
            //remove white space from string javascript
            var email_list = $(this).val().replace(/\s/g, '');
            $(this).val(email_list);
        });
    </script>
@endsection
