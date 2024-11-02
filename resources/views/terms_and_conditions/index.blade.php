@extends('layouts.app')
@section('title', __('lang.terms_and_conditions'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="col-md-12 px-1 no-print">
                <div
                    class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                    @if ($_SERVER['QUERY_STRING'] == 'type=quotation')
                        <h5 class="mb-0 position-relative  print-title">@lang('lang.quotation_terms_and_condition')
                            <span class="header-pill"></span>

                        </h5>
                    @else
                        <h5 class="mb-0 position-relative  print-title">@lang('lang.invoice_terms_and_condition')
                            <span class="header-pill"></span>

                        </h5>
                    @endif
                </div>
                @can('settings.terms_and_conditions.create_and_edit')
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-center p-2">
                            <button type="button" class="btn btn-primary btn-modal ml-3"
                                data-href="{{ action('TermsAndConditionsController@create') }}?type={{ $type }}"
                                data-container=".view_modal">
                                <i class="fa fa-plus"></i> @lang('lang.add_terms_and_conditions')</button>
                        </div>
                    </div>
                @endcan
                <div class="card my-3">
                    <div class="card-body p-2">
                        {!! Form::open(['url' => action('TermsAndConditionsController@updateInvoiceTacSetting'), 'method' => 'POST']) !!}
                        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                            <div class="col-md-3 px-5">
                                <div class="form-group">
                                    {!! Form::label('invoice_terms_and_conditions', __('lang.tac_to_be_printed'), [
                                        'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                                    ]) !!}
                                    {!! Form::select(
                                        'invoice_terms_and_conditions',
                                        $tac,
                                        !empty($invoice_terms_and_conditions) ? $invoice_terms_and_conditions : null,
                                        ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => __('lang.please_select')],
                                    ) !!}
                                </div>
                            </div>

                            <div class="col-md-3 px-5 d-flex justify-content-center align-items-center">
                                <button class="btn btn-main col-md-12" type="submit">@lang('lang.save')</button>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body p-2">

                        <table class="table dataTable">
                            <thead>
                                <tr>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.description')</th>
                                    <th>@lang('lang.show')</th>
                                    <th>@lang('lang.name_of_creator')</th>
                                    <th class="notexport">@lang('lang.action')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($terms_and_conditions as $terms_and_condition)
                                    <tr>
                                        <td>
                                            {{ $terms_and_condition->name }}
                                        </td>
                                        <td>
                                            {!! $terms_and_condition->description !!}
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input make-default" type="checkbox"
                                                    data-id="{{ $terms_and_condition->id }}"
                                                    value="{{ $terms_and_condition->default }}"
                                                    {{ $terms_and_condition->default == '1' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $terms_and_condition->created_by }}
                                        </td>
                                        <td>


                                            @can('settings.terms_and_conditions.view')
                                                <a data-href="{{ action('TermsAndConditionsController@show', $terms_and_condition->id) }}"
                                                    data-container=".view_modal"
                                                    class="btn btn-danger btn-modal text-white show_terms_and_condition"><i
                                                        class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('settings.terms_and_conditions.create_and_edit')
                                                <a data-href="{{ action('TermsAndConditionsController@edit', $terms_and_condition->id) }}"
                                                    data-container=".view_modal"
                                                    class="btn btn-danger btn-modal text-white edit_terms_and_condition"><i
                                                        class="fa fa-pencil-square-o"></i></a>
                                            @endcan
                                            @can('settings.terms_and_conditions.delete')
                                                <a data-href="{{ action('TermsAndConditionsController@destroy', $terms_and_condition->id) }}"
                                                    data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                    class="btn btn-danger text-white delete_item"><i
                                                        class="fa fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script>
        $('.view_modal').on('hidden.bs.modal', function() {
            tinymce.remove();
        });
        $(document).on('change', '.make-default', function() {
            var isChecked = $(this).prop('checked');
            console.log(isChecked);
            $.ajax({
                type: "get",
                url: "/make-default/" + $(this).data('id'),
                data: {
                    isChecked: isChecked
                },
                success: function(response) {
                    // swal('Success', response.msg, 'success')
                }
            });
        })
    </script>
@endsection
