<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title px-2 position-relative d-flex align-items-center" style="gap: 5px;" id="edit">
                @lang('lang.edit')
                <span class="header-pill"></span>
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        {!! Form::open([
            'url' => action('ExpenseBeneficiaryController@update', $expense_beneficiary->id),
            'method' => 'put',
        ]) !!}
        <div class="modal-body">
            <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                <div class="col-md-4">
                    <div class="form-group">
                        <label
                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                            for="expense_category_id">@lang('lang.expense_category')</label>
                        {!! Form::select('expense_category_id', $expense_categories, $expense_beneficiary->expense_category_id, [
                            'class' => 'form-control modal-input h-100',
                            'required',
                            'placeholder' => __('lang.please_select'),
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label
                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                            for="name">@lang('lang.beneficiary_name')</label>
                        <input type="text"
                            class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                            value="{{ $expense_beneficiary->name }}" name="name" id="name" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button type="submit" class="btn btn-main">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
