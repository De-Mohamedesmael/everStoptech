<nav class="navbar no-print navbar-expand-lg bg-white mb-1 py-0"
    style="z-index: 5;background-color: #1565c005 !important">
    <div class="container-fluid">
        <a style="width: 150px;" class="ml-2 d-lg-none" href="index.html">
            <img style="width: 100%" src="{{ asset('assets/back-end/images/logo1.png') }}" class="img-fluid" alt="logo">
        </a>

        <button class="navbar-toggler menu-hamburger" id="menu-button">
            <img src="{{ asset('assets/back-end/images/svg-icon/collapse.svg') }}" class="img-fluid menu-hamburger-collapse"
                alt="collapse">
        </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul style="width: 100%"
                    class="horizontal-menu navbar-nav d-flex flex-wrap justify-content-start mt-md-0 @if (app()->isLocale('ar')) flex-column flex-md-row-reverse @else flex-row @endif">
                    {{-- ###################### Dashboard : نظرة عامة ###################### --}}
                    {{-- @can('dashboard') --}}
{{--                    @if (!empty($module_settings['dashboard']))--}}
                    <li class="scroll mx-2 mb-0 p-0" style="height: 40px;">
                        <a target="_blank"
                            class="item-list-a home-button click-item-route d-flex  align-items-center"
                            href="{{ url('/') }}"
                           data-url="{{route('home')}}"
                           style="cursor: pointer;text-decoration: none;height: 100%;">
                            <div style="width: 25px" class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 100%" viewBox="0 0 64 64">
                                    <defs>
                                        <style>
                                            .cls-2 {
                                                fill: #7c828d
                                            }

                                            .cls-3 {
                                                fill: #b2b9bf
                                            }

                                            .cls-4 {
                                                fill: #b5e0f0
                                            }

                                            .cls-5 {
                                                fill: #00b39b
                                            }

                                            .cls-6 {
                                                fill: #b8453d
                                            }

                                            .cls-8 {
                                                fill: #545465
                                            }

                                            .cls-10 {
                                                fill: #29394a
                                            }
                                        </style>
                                    </defs>
                                    <g id="_02-control_panal" data-name="02-control panal">
                                        <path d="M63 57v4a2.006 2.006 0 0 1-2 2H3a2.006 2.006 0 0 1-2-2v-4h62z"
                                            style="fill:#6e6e79" />
                                        <path class="cls-2"
                                            d="M13 23v34H1V25a2.006 2.006 0 0 1 2-2zM63 25v32H51V23h10a2.006 2.006 0 0 1 2 2z" />
                                        <path class="cls-3"
                                            d="M51 23v34H13V23h38zm-3 8a4 4 0 0 0-8 0c0 2.21 1.79 2 4 2s4 .21 4-2zm-2 10v-4h-4v4zm-8 0v-4h-4v4zm-2-10a4 4 0 0 0-8 0c0 2.21 1.79 2 4 2s4 .21 4-2zm-6 10v-4h-4v4zm-6-10a4 4 0 0 0-8 0c0 2.21 1.79 2 4 2s4 .21 4-2zm-2 10v-4h-4v4z" />
                                        <path class="cls-4"
                                            d="M44 33c-2.21 0-4 .21-4-2a4 4 0 0 1 8 0c0 2.21-1.79 2-4 2zM32 33c-2.21 0-4 .21-4-2a4 4 0 0 1 8 0c0 2.21-1.79 2-4 2zM20 33c-2.21 0-4 .21-4-2a4 4 0 0 1 8 0c0 2.21-1.79 2-4 2z" />
                                        <path class="cls-5" d="M42 37h4v4h-4zM26 37h4v4h-4z" />
                                        <path class="cls-6"
                                            d="M34 37h4v4h-4zM18 37h4v4h-4zM52 10h-5V5a5 5 0 0 1 5 5z" />
                                        <path d="M47 10h5a5 5 0 1 1-5-5z" style="fill:#fc9b28" />
                                        <path class="cls-8" d="M14 19h6v4h-6zM44 19h6v4h-6z" />
                                        <path class="cls-3"
                                            d="M30 15v2a2.006 2.006 0 0 1-2 2H6a2.006 2.006 0 0 1-2-2v-2h26z" />
                                        <path d="M25 15h-8V1h11a2.006 2.006 0 0 1 2 2v12z" style="fill:#029e84" />
                                        <path class="cls-5"
                                            d="M13 15H4V3a2.006 2.006 0 0 1 2-2h11v14zM60 3v14a2.006 2.006 0 0 1-2 2H36a2.006 2.006 0 0 1-2-2V3a2.006 2.006 0 0 1 2-2h22a2.006 2.006 0 0 1 2 2zm-8 7a5 5 0 1 0-5 5 5 5 0 0 0 5-5z" />
                                        <path class="cls-10"
                                            d="M61 22H51v-2h7a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H36a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h7v2H21v-2h7a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h7v2H3a3 3 0 0 0-3 3v36a3 3 0 0 0 3 3h58a3 3 0 0 0 3-3V25a3 3 0 0 0-3-3zm-9 2h9a1 1 0 0 1 1 1v31H52zm-2 32H14V24h36zM35 17V3a1 1 0 0 1 1-1h22a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H36a1 1 0 0 1-1-1zm10 3h4v2h-4zM6 2h22a1 1 0 0 1 1 1v11h-3V6h-2v8h-2V8h-2v6h-2V4h-2v10h-2V6h-2v8h-2V8H8v6H5V3a1 1 0 0 1 1-1zM5 17v-1h24v1a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm10 3h4v2h-4zM2 25a1 1 0 0 1 1-1h9v32H2zm59 37H3a1 1 0 0 1-1-1v-3h60v3a1 1 0 0 1-1 1z" />
                                        <path class="cls-10"
                                            d="M15.767 33.142c.89.882 2.255.87 3.71.861L20 34H21.007a4.373 4.373 0 0 0 3.226-.863A2.894 2.894 0 0 0 25 31a5 5 0 0 0-10 0 2.894 2.894 0 0 0 .767 2.142zM20 28a3 3 0 0 1 3 3 1.129 1.129 0 0 1-.176.722A3.4 3.4 0 0 1 21 32v-2h-2v2a3.391 3.391 0 0 1-1.824-.282A1.129 1.129 0 0 1 17 31a3 3 0 0 1 3-3zM31.477 34h1.53a4.373 4.373 0 0 0 3.226-.863A2.894 2.894 0 0 0 37 31a5 5 0 0 0-10 0 2.894 2.894 0 0 0 .767 2.142c.889.882 2.258.87 3.71.858zM32 28a3 3 0 0 1 3 3 1.129 1.129 0 0 1-.176.722A3.4 3.4 0 0 1 33 32v-2h-2v2a3.4 3.4 0 0 1-1.824-.282A1.129 1.129 0 0 1 29 31a3 3 0 0 1 3-3zM43.477 34h1.53a4.373 4.373 0 0 0 3.226-.863A2.894 2.894 0 0 0 49 31a5 5 0 0 0-10 0 2.894 2.894 0 0 0 .767 2.142c.89.882 2.257.87 3.71.858zM44 28a3 3 0 0 1 3 3 1.129 1.129 0 0 1-.176.722A3.4 3.4 0 0 1 45 32v-2h-2v2a3.4 3.4 0 0 1-1.824-.282A1.129 1.129 0 0 1 41 31a3 3 0 0 1 3-3zM47 4a6 6 0 1 0 6 6 6.006 6.006 0 0 0-6-6zm3.858 5H48V6.142A4 4 0 0 1 50.858 9zM47 14a3.992 3.992 0 0 1-1-7.858V10a1 1 0 0 0 1 1h3.858A4 4 0 0 1 47 14zM22 42a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1zm-3-4h2v2h-2zM25 41a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1zm2-3h2v2h-2zM33 37v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1zm2 1h2v2h-2zM46 36h-4a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1zm-1 4h-2v-2h2zM17 48h6v2h-6zM17 44h6v2h-6zM25 48h6v2h-6zM25 44h6v2h-6zM33 48h6v2h-6zM33 44h6v2h-6zM41 48h6v2h-6zM41 44h6v2h-6zM17 52h30v2H17zM54 27h6v2h-6zM54 35h6v2h-6zM54 43h6v2h-6zM54 51h6v2h-6zM4 27h6v2H4zM4 35h6v2H4zM4 43h6v2H4zM4 51h6v2H4z" />
                                    </g>
                                </svg>
                            </div>
                            <span class="mx-2" style="font-weight: 600">{{ __('lang.dashboard') }}</span>
                        </a>
                    </li>
{{--                    @endif--}}
{{--                    @if (!empty($module_settings['product_module']))--}}
                        <li class="dropdown scroll mx-2 mb-0 p-0 " style="height: 40px;">
                            <a href="javaScript:void();"
                               class="d-flex employees-menu align-items-center text-decoration-none item-list-a dropdown-toggle"
                               style="height: 100%;" data-toggle="dropdown">
                                <div style="width: 25px" class="d-flex align-items-center">
                                    <img src="{{ asset('assets/back-end/images/navbar/products.svg') }}" alt="{{ __('lang.products') }}">
                                </div>
{{--                                 <img src="{{ asset('assets/back-end/images/navbar/products.svg') }}"--}}
{{--                                      class="img-fluid pl-1"--}}
{{--                                    alt="widgets">--}}
                                <span class="mx-2" style="font-weight: 600">{{ __('lang.products') }}</span>
                            </a>
                            <ul
                                class="dropdown-menu list-style-none @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('ProductController@index') }}" target="_blank"
                                                           class="jobs-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.products')</a>
                                </li>
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('CategoryController@index') }}" target="_blank"
                                                           class="employees-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.categories')</a></li>
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('BrandController@index') }}" target="_blank"
                                                           class="wages-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.brands')</a>
                                </li>

                            </ul>
                        </li>
{{--                    @endif--}}
{{--                    @if (!empty($module_settings['employee_module']))--}}
                        <li class="dropdown scroll mx-2 mb-0 p-0 " style="height: 40px;">
                            <a href="javaScript:void();"
                               class="d-flex employees-menu align-items-center text-decoration-none item-list-a dropdown-toggle"
                               style="height: 100%;" data-toggle="dropdown">
                                {{-- <img src="{{ asset('images/topbar/employee.png') }}" class="img-fluid pl-1"
                                    alt="widgets"> --}}
                                <div style="width: 25px" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 100%" viewBox="0 0 48 48">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #dad7e5
                                                }

                                                .cls-4 {
                                                    fill: #f6ccaf
                                                }

                                                .cls-5 {
                                                    fill: #db5669
                                                }

                                                .cls-6 {
                                                    fill: #f26674
                                                }
                                            </style>
                                        </defs>
                                        <g id="professional_employee" data-name="professional employee">
                                            <path class="cls-1"
                                                  d="M47 39.08V47H1c0-7.51-.75-11.39 3-15.06 2.07-2 3.08-2.08 14-5.94l6 6 6-6 10.33 3.65A10 10 0 0 1 47 39.08z" />
                                            <path
                                                d="M47 39.08V45H17.06A13.06 13.06 0 0 1 4 31.94c2.07-2 3.08-2.08 14-5.94l6 6 6-6 10.33 3.65A10 10 0 0 1 47 39.08z"
                                                style="fill:#edebf2" />
                                            <path d="M30 22.29V26l-6 6-6-6v-3.71a8 8 0 0 0 12 0z" style="fill:#edb996" />
                                            <path class="cls-4"
                                                  d="M28.35 27.65 24 32l-4-4a1.49 1.49 0 0 1 2.21-1.3c2.19 1.19 3.79 1.69 6.14.95z" />
                                            <path class="cls-5" d="M29 47H19l2-9h6c1.79 8 1.41 6.34 2 9z" />
                                            <path class="cls-6" d="M28.56 45c-4.29 0-6.78-3.5-6-7H27z" />
                                            <path class="cls-4"
                                                  d="M32 13c0 4 .32 6.06-1.44 8.57a8 8 0 0 1-12.56.72C15.58 19.54 16 17 16 13a13.37 13.37 0 0 0 11-5 5 5 0 0 0 5 5z" />
                                            <path
                                                d="M32 13c0 4 .32 6.06-1.44 8.57a8 8 0 0 1-10.22-.91C17.76 18.08 18 15.31 18 12.92a13.14 13.14 0 0 0 4.37-1.24A14 14 0 0 0 27 8a5 5 0 0 0 5 5z"
                                                style="fill:#ffdec7" />
                                            <path class="cls-4"
                                                  d="M34 17h-2v-4h2a2 2 0 0 1 0 4zM14 17h2v-4h-2a2 2 0 0 0-2 2 2 2 0 0 0 2 2z" />
                                            <path
                                                d="M35 12v1h-3a5 5 0 0 1-5-5 13.28 13.28 0 0 1-4.63 3.68C19.13 13.25 16.76 13 13 13v-1a11 11 0 0 1 22 0z"
                                                style="fill:#be927c" />
                                            <path
                                                d="M19.6 11a2.81 2.81 0 0 1-2.7-3.61c.6-2 1.49-4.39 2.59-5.42A11 11 0 0 0 13 12v1c4.32 0 8.13.38 12.36-3.32A13.22 13.22 0 0 1 19.6 11z"
                                                style="fill:#a87e6b" />
                                            <path class="cls-1"
                                                  d="m24 32-6 6-5.49-10.06L18 26l6 6zM35.49 27.94 30 38l-6-6 6-6 5.49 1.94z" />
                                            <path class="cls-5" d="M27 35v3h-6v-3l3-3 3 3z" />
                                            <path class="cls-6" d="M27 35v2h-2a3 3 0 0 1-3-3l2-2z" />
                                            <path class="cls-1" d="M1 47h18v1H1z" />
                                            <path class="cls-5" d="M19 47h10v1H19z" />
                                            <path class="cls-1" d="M29 47h18v1H29z" />
                                            <path
                                                d="M40.66 28.7 31 25.29v-2.65A8.9 8.9 0 0 0 32.94 18H34a3 3 0 0 0 2-5.22c0-17-24-17-24 0A3 3 0 0 0 14 18h1.06A8.9 8.9 0 0 0 17 22.64v2.65L7.34 28.7A11 11 0 0 0 0 39.08V47a1 1 0 0 0 2 0v-7.92a9 9 0 0 1 6-8.49L12.4 29c5.19 10.37 4.76 10 5.6 10 2 0 3.28-6.85 0 7.78a1 1 0 0 0 2 .44L21.8 39h4.4l1.8 8.22a1 1 0 0 0 2-.44c-2.27-10.18-2-8.7-2-9.37 2.87 2.87 2 2.92 7.6-8.41l4.4 1.59a9 9 0 0 1 6 8.49V47a1 1 0 0 0 2 0v-7.92a11 11 0 0 0-7.34-10.38zM24 30.59l-5-5v-1.11a9 9 0 0 0 10 0v1.11zM24 24a7 7 0 0 1-7-7v-3a14.23 14.23 0 0 0 9.39-3.85A6 6 0 0 0 31 13.91V17a7 7 0 0 1-7 7zm10-8h-1v-2h1a1 1 0 0 1 0 2zM24 2a10 10 0 0 1 10 10h-2a4 4 0 0 1-4-4 1 1 0 0 0-1.78-.62A12.36 12.36 0 0 1 16 12h-2A10 10 0 0 1 24 2zM14 14h1v2h-1a1 1 0 0 1 0-2zm4.27 22.31-4-7.94 3.44-1.22L22.59 32zM26 37h-4v-1.59l2-2 2 2zm3.73-.69L25.41 32l4.85-4.85 3.44 1.22z" />
                                            <path
                                                d="M8 45v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-2 0zM38 45v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-2 0z" />
                                        </g>
                                    </svg>
                                </div>
                                <span class="mx-2" style="font-weight: 600">{{ __('lang.employees') }}</span>
                            </a>
                            <ul
                                class="dropdown-menu list-style-none @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('JobController@index') }}" target="_blank"
                                                           class="jobs-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.jobs')</a>
                                </li>
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('EmployeeController@index') }}" target="_blank"
                                                           class="employees-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.employees')</a></li>
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('WagesAndCompensationController@index') }}" target="_blank"
                                                           class="wages-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.wages')</a>
                                </li>
                                {{-- ########### Attendance : الحضور و الانصراف ########### --}}
                                <li class="navbar_item"><a
                                        style="cursor: pointer;font-weight: 600;text-decoration: none;font-size: 12px"
                                        href="{{ action('AttendanceController@index') }}" target="_blank"
                                        class="attendance-button d-flex item-list-a"><i
                                            class="mdi mdi-circle"></i>@lang('lang.attend_and_leave')</a></li>
                            </ul>
                        </li>
{{--                    @endif--}}
                    {{-- @endif --}}
{{--                    @if (!empty($module_settings['customer_module']))--}}
                        <li class="dropdown scroll mx-2 mb-0 p-0 " style="height: 40px;">
                            <a href="javaScript:void();"
                               class="d-flex customers-menu align-items-center text-decoration-none  item-list-a dropdown-toggle"
                               style="height: 100%;font-weight: 600" data-toggle="dropdown">
                                {{-- <img src="{{ asset('images/topbar/customer-feedback.png') }}" class="img-fluid pl-1"
                                    alt="layouts"> --}}
                                <div style="width: 25px" class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 100% ;enable-background:new 0 0 512 512" viewBox="0 0 512 512"
                                         xml:space="preserve">
                                    <path style="fill:#d29b6e"
                                          d="m346.254 181.348-40.666-15.25c-6.675-2.503-11.097-10.394-11.097-17.522h-68.409c0 7.128-4.422 15.019-11.097 17.522l-40.666 15.25a25.655 25.655 0 0 0-16.646 24.02v16.427c0 9.446 7.656 17.102 17.102 17.102h171.023c9.446 0 17.102-7.656 17.102-17.102v-16.427a25.656 25.656 0 0 0-16.646-24.02z" />
                                        <path style="fill:#e4eaf6"
                                              d="m346.254 181.348-32.892-12.335-42.127 35.106a17.1 17.1 0 0 1-21.897 0l-42.127-35.106-32.892 12.335a25.655 25.655 0 0 0-16.646 24.02v16.427c0 9.446 7.656 17.102 17.102 17.102h171.023c9.446 0 17.102-7.656 17.102-17.102v-16.427a25.653 25.653 0 0 0-16.646-24.02z" />
                                        <path style="fill:#f0c087"
                                              d="m317.713 44.497-5.336 80.037a25.653 25.653 0 0 1-10.205 18.817l-17.942 13.456a25.648 25.648 0 0 1-15.392 5.131h-17.102c-5.551 0-10.952-1.8-15.392-5.131l-17.942-13.457a25.655 25.655 0 0 1-10.205-18.817l-5.336-80.037c-1.316-19.741 14.343-36.479 34.13-36.479h46.594c19.785 0 35.443 16.738 34.128 36.48z" />
                                        <path style="fill:#5a4146"
                                              d="M283.584 8.017H236.99c-19.786 0-35.446 16.738-34.129 36.479l2.127 31.91c2.941-.202 76.287-5.475 112.206-24.129l.518-7.78c1.316-19.742-14.342-36.48-34.128-36.48z" />
                                        <path style="fill:#d29b6e"
                                              d="m217.987 446.434-40.666-15.25c-6.675-2.503-11.097-10.394-11.097-17.522h-68.41c0 7.128-4.422 15.019-11.097 17.522l-40.666 15.25a25.655 25.655 0 0 0-16.646 24.02v16.427c0 9.446 7.656 17.102 17.102 17.102H217.53c9.446 0 17.102-7.656 17.102-17.102v-16.427a25.653 25.653 0 0 0-16.645-24.02z" />
                                        <path style="fill:#ff6464"
                                              d="M217.987 446.434 185.095 434.1l-42.127 35.106a17.1 17.1 0 0 1-21.897 0L78.943 434.1l-32.892 12.334a25.655 25.655 0 0 0-16.646 24.02v16.427c0 9.446 7.656 17.102 17.102 17.102H217.53c9.446 0 17.102-7.656 17.102-17.102v-16.427a25.651 25.651 0 0 0-16.645-24.02z" />
                                        <path style="fill:#f0c087"
                                              d="m189.445 309.583-5.336 80.037a25.653 25.653 0 0 1-10.205 18.817l-17.942 13.456a25.648 25.648 0 0 1-15.392 5.131h-17.102c-5.551 0-10.952-1.8-15.392-5.131l-17.942-13.457a25.655 25.655 0 0 1-10.205-18.817l-5.336-80.037c-1.316-19.742 14.342-36.48 34.129-36.48h46.594c19.787 0 35.445 16.738 34.129 36.481z" />
                                        <path style="fill:#7d5a50"
                                              d="M155.317 273.102h-46.594c-19.786 0-35.446 16.738-34.129 36.479l2.127 31.91c2.941-.202 76.287-5.475 112.206-24.129l.518-7.78c1.316-19.742-14.342-36.48-34.128-36.48z" />
                                        <path style="fill:#5a4146"
                                              d="M397.105 273.102c-62.237 0-76.384 67.797-76.96 142.49-.024 3.108 1.881 5.907 4.8 7.215 9.997 4.479 22.118 8.033 35.643 10.342l72.822.036c13.61-2.309 25.805-5.877 35.854-10.378 2.919-1.308 4.824-4.107 4.8-7.215-.574-74.693-14.722-142.49-76.959-142.49z" />
                                        <path style="fill:#d29b6e"
                                              d="M482.616 486.881v-10.766a25.655 25.655 0 0 0-12.926-22.274l-38.316-21.894a17.103 17.103 0 0 1-8.617-14.849V401.37H371.45v15.729a17.103 17.103 0 0 1-8.617 14.849l-38.316 21.894a25.653 25.653 0 0 0-12.926 22.274v10.766c0 9.446 7.656 17.102 17.102 17.102h136.818c9.449-.001 17.105-7.657 17.105-17.103z" />
                                        <path style="fill:#f0c087"
                                              d="M439.86 341.511v45.333a25.655 25.655 0 0 1-12.455 21.998l-21.502 12.902a17.105 17.105 0 0 1-17.598 0l-21.502-12.902a25.654 25.654 0 0 1-12.455-21.998v-45.333s51.307 0 68.409-17.102l17.103 17.102z" />
                                        <path style="fill:#ffd782"
                                              d="m469.691 453.842-24.963-14.264c-4.716 6.692-22.584 30.087-47.623 38.753-25.039-8.666-42.908-32.061-47.624-38.753l-24.963 14.264a25.654 25.654 0 0 0-12.926 22.274v10.766c0 9.446 7.656 17.102 17.102 17.102h136.818c9.446 0 17.102-7.656 17.102-17.102v-10.766a25.648 25.648 0 0 0-12.923-22.274z" />
                                        <path
                                                d="m473.657 446.881-18.346-10.484c6.154-1.804 11.912-3.897 17.22-6.275 5.843-2.617 9.587-8.345 9.539-14.591-.345-44.811-5.585-78.3-16.017-102.38-13.816-31.894-37.018-48.065-68.958-48.065s-55.141 16.171-68.96 48.065c-4.095 9.451-7.386 20.36-9.899 32.826l-49.943-34.336v-64.726h77.495c13.851 0 25.119-11.268 25.119-25.119v-16.427c0-13.957-8.78-26.625-21.848-31.526l-40.666-15.25c-2.65-.994-4.644-3.171-5.474-5.79l4.053-3.04a33.636 33.636 0 0 0 13.393-24.696L325.7 45.03c.775-11.616-3.342-23.153-11.295-31.653C306.452 4.876 295.215 0 283.572 0h-46.594c-11.641 0-22.879 4.876-30.831 13.376-7.953 8.501-12.07 20.039-11.296 31.653l5.336 80.037a33.637 33.637 0 0 0 13.393 24.696l4.053 3.04a9.13 9.13 0 0 1-5.474 5.79l-40.666 15.25c-13.068 4.901-21.848 17.57-21.848 31.527v16.427c0 13.851 11.268 25.119 25.119 25.119h77.495v64.726l-57.565 39.576 2.74-41.101c.775-11.616-3.342-23.153-11.295-31.653-7.954-8.5-19.191-13.376-30.833-13.376h-46.594c-11.641 0-22.879 4.876-30.831 13.376-7.953 8.501-12.07 20.039-11.296 31.653l5.336 80.037a33.637 33.637 0 0 0 13.393 24.696l4.053 3.04a9.13 9.13 0 0 1-5.474 5.79l-40.666 15.25c-13.068 4.901-21.848 17.57-21.848 31.527v16.427c0 13.851 11.268 25.119 25.119 25.119H217.52c13.851 0 25.119-11.268 25.119-25.119v-16.427c0-13.957-8.78-26.625-21.848-31.526l-40.666-15.25c-2.65-.994-4.644-3.171-5.474-5.79l4.053-3.04a33.633 33.633 0 0 0 13.393-24.696l1.237-18.544 66.942-46.022 55.08 37.867c-2.016 15.334-3.088 32.639-3.239 52.078-.048 6.247 3.696 11.975 9.54 14.591 5.307 2.378 11.064 4.472 17.219 6.277l-18.344 10.483c-10.464 5.979-16.965 17.181-16.965 29.234v10.766c0 13.851 11.268 25.119 25.119 25.119h136.818c13.851 0 25.119-11.268 25.119-25.119v-10.766c-.001-12.056-6.502-23.258-16.966-29.237zM217.854 24.33c5.006-5.35 11.797-8.297 19.124-8.297h46.594c7.326 0 14.118 2.947 19.124 8.297 5.006 5.351 7.494 12.323 7.007 19.633l-.079 1.182c-27.248 15.519-81.868 21.52-97.167 22.935l-1.608-24.117c-.488-7.31 2-14.282 7.005-19.633zm-4.33 59.764c14.292-1.275 63.014-6.484 94.868-20.461l-2.109 31.631-.001.006c-.883 13.25-12.849 24.446-26.129 24.446h-19.877a8.017 8.017 0 0 0 0 16.034h19.877c8.494 0 16.544-2.698 23.299-7.268a17.606 17.606 0 0 1-6.099 8.456l-17.944 13.456a17.745 17.745 0 0 1-10.582 3.527h-17.102c-3.79 0-7.55-1.253-10.582-3.527L223.2 136.936a17.618 17.618 0 0 1-7.015-12.937l-2.661-39.905zm17.998 79.126a33.878 33.878 0 0 0 20.202 6.734h17.102a33.878 33.878 0 0 0 20.202-6.734l.814-.611a25.332 25.332 0 0 0 7.206 7.933l-36.774 24.516-36.774-24.517a25.319 25.319 0 0 0 7.206-7.933l.816.612zm-65.844 58.575v-16.427c0-7.31 4.599-13.947 11.444-16.513l28.764-10.786 49.943 33.295a8.008 8.008 0 0 0 8.894 0l49.943-33.295 28.764 10.786c6.845 2.566 11.445 9.203 11.445 16.513v16.427c0 5.01-4.076 9.086-9.086 9.086H174.765c-5.011 0-9.087-4.076-9.087-9.086zm-76.091 67.621c5.006-5.35 11.797-8.297 19.124-8.297h46.594c7.326 0 14.118 2.947 19.124 8.297 5.006 5.351 7.494 12.323 7.007 19.633l-.079 1.182c-27.248 15.519-81.868 21.52-97.167 22.935l-1.608-24.117c-.488-7.31 2-14.282 7.005-19.633zm137.018 181.038v16.427c0 5.01-4.076 9.086-9.086 9.086H46.497c-5.01 0-9.086-4.076-9.086-9.086v-16.427c0-7.31 4.599-13.947 11.444-16.513l29.138-10.926c9.545 20.996 30.64 34.781 54.015 34.781 23.374 0 44.47-13.784 54.015-34.782l29.137 10.926c6.846 2.567 11.445 9.204 11.445 16.514zm-55.516-33.348c-7.117 14.913-22.293 24.656-39.081 24.656-16.79 0-31.965-9.743-39.082-24.656a25.255 25.255 0 0 0 9.513-9.412l.816.611a33.878 33.878 0 0 0 20.202 6.734h17.102a33.878 33.878 0 0 0 20.202-6.734l.814-.611a25.265 25.265 0 0 0 9.514 9.412zm-2.005-35.084-17.942 13.457a17.745 17.745 0 0 1-10.582 3.527h-17.102c-3.79 0-7.55-1.253-10.582-3.527l-17.942-13.457a17.618 17.618 0 0 1-7.015-12.937l-2.66-39.906c14.292-1.275 63.014-6.484 94.867-20.461l-4.024 60.367a17.63 17.63 0 0 1-7.018 12.937zm254.186-.054-21.502 12.902a9.074 9.074 0 0 1-9.349 0l-21.502-12.902c-5.281-3.168-8.563-8.964-8.563-15.124v-37.557c5.317-.264 12.787-.818 20.909-1.977 16.975-2.425 29.989-6.522 38.836-12.211l9.733 9.733v42.013c.001 6.159-3.281 11.954-8.562 15.123zm-56.47 36.94c5.439-3.107 9.435-8.108 11.364-13.893l6.006 3.604c3.986 2.391 8.455 3.587 12.924 3.587s8.938-1.196 12.924-3.587l6.006-3.604c1.928 5.786 5.926 10.786 11.363 13.893l4.499 2.571c-4.001 5.367-17.024 21.366-34.79 28.327-17.669-6.934-30.765-22.962-34.787-28.33l4.491-2.568zm-38.649-23.448c.342-42.52 5.149-73.901 14.695-95.935 11.197-25.843 28.941-38.405 54.247-38.405s43.051 12.563 54.247 38.405c9.546 22.034 14.353 53.417 14.695 95.935a.65.65 0 0 1-.06.031c-8.754 3.922-19.426 7.093-30.998 9.254-2.603-1.66-4.214-4.542-4.214-7.647 0-.304-.02-.602-.053-.897l.808-.485c10.083-6.05 16.347-17.113 16.347-28.872v-45.333a8.014 8.014 0 0 0-2.348-5.668l-17.102-17.102a8.016 8.016 0 0 0-11.337 0c-5.652 5.652-18.4 10.152-35.895 12.67-14.252 2.051-26.724 2.084-26.846 2.084a8.017 8.017 0 0 0-8.017 8.017v45.333c0 11.759 6.264 22.823 16.347 28.872l.809.485a8.028 8.028 0 0 0-.053.896c0 3.105-1.611 5.987-4.214 7.647-11.57-2.16-22.246-5.334-30.998-9.254l-.06-.031zm146.438 71.421c0 5.01-4.076 9.086-9.086 9.086H328.685c-5.01 0-9.086-4.076-9.086-9.086v-10.766a17.674 17.674 0 0 1 8.887-15.313l19.811-11.321c3.49 4.939 20.836 27.978 46.263 36.454a7.997 7.997 0 0 0 5.07 0c25.427-8.475 42.772-31.514 46.263-36.454l19.811 11.32c5.481 3.133 8.887 9 8.887 15.313v10.767h-.002z" />
                                </svg>

                                </div>
                                <span class="mx-2">{{ __('lang.customers') }}</span>
                            </a>
                            <ul
                                    class="dropdown-menu list-style-none @if (app()->isLocale('ar')) text-end @else text-start @endif">
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('CustomerController@index') }}" target="_blank"
                                                           class="customers-button d-flex item-list-a"><i
                                                class="mdi mdi-circle"></i>{{ __('lang.customers') }}</a></li>
                                <li class="navbar_item"><a style="cursor: pointer;font-weight: 600;text-decoration: none"
                                                           href="{{ action('CustomerTypeController@index') }}" target="_blank"
                                                           class="customer-types-button d-flex item-list-a"><i
                                                class="mdi mdi-circle"></i>{{ __('lang.customer_types') }}</a></li>
                            </ul>
                        </li>
{{--                    @endif--}}

                </ul>
            </div>
        </div>

</nav>
<!-- End Horizontal Nav -->
{{-- </div>
<!-- End container-fluid -->
</div> --}}
<!-- End Navigationbar -->

