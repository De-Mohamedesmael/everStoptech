@extends('layouts.app')

@section('title', __('lang.expense_beneficiary'))
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/pos-modals.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('front/css/stock.css') }}">
@endsection
@section('content')
    <section class="forms py-0">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-1">

                    <div
                        class="d-flex align-items-center my-2 @if (app()->isLocale('ar')) justify-content-end @else justify-content-start @endif">
                        <h5 class="mb-0 position-relative" style="margin-right: 30px">
                            @lang('lang.add_expense_beneficiary')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row justify-content-center">
                                <a class="btn btn-primary col-md-3"
                                    href="{{ action('ExpenseBeneficiaryController@create') }}">
                                    <i class="fa fa-plus"></i> @lang('lang.add_expense_beneficiary')</a>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body py-2">
                            <div class="table-responsive">

                                <table class="table dataTable">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.sr_no')</th>
                                            <th>@lang('lang.name')</th>
                                            <th>@lang('lang.expense_category')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($expense_beneficiaries as $expense_beneficiary)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    {{ $expense_beneficiary->name }}
                                                </td>
                                                <td>
                                                    {{ $expense_beneficiary->expense_category->name ?? '' }}
                                                </td>
                                                <td>
                                                    @can('expense.expense_beneficiaries.create_and_edit')
                                                        <a data-href="{{ action('ExpenseBeneficiaryController@edit', $expense_beneficiary->id) }}"
                                                            data-container=".view_modal"
                                                            class="btn btn-main btn-modal text-white p-1  edit_job"><i
                                                                class="fa  fa-pencil-square-o"></i></a>
                                                    @endcan
                                                    @can('expense.expense_beneficiaries.delete')
                                                        <a data-href="{{ action('ExpenseBeneficiaryController@destroy', $expense_beneficiary->id) }}"
                                                            data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                            class="btn btn-danger text-white p-1  delete_item"><i
                                                                class="fa  fa-trash"></i></a>
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
            </div>
        </div>

    </section>
@endsection

@section('javascript')
    <script></script>
@endsection
