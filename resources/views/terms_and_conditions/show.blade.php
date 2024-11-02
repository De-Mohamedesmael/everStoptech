<!-- Modal -->
<div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div
            class="modal-header  position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            <h5 class="modal-title  px-2 position-relative" id="add_terms_and_condition">@lang('lang.terms_and_conditions')
                <span class=" header-modal-pill"></span>
            </h5>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="form-group col-md-6 px-5">

                <label
                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                    for="name">@lang('lang.name')</label>
                <b>{{ $terms_and_conditions->name }}</b>


            </div>
            <div class="col-md-12 px-5">

                <label
                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                    for="description">@lang('lang.description')</label>
                <b>{!! $terms_and_conditions->description !!}</b>


            </div>
            <div class="col-md-12 px-5">
                <label for="name">@lang('lang.customer_that_receive_that_tac')</label>
                <table class="table">
                    @foreach ($transactions as $item)
                        <tr>
                            <td> {{ $item->customer->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>

        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">


            <button type="button" class="btn btn-danger col-md-3 py-1" data-dismiss="modal">Close</button>
        </div>

    </div>
</div>
