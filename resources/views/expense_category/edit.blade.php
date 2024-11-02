<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title  px-2 position-relative d-flex align-items-center" style="gap: 5px;" id="edit">
                @lang('lang.edit')
                <span class="header-pill"></span>
            </h5>
            <button type="button" data-dismiss="modal" aria-label="Close"
                class="close  btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"><span
                    aria-hidden="true"><i class="dripicons-cross"></i></span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        {!! Form::open(['url' => action('ExpenseCategoryController@update', $expense_category->id), 'method' => 'put']) !!}
        <div class="modal-body">
            <div class="row  @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                <div class="col-md-4">
                    <div class="form-group">
                        <label
                            class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                            for="name">@lang('lang.name')</label>
                        <input type="text"
                            class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                            value="{{ $expense_category->name }}" name="name" id="name">
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
