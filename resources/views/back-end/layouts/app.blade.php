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
    @stack('styles')
    <link rel="stylesheet" href="{{ url('assets/back-end/css/front-style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/back-end/css/animation.css') }}">
    <!-- End css -->
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
                                        <a style="text-decoration: none;color: #596fd7" href="{{ url('/') }}">/
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
    </div>
    <!-- End Rightbar -->

    @include('back-end.layouts.partials.footer')
    <button id="toTopBtn" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>

</div>
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
</body>
</html>
