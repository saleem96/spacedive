@extends('dashboard',['a' => __('strings.payment_checkout')])
@section('body')
    <style>
        .li-plan {

            line-height: 2;
            border-bottom: 1px #f3f3f3 solid;
        }
    </style>
    <div class="row">
        <div class="col-xl-6 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{__('strings.payment_checkout')}} </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        {{csrf_field()}}
                        <h6 class="heading-small text-muted mb-4">{{__('strings.card_detail')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="card">{{__('strings.card')}}</label>
                                        <input type="text" name="card" value="{{$user->card_number}}" id="card"
                                               class="form-control" placeholder="{{__('strings.card')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-cvc">CVC</label>
                                        <input type="text" id="input-cvc" class="form-control" placeholder="CVC"
                                               name="cvc" value="{{$user->cvc}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="month">{{__('strings.exp_month')}}</label>
                                        <input type="text" name="month" value="{{$user->ex_month}}" id="month"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="year">{{__('strings.exp_year')}}</label>
                                        <input type="text" name="year" value="{{$user->ex_year}}" id="year"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <input type="checkbox" id="tax1enabled" class="">
                                <label for="tax1enabled" class="tax__label label--check label--check-gray-unselected gray p-v-sm" style="border: 1px solid transparent;">
                                    {{__('strings.do_code')}}</label>
                            </div>
                            <div class="form-group" id="coupon_div" style="display: none">
                                <label class="form-control-label" for="card">{{__('strings.enter_code')}}</label>
                                <input type="text" name="coupon_code" value="" id=""
                                       class="form-control" placeholder="{{__('strings.ccode')}}">
                            </div>

                        </div>
                        <hr class="my-4"/>

                        <!-- Description -->
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary" style="background-color: #5354CE !important;">
                                    Checkout
                                </button>
                            </div>
                        </div>
                        <!-- Description -->

                    </form>

                </div>
                <div class="">
                    <div class="form-group">
                        <img width="250px" src="{{url("/images/safepayment.png")}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 order-xl-1">
            <div class=" card card-pricing popular shadow text-center px-3 mb-4">
                <span class=" w-60 mx-auto px-4 py-1  bg-primary text-white shadow-sm">{{$plan->title}}</span>
                <div class="bg-transparent card-header pt-4 border-0">
                    <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">Kr.<span
                            class="price">{{$plan->amount}}</span><span class="h6 text-muted ml-2">/  {{__('strings.per_month')}}</span>
                    </h1>
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled mb-4">
                        @foreach(explode(',',$plan->lists) as $list)
                            <li class="li-plan">{{__('strings.'.trim($list))}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
@endsection
@section('script')
    <script>

        $("#tax1enabled").change(function(){

            console.log('s')
            $("#coupon_div").toggle()
        })
        $("#month").datepicker({
            format: "mm",
            minViewMode: 1,
            maxViewMode: 1
        });
        $("#year").datepicker({
            format: "yyyy",
            minViewMode: 2,
            maxViewMode: 2,
        });
    </script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });
        $("#month").datepicker({
            format: "mm",
            minViewMode: 1,
            maxViewMode: 1
        });
        $("#year").datepicker({
            format: "yyyy",
            minViewMode: 2,
            maxViewMode: 2,
        });
    </script>
@endsection
