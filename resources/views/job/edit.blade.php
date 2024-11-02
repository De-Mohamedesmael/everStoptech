<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title   px-2 position-relative" id="edit">@lang('lang.edit')
                <span class=" header-modal-pill"></span>

            </h5>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        {!! Form::open(['url' => action('JobController@update', $job->id), 'method' => 'put']) !!}
        <div
            class="modal-body row justify-content-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="col-md-4">
                <label
                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                    for="job_title">@lang('lang.job_title')</label>
                <input type="text"
                    class="form-control  modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                    value="{{ $job->job_title }}" name="job_title" id="job_title" required>
            </div>

        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn btn-main col-md-3 py-1">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger col-md-3 py-1" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
