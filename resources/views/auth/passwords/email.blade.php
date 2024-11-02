@extends('layouts.login')

@section('content')
    @php
        $logo = App\Models\System::getProperty('logo');
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
                <h1 style="font-size: 36px;font-weight: 700">{{ __('Reset Password') }}</h1>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="logo mb-4 d-flex justify-content-center align-items-center"
                    style="width: 170px;height: 170px;border-radius: 50%;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); !important;overflow:hidden">
                    @if ($logo)
                        <img src="{{ asset('/uploads/' . $logo) }}" width="200">
                    @endif
                    {{-- <img src="{{ asset('front/images/اصدار السوبر ماركت.jpeg') }}" width="150" alt=""> --}}
                </div>
                <form method="POST" action="{{ route('password.email') }}" style="width: 60%">
                    @csrf


                    <div class="d-flex flex-column mb-3 w-100">
                        <label style="color: var(--secondary-color);font-weight: 700;font-size: 20px" class="mb-1"
                            for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            style="border: 7px solid var(--secondary-color);border-radius: 10px">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary btn-block mt-5">
                        {{ __('Send Password Reset Link') }}
                    </button>

                </form>
            </div>
        </div>
    </section>
@endsection
