@extends('dashboard',['a' => __('strings.profile')])
@section('body')
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">

                <div class="card-body pt-0">

                    <div class="text-center">
                        <h5 class="h1">
                            {{$user->plan ? $user->plan->title : 'None'}}
                        </h5>
                        <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{__('strings.current_plan')}}
                        </div>

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
                        <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i>{{__('strings.invoices')}} {{$tinvoices}}/{{$plan->invoices}}
                        </div>
                        <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i> Gigs {{$gigs}}/{{$plan->invoices}}
                        </div>
                        <div class="h5 mt-4">
                            <a href="{{url('/plans')}}"><button class="btn btn-sm btn-info">{{__('strings.upgrade_plan')}}</button></a>
                        </div>

                    </div>
                </div>
            </div>
            <a href="{{url('delete/profile')}}"><button id="delete_profile" class="float-right btn btn-sm btn-danger">{{__('strings.delete_profile')}}</button></a>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{__('strings.edit_profile')}} </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        {{csrf_field()}}
                        <h6 class="heading-small text-muted mb-4">{{__('strings.user_info')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                @if($user->image)
                                <div class="col-lg-6">
                                    <img src="{{url('/images/user/'.$user->image)}}" alt="Image placeholder" class="card-img-top">
                                </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{__('strings.upload_photo')}}</label>
                                        <input type="file" id="input-email" class="form-control" name="image" placeholder="jesse@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.fname')}}</label>
                                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" name="fname" value="{{$user->fname}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">{{__('strings.lname')}}</label>
                                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" name="lname" value="{{$user->lname}}">
                                    </div>
                                </div>
                            </div><div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">{{__('strings.gender')}}</label>
                                        <select name="gender" class="form-control" id="">
                                            <option value="male" {{$user->gender =="male" ? 'selected' : ''}}>{{__('strings.male')}}</option>
                                            <option value="female" {{$user->gender =="female" ? 'selected' : ''}}>{{__('strings.female')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">{{__('strings.ssn')}}</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="{{__('strings.ssn')}}" name="ssn" value="{{$user->ssn}}">
                                    </div>

                                </div>
                            </div><div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">{{__('strings.password')}}</label>
                                        <input type="password" name="password" value="%change-password-key%" id="input-postal-code" class="form-control" placeholder="">
                                    </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">{{__('strings.contact')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{__('strings.contact_no')}}</label>
                                        <input type="text" name="number" value="{{$user->number}}" id="input-email" class="form-control" placeholder="{{__('strings.contact_no')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{__('strings.email')}}</label>
                                        <input type="email" name="email" value="{{$user->email}}" id="input-email" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{__('strings.street')}}</label>
                                        <input type="text" name="street" value="{{$user->street}}" id="input-email" class="form-control" placeholder="{{__('strings.street')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">{{__('strings.zip')}}</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="{{__('strings.zip')}}" name="zipcode" value="{{$user->zipcode}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">{{__('strings.city')}}</label>
                                        <input type="text" name="city" value="{{$user->city}}" id="input-email" class="form-control" placeholder="{{__('strings.city')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">{{__('strings.country')}}</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="{{__('strings.country')}}" name="country" value="{{$user->country}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Credit Card Details -->
                        <h6 class="heading-small text-muted mb-4">{{__('strings.card_detail')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="card">{{__('strings.card')}}</label>
                                        <input type="text" name="card_number" value="{{$user->card_number}}" id="card" class="form-control" placeholder="{{__('strings.card')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-cvc">CVC</label>
                                        <input type="text" id="input-cvc" class="form-control" placeholder="CVC" name="cvc" value="{{$user->cvc}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="month">{{__('strings.exp_month')}}</label>
                                        <input type="text" name="ex_month" value="{{$user->ex_month}}" id="month" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="year">{{__('strings.exp_year')}}</label>
                                        <input type="text" name="ex_year" value="{{$user->ex_year}}" id="year" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <!-- Description -->
                        <h6 class="heading-small text-muted mb-4">{{__('strings.about_me')}}</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">{{__('strings.tell_us')}}</label>
                                <textarea name="aboutme" rows="4" class="form-control" placeholder="{{__('strings.few_words')}}">{{$user->aboutme}}</textarea>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary" style="background-color: #5354CE !important;">{{__('strings.update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{URL()->to("update-plan")}}" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="plan">Plan</label>
                                <select name="plan_id" id="plan" class="form-control">
                                    @foreach(Plan::all() as $plan)
                                        <option value="{{$plan->id}}" {{$plan->id == $user->plan_id ? "selected" : ''}}>{{$plan->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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

        $("#delete_profile").click(function(e) {
            if(!confirm("{{__('strings.delete_profile_msg')}}")) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
