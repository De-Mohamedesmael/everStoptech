<div class="card-body py-0">
    <form action="" method="get" id="filters_form">
        <div class="row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">
            {{-- ++++++++++++++++++++ branches filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('branch_id', __('lang.branch'), [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('branch_id[]', [], request()->brach_id, [
                        'class' => 'form-control select2',
                        'multiple',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'branch_id',
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ stores filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('store_id', __('lang.store'), [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('store_id[]', [], request()->store_id, [
                        'class' => 'form-control select2 store',
                        'multiple',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'store_id',
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ suppliers filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('supplier_id', __('lang.supplier'), [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('supplier_id', [], request()->supplier_id, [
                        'class' => 'form-control select2',
                        'placeholder' => __('lang.please_select'),
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ categories filter ++++++++++++++++++++ --}}

            {{-- ++++++++++++++++++++ categories filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('category_id', __('lang.category') . ' 1', [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('category_id', [], request()->category_id, [
                        'class' => 'form-control select2 category',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'categoryId',
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ subcategories1 filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('subcategory_id1', __('lang.category') . ' 2', [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('subcategory_id1', [], request()->subcategory_id1, [
                        'class' => 'form-control select2 subcategory',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'subcategory_id1',
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ subcategories2 filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('subcategory_id2', __('lang.category') . ' 3', [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('subcategory_id2', [], request()->subcategory_id2, [
                        'class' => 'form-control select2 subcategory2',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'subcategory_id2',
                    ]) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++++ subcategories3 filter ++++++++++++++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('subcategory_id3', __('lang.category') . ' 4', [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('subcategory_id3', [], request()->subcategory_id3, [
                        'class' => 'form-control select2 subcategory3',
                        'placeholder' => __('lang.please_select'),
                        'id' => 'subcategory_id3',
                    ]) !!}
                </div>
            </div>

            {{-- @endfor --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('brand_id', __('lang.brand'), [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('brand_id', [], request()->brand_id, [
                        'class' => 'form-control select2',
                        'placeholder' => __('lang.please_select'),
                    ]) !!}
                </div>
            </div>
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                {!! Form::label('created_by', __('lang.created_by'), [
                    'class' => 'mb-0',
                ]) !!}
                <div class="input-wrapper width-full">
                    {!! Form::select('created_by', [], request()->created_by, [
                        'class' => 'form-control select2',
                        'placeholder' => __('lang.please_select'),
                    ]) !!}
                </div>
            </div>
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1"
                        {{ !empty(request()->dont_show_zero_stocks) ? 'checked' : '' }} name="dont_show_zero_stocks">
                    <label class="custom-control-label" for="customSwitch1">@lang('lang.dont_show_zero_stocks')</label>
                </div>
            </div>
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">

                <button type="submit" name="submit" class="btn btn-primary width-100 py-1" title="search">
                    <i class="fa fa-eye"></i> {{ __('lang.filter') }}</button>

            </div>
            {{-- +++++++++ delete_all button ++++++++ --}}
            <div class="col-6 col-md-2 p-1 mb-2 d-flex align-items-end animate__animated animate__bounceInLeft flex-column"
                style="animation-delay: 1.15s">
                <a data-href="{{ url('products/multiDeleteRow') }}" id="delete_all"
                    data-check_password="{{ url('user/check-password') }}" style="font-size: 12px;font-weight: 500"
                    class="btn btn-danger text-white delete_all"><i class="fa fa-trash"></i>
                    @lang('lang.delete_all')</a>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {

    });
</script>
