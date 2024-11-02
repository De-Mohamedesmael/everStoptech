@extends('layouts.app')
@section('title', __('lang.expense_category'))

@section('style')
    <style>
        .index_close {
            width: 15px;
            height: 15px;
            background: #bb3434;
            float: right;
            opacity: 1;

            color: #fff !important;
            font-size: 11px;
            font-weight: 300;
            font-family: monospace;
            padding: 1px 4px;
            border-radius: 9px;
            margin-top: 5px;
            cursor: pointer;
        }

        .index_close:hover {
            width: 15px;
            height: 15px;
            background: #bb3434;
            float: right;
            opacity: 0.7;

            color: #fff !important;
            font-size: 11px;
            font-weight: 300;
            font-family: monospace;
            padding: 1px 4px;
            border-radius: 9px;
            margin-top: 5px;
            cursor: pointer;
        }
    </style>
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
                            @lang('lang.expense_categories')
                            <span class="header-pill"></span>
                        </h5>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row justify-content-center">
                                <a class="btn btn-primary col-md-3" href="{{ action('ExpenseCategoryController@create') }}">
                                    <i class="fa fa-plus"></i> @lang('lang.add_expense_category')</a>
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
                                            <th>@lang('lang.beneficiaries')</th>
                                            <th class="sum">@lang('lang.money_paid')</th>
                                            <th class="notexport">@lang('lang.action')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($expense_categories as $expense_category)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    {{ $expense_category->name }}
                                                </td>
                                                <td>
                                                    @foreach ($expense_category->beneficiaries as $item)
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <li style="color: rgb(74, 74, 253)">{{ $item->name }}
                                                                </li>
                                                            </div>
                                                            <div class="col-md-6">
                                                                @can('expense.expense_beneficiaries.delete')
                                                                    <a data-href="{{ action('ExpenseBeneficiaryController@destroy', $item->id) }}"
                                                                        data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                                        class="delete_item index_close"
                                                                        class=" index_close">x</a>
                                                                @endcan
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>{{ @num_format($expense_category->expenses->sum('final_total')) }}
                                                </td>
                                                <td>
                                                    @can('expense.expense_categories.create_and_edit')
                                                        <a data-href="{{ action('ExpenseCategoryController@edit', $expense_category->id) }}"
                                                            data-container=".view_modal"
                                                            class="btn btn-main p-1 btn-modal text-white edit_job"><i
                                                                class="fa fa-pencil-square-o"></i></a>
                                                    @endcan
                                                    @can('expense.expense_categories.delete')
                                                        <a data-href="{{ action('ExpenseCategoryController@destroy', $expense_category->id) }}"
                                                            data-check_password="{{ action('AdminController@checkPassword', Auth::user()->id) }}"
                                                            class="btn btn-danger p-1 text-white delete_item"><i
                                                                class="fa fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right"><strong>@lang('lang.total')</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
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
