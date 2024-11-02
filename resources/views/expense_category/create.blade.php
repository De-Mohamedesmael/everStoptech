@extends('layouts.app')
@section('title', __('lang.add_expense_category'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/main.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div
                class="  d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                <h5 class="mb-0 position-relative print-title" style="margin-right: 30px">@lang('lang.add_expense_category')
                    <span class="header-pill"></span>
                </h5>
            </div>

            {!! Form::open(['url' => action('ExpenseCategoryController@store'), 'method' => 'post']) !!}

            <div class="card my-3">
                <div class="card-body p-2">
                    <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                        <div class="col-md-3 px-5">
                            <div class="form-group">
                                <label
                                    class="form-label d-block mb-1  @if (app()->isLocale('ar')) text-end @else text-start @endif"
                                    for="name">@lang('lang.name')</label>
                                <input type="text"
                                    class="form-control modal-input @if (app()->isLocale('ar')) text-end @else  text-start @endif"
                                    name="name" id="name">
                            </div>
                        </div>
                    </div>
                    <div class="row my-2 justify-content-center align-items-center">
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-main submit-btn" value="@lang('lang.save')" name="submit">
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
