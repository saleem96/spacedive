@extends('dashboard',['a' => __('strings.plan_payment')])
@section('body')
    <style>
        .li-plan{

            line-height: 2;
            border-bottom: 1px #f3f3f3 solid;
        }
    </style>
    <div class="row">
        <!------ Include the above in your HEAD tag ---------->


        <div class="container mb-5 mt-5">
            <div class="pricing card-deck flex-column flex-md-row mb-3">
                <div class="col-lg-12">
                    @foreach($plans as $plan)
                        @if($loop->index % 2 == 0 )
                            <div class="row">
                                @endif
                                <div class="col-lg-5 card card-pricing popular shadow text-center px-3 mb-4">
                                    <span class=" w-60 mx-auto px-4 py-1  bg-primary text-white shadow-sm">{{$plan->title}}</span>
                                    <div class="bg-transparent card-header pt-4 border-0">
                                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">Kr.<span class="price">{{$plan->amount}}</span><span class="h6 text-muted ml-2">/ {{__('strings.per_month')}}</span></h1>
                                    </div>
                                    <div class="card-body pt-0">
                                        <ul class="list-unstyled mb-4">
                                            @foreach(explode(',',$plan->lists) as $list)
                                                <li class="li-plan">{{__('strings.'.trim($list))}}</li>
                                            @endforeach
                                        </ul>
                                        @if($plan->id != 1)
                                            <a href="{{url('/payment-'.$plan->id)}}"  class="btn btn-primary mb-3">{{__('strings.order_now')}}</a>
                                        @endif
                                    </div>
                                </div>
                                @if($loop->index % 2 != 0 )
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
@endsection
@section('script')
    <script>
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
