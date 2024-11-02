<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">

        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title  px-2 position-relative" id="add_leave_type">@lang('lang.add_leave_type')
                <span class=" header-modal-pill"></span>
            </h5>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        {!! Form::open([
            'url' => action('LeaveTypeController@store'),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="form-group col-md-6 px-5">
                <div class="form-group">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="name">@lang('lang.type_name')</label>
                    <input type="text"
                        class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                        name="name" id="name" required>
                </div>
            </div>
            <div class="form-group col-md-6 px-5">
                <div class="form-group">
                    <label
                        class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                        for="number_of_days_per_year">@lang('lang.number_of_days_per_year')</label>
                    <input type="text"
                        class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                        name="number_of_days_per_year" id="number_of_days_per_year">
                </div>
            </div>

        </div>
        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn btn-main col-md-3 py-1">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger col-md-3 py-1" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
