@extends('layouts.app')
@section('title', __('lang.transfer'))

@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="col-md-12 print-only">
            @include('layouts.partials.print_header')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center no-print">
                        <h4>@lang('lang.transfer'): {{$transfer->invoice_no}}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('reference', __('lang.reference'), []) !!}:
                                <b>{{$transfer->invoice_no}}</b>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('date', __('lang.date'), []) !!}:
                                <b>{{@format_date($transfer->transaction_date)}}</b>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('sender_store', __('lang.sender_store'), []) !!}:
                                <b>{{$transfer->sender_store->name}}</b>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('receiver_store', __('lang.receiver_store'), []) !!}:
                                <b>{{$transfer->receiver_store->name}}</b>
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('approved', __('lang.approved'), []) !!}:
                                <b>@if(!empty($transfer->approved_at)) {{@format_date($transfer->approved_at)}} @endif - {{$transfer->approved_by_user->name}}</b>
                            </div>

                            <div class="col-md-6">
                                {!! Form::label('receiver_store', __('lang.received'), []) !!}:
                                <b>@if(!empty($transfer->received_at)) {{@format_date($transfer->received_at)}} @endif - {{$transfer->received_by_user->name}}</b>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-condensed" id="product_table">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%" class="col-sm-8">@lang( 'lang.products_' )</th>
                                            <th style="width: 25%" class="col-sm-4">@lang( 'lang.sku' )</th>
                                            <th style="width: 25%" class="col-sm-4">@lang( 'lang.quantity' )</th>
                                            <th style="width: 12%" class="col-sm-4">@lang( 'lang.purchase_price' )</th>
                                            <th style="width: 12%" class="col-sm-4">@lang( 'lang.sub_total' )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transfer->transfer_lines as $line)
                                        <tr>
                                            <td>
                                                {{$line->product->name}}
                                                @if(!empty($line->variation))
                                                @if($line->variation->name != "Default")
                                                <b>{{$line->variation->name}}</b>
                                                @endif
                                                @endif

                                            </td>
                                            <td>
                                                {{$line->variation->sub_sku}}
                                            </td>
                                            <td>
                                                @if(isset($line->quantity)){{@num_format($line->quantity)}}@else{{1}}@endif
                                            </td>
                                            <td>
                                                @if(isset($line->purchase_price)){{@num_format($line->purchase_price)}}@else{{0}}@endif
                                            </td>
                                            <td>
                                                {{preg_match('/\.\d*[1-9]+/', (string)$line->sub_total) ? $line->sub_total : @num_format($line->sub_total)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3 offset-md-8 text-right">
                                <h3> @lang('lang.total'): <span
                                        class="final_total_span">{{@num_format($transfer->final_total)}}</span>
                                </h3>

                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('notes', __('lang.notes'), []) !!}: <br>
                                    {{$transfer->notes}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 print-only">
            @include('layouts.partials.print_footer')
        </div>
    </div>


</section>
@endsection

@section('javascript')
<script type="text/javascript">
    @if(!empty(request()->print))
        $(document).ready(function(){
            setTimeout(() => {
                window.print();
            }, 1000);
        })
    @endif
</script>
@endsection
