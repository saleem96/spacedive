@extends('dashboard',['a' => __('strings.plan_payment')])
@section('body')
    <div class="row">
        <div class="col-lg-8">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row col-lg-12">
                            <div class="col-lg-8">
                                <h3 class="mb-0">{{ __('strings.plan_payment')}}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Sr#</th>
                                <th scope="col" class="sort" data-sort="date">{{ __('strings.date')}}</th>
                                <th scope="col" class="sort" data-sort="date">Plan</th>
                                <th scope="col" class="sort" data-sort="amount">{{ __('strings.amount')}} (DKK)</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($payments as $payment)
                                <tr>
                                    <th scope="row">
                                        {{$loop->index+1}}
                                    </th>
                                    <td class="budget">
                                        {{$payment->created_at->format("Y-m-d")}}
                                    </td>
                                    <td class="budget">
                                        {{$payment->plan ? $payment->plan->title : ''}}
                                    </td>
                                    <td class="budget">
                                        {{$payment->amount}}
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-profile">

                <div class="card-body pt-0">

                    <div class="text-center">
                        @if(auth()->user()->plan_id)

                        <h5 class="h1">
                            {{auth()->user()->plan ? auth()->user()->plan->title : 'None'}}
                        </h5>
                        <?php
                            $plan = \App\Plan::find(auth()->user()->plan_id);
                            $last_plan = \App\Payment::where('user_id',auth()->id())->orderBy('id','desc')->first();
                            $tinvoices = \App\Invoice::where('user_id',auth()->id())->where("status","<>","draft")
                                ->when($last_plan,function ($q) use ($last_plan) {
                                    return $q->where('created_at',">=",$last_plan->created_at);
                                })->count();
                            $gigs = \App\Task::where('user_id',auth()->id())->where("status","<>","open")
                                ->when($last_plan,function ($q) use ($last_plan) {
                                    return $q->where('created_at',">=",$last_plan->created_at);
                                })->count();
                        ?>
                        {{--  <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{__('strings.invoices')}} {{$tinvoices}}/{{$plan->invoices}}
                        </div>  --}}

                            <div class="h4 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{__('strings.tasks')}} {{$gigs}}/{{$plan->invoices}}
                            </div>
                        <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{__('strings.current_plan')}}
                        </div>
                        <div class="h5 mt-4">
                            <a href="{{url('/plans')}}"><button class="btn btn-sm btn-info">{{__('strings.upgrade_plan')}}</button></a>
                        </div>
                        <div class="h5 mt-4">
                            <a href="{{url('/endplan')}}" id="end"><button class="btn btn-sm btn-danger">{{__('strings.cancel_sub')}}</button></a>
                        </div>
                        @else

                            <div class="h5 mt-4">
                                <a href="{{url('/plans')}}"><button class="btn btn-sm btn-info">{{__('strings.upgrade_plan')}}</button></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $("#end").click(function(e) {
            if(!confirm('Are you sure you want to cancel your subscription?')) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
