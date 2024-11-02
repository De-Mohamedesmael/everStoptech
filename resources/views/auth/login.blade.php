@extends('layouts.login')

@section('content')
    @php
        $logo = App\Models\System::getProperty('logo');
        $site_title = App\Models\System::getProperty('site_title');
        $config_languages = config('constants.langs');
        $languages = [];
        foreach ($config_languages as $key => $value) {
            $languages[$key] = $value['full_name'];
        }
        $version_number = App\Models\System::getProperty('version_number');
        $version_update_datatime = App\Models\System::getProperty('version_update_date');
    @endphp


    <section class="m-0 p-0 d-flex pt-5" style="width: 100vw;height: 100vh;background-color: var(--primary-color)">
        <div class="col-md-7 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-white">
                {{ trans('lang.welcome') }}
            </h1>
            <div style="width: 400px">
                <img class="w-100" src="{{ asset('front/images/icons Png/Mask Group 4.png') }}" alt="">
            </div>
            <div class="copyrights text-center ">
                <p class="text-white">&copy; {{ App\Models\System::getProperty('site_title') }} | <span
                        class="">@lang('lang.developed_by')
                        <a class="text-white" target="_blank" href="http://sherifshalaby.tech">sherifshalaby.tech</a></span>
                </p>
                <p class="text-white">
                    <a class="text-white" href="mailto:info@sherifshalaby.tech">info@sherifshalaby.tech</a>
                </p>
            </div>
        </div>
        <div class="col-md-5 px-0">
            <div class="bg-white h-100 d-flex justify-content-start py-5 align-items-center flex-column">
                <h1 style="font-size: 36px;font-weight: 700">{{ trans('lang.login') }}</h1>
                <div class="logo mb-4 d-flex justify-content-center align-items-center"
                    style="width: 170px;height: 170px;border-radius: 50%;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); !important;overflow:hidden">
                    @if ($logo)
                        <img src="{{ asset('/uploads/' . $logo) }}" width="200">
                    @endif
                    {{-- <img src="{{ asset('front/images/اصدار السوبر ماركت.jpeg') }}" width="150" alt=""> --}}
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center w-75">
                    <h4>
                        @lang('lang.version'): {{ $version_number }}</h4>
                    <h4>@lang('lang.last_update'):
                        @if (!empty($version_update_datatime))
                            {{ \Carbon\Carbon::createFromTimestamp(strtotime($version_update_datatime))->format('d-M-Y H:i a') }}
                        @endif
                    </h4>
                </div>
                <div class="navbar-holder">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" style="color: gray" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('lang.language')
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($languages as $key => $lang)
                                <a class="dropdown-item" href="{{ action('GeneralController@switchLanguage', $key) }}">
                                    {{ $lang }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}" id="login-form" style="width: 60%">
                    @csrf
                    <div class="d-flex flex-column mb-3 w-100">
                        <label style="color: var(--secondary-color);font-weight: 700;font-size: 20px" class="mb-1"
                            for="email">{{ trans('lang.email') }}</label>
                        <input id="email" type="email" name="email" required value=""
                            placeholder="{{ trans('lang.email') }}"
                            style="border: 7px solid var(--secondary-color);border-radius: 10px">
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label style="color: var(--secondary-color);font-weight: 700;font-size: 20px" class="mb-1"
                            for="password">{{ trans('lang.password') }}</label>
                        <input id="password" type="password" name="password" required value=""
                            placeholder="{{ trans('lang.password') }}"
                            style="border: 7px solid var(--secondary-color);border-radius: 10px">
                    </div>

                    @if ($errors->has('email'))
                        <p style="color:red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                    @endif
                    <a href="{{ route('password.request') }}" class="forgot-pass text-danger"
                        style="font-size: 12px;font-weight: 700">{{ trans('lang.forgot_passowrd') }}</a>

                    <p class="text-center">
                        <a href="{{ action('ContactUsController@getContactUs') }}">@lang('lang.contact_us')</a>
                    </p>
                    <button type="submit" class="btn btn-primary btn-block mt-5">{{ trans('lang.login') }}</button>
                </form>
            </div>
        </div>
    </section>




    @if (session()->has('delete_message'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div>
    @endif
@endsection
