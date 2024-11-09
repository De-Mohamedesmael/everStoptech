<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title  px-2 position-relative" id="add_terms_and_condition">@lang('lang.add_terms_and_conditions')
                <span class=" header-modal-pill"></span>

            </h5>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>
        {!! Form::open(['url' => action('TermsAndConditionsController@store'), 'method' => 'post']) !!}
        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="form-group col-md-6 px-5">
                <label
                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                    for="name">@lang('lang.name')</label>
                <input type="text"
                    class="form-control modal-input m-auto @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                    name="name" id="name" required>
            </div>
            <div class="col-md-12 px-5">

                <label
                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                    for="name">@lang('lang.description')</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>

            </div>
            <input type="hidden" name="type" value="{{ $type }}">
        </div>
        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">

            <button type="submit" class="btn btn-main col-md-3 py-1">@lang('lang.save')</button>
            <button type="button" class="btn btn-danger col-md-3 py-1" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    tinymce.init({
        selector: "#description",
        height: 130,
        plugins: [
            "advlist autolink lists link charmap print preview anchor textcolor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime table contextmenu paste code wordcount",
        ],
        toolbar: "insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat",
        branding: false,
    });
</script>
