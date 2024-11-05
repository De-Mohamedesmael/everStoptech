@extends('back-end.layouts.app')
@section('title', __('lang.products_'))

@push('css')
    <style>
        th {
            padding: 10px 25px !important;
            font-weight: 700 !important;
            font-size: 11px !important;
            width: fit-content !important;
            text-align: center;
            border: 1px solid white !important;
            color: #fff !important;
            background-color: #596fd7 !important;
            text-transform: uppercase;
        }

        .table-top-head {
            top: 165px !important;
        }

        .table-scroll-wrapper {
            width: fit-content !important;
        }

        @media (min-width: 2000px) {
            .table-scroll-wrapper {
                width: 100% !important;
            }
        }

        @media (max-width: 991px) {
            .table-top-head {
                top: 165px !important
            }
        }

        @media (max-width: 768px) {
            .table-top-head {
                top: 430px !important
            }
        }

        @media (max-width: 575px) {
            .table-top-head {
                top: 430px !important
            }
        }

        .wrapper1 {
            margin-top: 30px;
        }

        @media (max-width: 767px) {
            .wrapper1 {
                margin-top: 115px;
            }
        }
    </style>
@endpush

@section('page_title')
    @lang('lang.products_')
@endsection

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item @if (app()->isLocale('ar')) mr-2 @else ml-2 @endif active" aria-current="page">
        @lang('lang.products_')</li>
@endsection

@section('button')
    <div class="widgetbar  d-flex @if (app()->isLocale('ar')) justify-content-start @else justify-content-end @endif">
        <a href="{{ action('ProductController@create') }}" class="btn btn-primary">
            @lang('lang.add_products')
        </a>
    </div>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="animate-in-page">

        <div class="contentbar pb-0 mb-0">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-lg-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h6 class="card-title @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                @lang('lang.products_')</h6>
                        </div>
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid">
                                        @include('back-end.products.filters')
                                    </div>
                                </div>
                            </div>

                            {{-- ++++++++++++++++++ Table Columns ++++++++++++++++++ --}}
                            {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6> --}}
                            <div class="wrapper1 @if (app()->isLocale('ar')) dir-rtl @endif">
                                <div class="div1"></div>
                            </div>
                            <div class="wrapper2 @if (app()->isLocale('ar')) dir-rtl @endif">
                                <div class="div2 table-scroll-wrapper">
                                    <!-- content goes here -->
                                    <div style="min-width: 1800px;max-height: 90vh;overflow: auto;">
                                        <div id="status"></div>
                                        <table
                                            class="table ">
                                            <thead>
                                            <tr
                                                style="position: sticky;
                                                        top: 0;
                                                        z-index: 1000;">
                                                <th>#</th>
                                                <th class="col1">@lang('lang.image')</th>
                                                <th class="col2">@lang('lang.product_name')</th>
                                                <th class="col3">@lang('lang.sku')</th>
                                                <th class="col4">@lang('lang.select_to_delete')</th>
                                                <th class="col5">@lang('lang.stock')</th>
                                                <th class="col6">@lang('lang.category') 1</th>
                                                <th class="col7">@lang('lang.category') 2</th>
                                                <th class="col19">@lang('lang.category') 3</th>
                                                <th class="col20">@lang('lang.category') 4</th>
                                                <th class="col8">@lang('lang.height')</th>
                                                <th class="col9">@lang('lang.length')</th>
                                                <th class="col10">@lang('lang.width')</th>
                                                <th class="col11">@lang('lang.size')</th>
                                                {{-- <th class="col1">@lang('lang.unit')</th> --}}
                                                <th class="col12">@lang('lang.weight')</th>
                                                <th class="col13">{{ __('lang.basic_unit_for_import_product') }}</th>
                                                <th class="col14">@lang('lang.stores')</th>
                                                <th class="col15">@lang('lang.brand')</th>
                                                {{--                                    <th class="col1">@lang('lang.discount')</th> --}}
                                                <th class="col16">@lang('added_by')</th>
                                                <th class="col17">@lang('updated_by')</th>
                                                <th class="col18">@lang('lang.action')</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>

                                            <td colspan="5" style="text-align: right">@lang('lang.total')</td>
                                            <td id="sum"></td>
                                            <td colspan="12">
                                            </td>
                                            </tfoot>
                                        </table>

                                        <div class="view_modal no-print">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
        </div>
    </div>
    <!-- End row -->

    <div class="view_modal no-print">@endsection
        @push('javascripts')
            <script src="{{ asset('js/products/products.js') }}"></script>
            <script>
                $(document).ready(function () {
                    $('#example').DataTable({
                        dom: "<'row'<'col-md-3 'l><'col-md-5 text-center 'B><'col-md-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-4'i><'col-sm-4'p>>",
                        lengthMenu: [10, 25, 50, 75, 100, 200, 300, 400],
                        pageLength: 10,
                        buttons: ['copy', 'csv', 'excel', 'pdf',
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ":visible:not(.notexport)"
                                }
                            }
                            // ,'colvis'
                        ],
                        "fnDrawCallback": function (row, data, start, end, display) {
                            var api = this.api(),
                                data;
                            // Remove the formatting to get integer data for summation
                            var intVal = function (i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                            // Total over all pages
                            total = api
                                .column(5)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);
                            // Update status DIV
                            $('#sum').html('<span>' + total + '<span/>');
                        }
                    });
                });
            </script>
            <script>
                $(document).on('click', '.product_unit', function () {
                    var $this = $(this);
                    var variation_id = $(this).data('variation_id');
                    var product_id = $(this).data('product_id');
                    $.ajax({
                        type: "get",
                        url: "/product/get-unit-store",
                        data: {
                            variation_id: variation_id,
                            product_id: product_id
                        },
                        success: function (response) {
                            $this.closest('td').find('.product_unit').each(function () {
                                $(this).find('.unit_value').text(
                                    0); // Change "New Value" to the desired value
                            });
                            $this.children('.unit_value').text(response.store);
                        }
                    });
                });
                $(document).on('click', '#delete_all', function () {
                    var checkboxes = document.querySelectorAll('input[name="product_selected_delete"]');
                    var selected_delete_ids = [];
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            selected_delete_ids.push(checkboxes[i].value);
                        }
                    }
                    console.log(selected_delete_ids)
                    if (selected_delete_ids.length == 0) {
                        alert(1)
                        swal.fire({
                            title: 'Warning',
                            text: LANG.sorry_you_should_select_products_to_continue_delete,
                            icon: 'warning',
                        })
                    } else {
                        swal.fire({
                            title: 'Are you sure?',
                            text: LANG.all_transactions_related_to_this_products_will_be_deleted,
                            icon: 'warning',
                        }).then(willDelete => {
                            if (willDelete) {
                                var check_password = $(this).data('check_password');
                                var href = $(this).data('href');
                                var data = $(this).serialize();
                                swal.fire({
                                    title: "{!! __('lang.please_enter_your_password') !!}",
                                    input: 'password',
                                    inputAttributes: {
                                        placeholder: "{!! __('lang.type_your_password') !!}",
                                        autocomplete: 'off',
                                        autofocus: true,
                                    },
                                }).then((result) => {
                                    if (result) {
                                        $.ajax({
                                            url: check_password,
                                            method: 'POST',
                                            data: {
                                                value: result
                                            },
                                            dataType: 'json',
                                            success: (data) => {
                                                if (data.success == true) {
                                                    // swal.fire(
                                                    //     'Success',
                                                    //     'Correct Password!',
                                                    //     'success'
                                                    // );
                                                    Swal.fire({
                                                        title: "Success",
                                                        text: "Correct Password!",
                                                        icon: "success",
                                                        timer: 1000, // Set the timer to 1000 milliseconds (1 second)
                                                        showConfirmButton: false // This will hide the "OK" button
                                                    });

                                                    $.ajax({
                                                        method: 'POST',
                                                        url: "/product/multiDeleteRow",
                                                        dataType: 'json',
                                                        data: {
                                                            "ids": selected_delete_ids
                                                        },
                                                        success: function (result) {
                                                            if (result.success ==
                                                                true) {
                                                                // swal.fire(
                                                                //     'Success',
                                                                //     result.msg,
                                                                //     'success'
                                                                // );

                                                                Swal.fire({
                                                                    title: "Success",
                                                                    text: result
                                                                        .msg,
                                                                    icon: "success",
                                                                    timer: 1000, // Set the timer to 1000 milliseconds (1 second)
                                                                    showConfirmButton: false // This will hide the "OK" button
                                                                });

                                                                setTimeout(() => {
                                                                    location
                                                                        .reload();
                                                                }, 1500);
                                                                location.reload();
                                                            } else {
                                                                // swal.fire(
                                                                //     'Error',
                                                                //     result.msg,
                                                                //     'error'
                                                                // );
                                                                Swal.fire({
                                                                    title: "Error",
                                                                    text: response
                                                                        .msg,
                                                                    icon: "error",
                                                                    timer: 1000, // Set the timer to 1000 milliseconds (1 second)
                                                                    showConfirmButton: false // This will hide the "OK" button
                                                                });

                                                            }
                                                        },
                                                    });
                                                } else {
                                                    // swal.fire(
                                                    //     'Failed!',
                                                    //     'Wrong Password!',
                                                    //     'error'
                                                    // )
                                                    Swal.fire({
                                                        title: "Failed!",
                                                        text: "Wrong Password!",
                                                        icon: "error",
                                                        timer: 1000, // Set the timer to 1000 milliseconds (1 second)
                                                        showConfirmButton: false // This will hide the "OK" button
                                                    });

                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            </script>

    @endpush
