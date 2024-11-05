<!DOCTYPE html>
<html lang="{{app()->getLocale()  }}">
@php
    $logo = App\Models\System::getProperty('logo');
    $site_title =App\Models\System::getProperty('site_title');
@endphp
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="icon" type="image/png" href="{{ asset('assets/back-end/system/' . $logo) }}" />
    <meta name="author" content="Themesbox17">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ $site_title .' | '}}@yield('title')</title>

    <!-- Fevicon -->
    @include('back-end.layouts.partials.css')
    <link href="{{asset('assets/back-end/css/bootstrap5-3.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('assets/back-end/css/front-style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/back-end/css/animation.css') }}">
    <!-- End css -->
    <style>
        button.btn.table-btns.buttons-collection.dropdown-toggle.buttons-colvis
        ,.btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn.dropdown-toggle-split:first-child, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
            background: #1565c0;
        }
        .dt-buttons.btn-group {
            direction: ltr;
        }
        .dataTables_filter, .dataTables_length, .dt-buttons {
            padding: 0 10px;
        }
        .dt-button-collection.dropdown-menu ,.dropdown-menu.show{
            z-index: 10000;
            background: #ffffff;
        }

    </style>
    <style>
        :root {
            --primary-color: #adbff8;
            /* Light Blue */
            --secondary-color: #2d5cfe;
            /* Bright Blue */
            --tertiary-color: #1565c0;
            /* Dark Blue */
            --complementary-color-1: #576ec5;
            /* Muted Blue-Green */
            --complementary-color-2: #a5d6a7;
            /* Light Muted Blue-Green */
            --text-color: #333;
            /* Dark Gray for Text */
            --white: #fff;
            /* Dark Gray for Text */
            --accent-color: #e57373;
            /* Soft Muted Red */
        }
        div#ui-datepicker-div{
            width: revert;
        }
        .card {
            border-radius: 5px;
            border: none;
            background-color: #ffffff;
            box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
        }
        .btn.btn-main {
            background-color: #1565c0;
            border-color: #1565c0;
            color: #fff;
        }
        div.ui-datepicker {
            z-index: 1000 !important;
        }

        button.btn.table-btns {
            margin-right: .25rem !important;
            margin-left: .25rem !important;
            border-radius: var(--bs-border-radius-lg) !important;
        }
        input#show_zero_stocks {
            appearance: auto !important;
            -webkit-appearance: auto !important;
        }
    </style>
    @yield('styles')
    @stack('style')
</head>

<body class="horizontal-layout relative">

<div class="overlay">
    <div style="width: 55%;overflow: hidden;position: relative;">
        <img style="width: 100%;z-index: 10;position: relative;" src="{{ asset('assets/back-end/images/logo3.png') }}"
             alt="logo">
        <span class="box"></span>
    </div>

</div>


<div id="infobar-notifications-sidebar" class="infobar-notifications-sidebar">
    <div class="infobar-notifications-sidebar-head d-flex w-100 justify-content-between">
        <h4>Notifications</h4><a href="javascript:void(0)" id="infobar-notifications-close"
                                 class="infobar-notifications-close"><img src="{{ asset('assets/back-end/images/svg-icon/close.svg') }}"
                                                                          class="img-fluid menu-hamburger-close" alt="close"></a>
    </div>
    <div class="infobar-notifications-sidebar-body">
        <ul class="nav nav-pills nav-justified" id="infobar-pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-messages-tab" data-toggle="pill" href="#pills-messages"
                   role="tab" aria-controls="pills-messages" aria-selected="true">Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-emails-tab" data-toggle="pill" href="#pills-emails" role="tab"
                   aria-controls="pills-emails" aria-selected="false">Emails</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-actions-tab" data-toggle="pill" href="#pills-actions" role="tab"
                   aria-controls="pills-actions" aria-selected="false">Actions</a>
            </li>
        </ul>
        <div class="tab-content" id="infobar-pills-tabContent">
            <div class="tab-pane fade show active" id="pills-messages" role="tabpanel"
                 aria-labelledby="pills-messages-tab">
                <ul class="list-unstyled">
                    <li class="media">
                        <img class="mr-3 align-self-center rounded-circle"
                             src="{{ asset('assets/back-end/images/users/girl.svg') }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h5>Amy Adams<span class="badge badge-success">1</span><span class="timing">Jan
                                        22</span></h5>
                            <p>Hey!! What are you doing tonight ?</p>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 align-self-center rounded-circle" src="{{ asset('assets/back-end/images/users/boy.svg') }}"
                             alt="Generic placeholder image">
                        <div class="media-body">
                            <h5>James Simpsons<span class="badge badge-success">2</span><span class="timing">Feb
                                        15</span></h5>
                            <p>What's up ???</p>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 align-self-center rounded-circle" src="{{ asset('assets/back-end/images/users/men.svg') }}"
                             alt="Generic placeholder image">
                        <div class="media-body">
                            <h5>Mark Witherspoon<span class="badge badge-success">3</span><span class="timing">Mar
                                        03</span></h5>
                            <p>I will be late today in office.</p>
                        </div>
                    </li>
                    <li class="media">
                        <img class="mr-3 align-self-center rounded-circle"
                             src="{{ asset('assets/back-end/images/users/women.svg') }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h5>Jenniffer Wills<span class="badge badge-success">4</span><span class="timing">Apr
                                        05</span></h5>
                            <p>Venture presentation is ready.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="pills-emails" role="tabpanel" aria-labelledby="pills-emails-tab">
                <ul class="list-unstyled">
                    <li class="media">
                        <span class="mr-3 align-self-center img-icon">N</span>
                        <div class="media-body">
                            <h5>Nelson Smith<span class="timing">Jan 22</span></h5>
                            <p><span class="badge badge-danger-inverse">WORK</span>Salary has been processed.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <span class="mr-3 align-self-center img-icon">C</span>
                        <div class="media-body">
                            <h5>Courtney Cox<i class="feather icon-star text-warning ml-2"></i><span
                                    class="timing">Feb 15</span></h5>
                            <p><span class="badge badge-success-inverse">URGENT</span>New product launching...
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <span class="mr-3 align-self-center img-icon">R</span>
                        <div class="media-body">
                            <h5>Rachel White<span class="timing">Mar 03</span></h5>
                            <p><span class="badge badge-secondary-inverse">ORDER</span><span
                                    class="badge badge-info-inverse">SHOPPING</span>Your order has been...</p>
                        </div>
                    </li>
                    <li class="media">
                        <span class="mr-3 align-self-center img-icon">F</span>
                        <div class="media-body">
                            <h5>Freepik<span class="timing">Mar 03</span></h5>
                            <p><a href="#" class="badge badge-primary mr-2">VERIFY NOW</a>New Sign
                                verification req...</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="pills-actions" role="tabpanel" aria-labelledby="pills-actions-tab">
                <ul class="list-unstyled">
                    <li class="media">
                            <span class="mr-3 action-icon badge badge-success-inverse"><i
                                    class="feather icon-check"></i></span>
                        <div class="media-body">
                            <h5 class="action-title">Payment Success !!!</h5>
                            <p class="my-3">We have received your payment toward ad Account : 9876543210.
                                Your Ad
                                is Running.</p>
                            <p><span class="badge badge-danger-inverse">INFO</span><span
                                    class="badge badge-info-inverse">STATUS</span><span class="timing">Today,
                                        09:39 PM</span></p>
                        </div>
                    </li>
                    <li class="media">
                            <span class="mr-3 action-icon badge badge-primary-inverse"><i
                                    class="feather icon-calendar"></i></span>
                        <div class="media-body">
                            <h5 class="action-title">Nobita Applied for Leave.</h5>
                            <p class="my-3">Nobita applied for leave due to personal reasons on 22nd Feb.</p>
                            <p><span class="badge badge-success">APPROVE</span><span
                                    class="badge badge-danger">REJECT</span><span class="timing">Yesterday,
                                        05:25
                                        PM</span></p>
                        </div>
                    </li>
                    <li class="media">
                            <span class="mr-3 action-icon badge badge-danger-inverse"><i
                                    class="feather icon-alert-triangle"></i></span>
                        <div class="media-body">
                            <h5 class="action-title">Alert</h5>
                            <p class="my-3">There has been new Log in fron your account at Melbourne. Mark it
                                safe or report.</p>
                            <p><i class="feather icon-check text-success mr-3"></i><a href="#"
                                                                                      class="text-muted">Report Now</a><span class="timing">5 Jan 2019, 02:13
                                        PM</span></p>
                        </div>
                    </li>
                    <li class="media">
                            <span class="mr-3 action-icon badge badge-warning-inverse"><i
                                    class="feather icon-award"></i></span>
                        <div class="media-body">
                            <h5 class="action-title">Congratulations !!!</h5>
                            <p class="my-3">Your role in the organization has been changed from Editor to
                                Chief
                                Strategist.</p>
                            <p><span class="badge badge-danger-inverse">ACTIVITY</span><span class="timing">10
                                        Jan
                                        2019, 08:49 PM</span></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Start Containerbar -->
<div id="containerbar" class=" bg-white">

    @include('back-end.layouts.partials.header')
    <div id="closing_cash_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         class="modal">
    </div>


    @include('back-end.layouts.partials.leftbar')

    <!-- Start Rightbar -->
    <div class="rightbar">

        @yield('breadcrumbbar')

        <div class="animate-in-page">
            <div class="breadcrumbbar m-0 px-3 py-0">
                <div
                    class="d-flex align-items-center justify-content-between @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                    <div>
                        <h4 class="page-title @if (app()->isLocale('ar')) text-end @else text-start @endif">
                            @yield('page_title')
                        </h4>
                        <div class="breadcrumb-list">
                            <ul
                                class="breadcrumb m-0 p-0  d-flex @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
                                @section('breadcrumbs')
                                    <li
                                        class="breadcrumb-item @if (app()->isLocale('ar')) mr-2 @else ml-2 @endif ">
                                        <a style="text-decoration: none;color: #1565c0" href="{{ url('/') }}">/
                                            @lang('lang.dashboard')</a>
                                    </li>
                                @show
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @yield('button')
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
        <div class="modal modal-jobs-edit animate__animated" data-animate-in="animate__rollIn" data-animate-out="animate__rollOut"
             id="editModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel" style="display: none;"
             aria-hidden="true">
                <div class="view_modal no-print">


                </div>
        </div>
    </div>
    <!-- End Rightbar -->

    @include('back-end.layouts.partials.footer')
    @livewireScripts
    <button id="toTopBtn" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>

</div>
<script>
    $(document).ready(function() {
        var modelEl = $('.modal-jobs-edit');

        modelEl.addClass(modelEl.attr('data-animate-in'));

        modelEl.on('hide.bs.modal', function(event) {
            console.log('ddd');
            if (!$(this).attr('is-from-animation-end')) {
                event.preventDefault();
                $(this).addClass($(this).attr('data-animate-out'))
                $(this).removeClass($(this).attr('data-animate-in'))
            }
            $(this).removeAttr('is-from-animation-end')
        })
            .on('animationend', function() {
                if ($(this).hasClass($(this).attr('data-animate-out'))) {
                    $(this).attr('is-from-animation-end', true);
                    $(this).modal('hide')
                    $(this).removeClass($(this).attr('data-animate-out'))
                    $(this).addClass($(this).attr('data-animate-in'))
                }
            })
    })
</script>
<!-- End Containerbar -->
    @if (app()->isLocale('ar'))
        <script>
            const element = document.querySelector('.item-list-a');

            if (element) {
                element.classList.add('flex-row-reverse');
            } else {
                console.error('Element with class "item-list-a" not found.');
            }
        </script>
    @else
        <script>
            const element = document.querySelector('.item-list-a');

            if (element) {
                element.classList.add('flex-row');
            } else {
                console.error('Element with class "item-list-a" not found.');
            }
        </script>
    @endif

<input type="hidden" id="__language" value="{{ session('language') }}">
<input type="hidden" id="__decimal" value=".">
<input type="hidden" id="__currency_precision"
       value="{{ !empty(App\Models\System::getProperty('numbers_length_after_dot')) ? App\Models\System::getProperty('numbers_length_after_dot') : 5 }}">
<input type="hidden" id="__currency_symbol" value="$">
<input type="hidden" id="__currency_thousand_separator" value=",">
<input type="hidden" id="__currency_symbol_placement" value="before">
<input type="hidden" id="__precision"
       value="{{ !empty(App\Models\System::getProperty('numbers_length_after_dot')) ? App\Models\System::getProperty('numbers_length_after_dot') : 5 }}">
<input type="hidden" id="__quantity_precision"
       value="{{ !empty(App\Models\System::getProperty('numbers_length_after_dot')) ? App\Models\System::getProperty('numbers_length_after_dot') : 5 }}">
<script type="text/javascript">
    base_path = "{{ url('/') }}";
    current_url = "{{ url()->current() }}";
</script>




<!-- Start js -->
@include('back-end.layouts.partials.javascript')

@yield('javascript')


<script>
    function __read_number(inputElement) {
        return parseFloat(inputElement.val()) || 0;
    }
    // Define the __write_number function to write a number to an input field
    function __write_number(outputElement, value) {
        outputElement.val(value);
    }
    $(document).ready(function() {
        if ($('.toggle_dollar').val() == "1") {
            $('#toggleDollar').click();
        }
    });
    $(document).ready(function() {
        // Event handler for key press
        $(document).on('keydown', function(event) {
            // Check if Ctrl+G is pressed
            if (event.ctrlKey && event.key === $('.keyboord_letter_to_toggle_dollar').val()) {
                // Prevent the default Ctrl+G behavior (e.g., find)
                event.preventDefault();
                $.ajax({
                    url: '/toggle-dollar',
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Success", response.msg, "success");
                            $('#toggleDollar').click();
                            location.reload(true);
                        }
                    }
                });
            }
        });
    });

    window.addEventListener('swal:modal', event => {
        Swal.fire({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            showConfirmButton: false,
            timer: 2000,
        });

    });

    window.addEventListener('swal:confirm', event => {
        Swal.fire({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.livewire.emit('remove');
                }
            });
    });

    $(document).on("change", "#branch_id", function() {
        $.ajax({
            type: "get",
            url: "/get_branch_stores/" + $(this).val().join(','),
            dataType: "html",
            success: function(response) {
                console.log(response)
                $("#store_id").empty().append(response).change();
            }
        });
    });

    $(document).on('click', "#power_off_btn", function(e) {
        let cash_register_id = $('#cash_register_id').val();
        let is_register_close = parseInt($('#is_register_close').val());
        if (!is_register_close) {
            getClosingModal(cash_register_id);
            return 'Please enter the closing cash';
        } else {
            return;
        }
    });

    function getClosingModal(cash_register_id, type = 'close') {
        $.ajax({
            method: 'get',
            url: '/cash/add-closing-cash/' + cash_register_id,
            data: {
                type
            },
            contentType: 'html',
            success: function(result) {
                $('#closing_cash_modal').empty().append(result);
                $('#closing_cash_modal').modal('show');
            },
        });
    }

    window.addEventListener('load', function() {
        var loaderWrapper = document.querySelector('.loading');
        if(loaderWrapper){
            loaderWrapper.style.display = 'none'; // Hide the loader once the page is fully loaded
        }
    });

    // window.addEventListener("beforeunload", (event) => {
    //     document.body.classList.add('animated-element');
    // });
    let toggleButton = document.getElementById('toggle-responsive-nav')
    let navbarMenu = document.getElementById('navbar-menu')
</script>
<script>
    // Wait for the DOM content to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Set overflow to hidden initially
        document.body.style.overflowY = "hidden";
        document.body.style.height = "1000vh";

        // Remove overflow hidden after 1.5 seconds
        setTimeout(function() {
            document.body.style.overflowY = "auto"; // Or "visible" depending on your requirements
            document.body.style.height = "fit-content"; // Or "visible" depending on your requirements
        }, 500);
    });
</script>
@stack('js')
@push('javascripts')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('printInvoice', function(htmlContent) {
                // Set the generated HTML content
                $("#receipt_section").html(htmlContent);
                // Trigger the print action
                window.print("#receipt_section");
            });
        });
        $(document).on("click", ".print-invoice", function() {
            // $(".modal").modal("hide");
            $.ajax({
                method: "get",
                url: $(this).data("href"),
                data: {},
                success: function(result) {
                    if (result.success) {
                        Livewire.emit('printInvoice', result.html_content);
                    }
                },
            });
        });
    </script>
@endpush
</body>
</html>
