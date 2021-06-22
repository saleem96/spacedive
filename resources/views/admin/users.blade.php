@extends('admin.dashboard',['a' => 'Users'])
@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <form action="">
                    <div class="row col-lg-12">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Plans</label>
                                <select name="plan_id" class="form-control" id="">
                                    <option value="">All users</option>
                                    @foreach($plans as $plan)
                                        <option {{$plan_id == $plan->id ? "selected":''}} value="{{$plan->id}}">{{$plan->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button class="btn btn-lg btn-primary form-control" name="subBtn" value="submit" style="background-color: #5354CE !important;">Update</button>
                            </div>
                        </div>
                        <div class=" col-lg-2 pull-right">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button type="submit" value="admin_export_users" class="btn btn-sm btn-success form-control" name="subBtn"  style="background-color: #5354CE !important;">Export Users</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Users</h3>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Name</th>
                            <th scope="col" class="sort" data-sort="name">Email</th>
                            <th scope="col" class="sort" data-sort="name">Number</th>
                            <th scope="col" class="sort" data-sort="name">Plan Name</th>
                            <th scope="col" class="sort" data-sort="name">Created At</th>
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($users as $user)
                            <tr class="rowParent">

                                <th scope="row"   data-id="cid"> <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view{{$user->id}}">{{$user->fname . ' ' . $user->lname}}</a></th>
                                <th scope="row"   data-id="cid">{{$user->email}}</th>
                                <th scope="row"   data-id="cid">{{$user->number}}</th>
                                <th scope="row"   data-id="cid">{{$user->plan ? $user->plan->title : ''}}</th>
                                <th scope="row"   data-id="cid">{{date("d F Y H:i:s",strtotime($user->created_at))}}</th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view{{$user->id}}">View</a>
                                            <a class="dropdown-item" href="{{url('/admin_profile_'.$user->id)}}">Edit</a>
                                            <a class="dropdown-item" href="{{url('/del_user/'.$user->id)}}">Delete</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                    @foreach($users as $user)
<?php
                        $last_plan = \App\Payment::where('user_id',$user->id)->orderBy('id','desc')->first();
                        $tinvoices = \App\Invoice::where('user_id',$user->id)->where("status","<>","draft")
                            ->when($last_plan,function ($q) use ($last_plan) {
                                return $q->where('created_at',">=",$last_plan->created_at);
                            })->count();

                        ?>
                    <div class="modal" id="view{{$user->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="max-height: 600px;overflow-y: scroll">

                                <div class="modal-header">
                                    <h5 class="modal-title">User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('edit_client')}}" method="post">

                                    <input type="hidden" id="idd" name="id">
                                    <input type="hidden" id="" name="user_id" value="{{auth()->id()}}">

                                    <div class="modal-body">

                                        @if($user->image)
                                            <div class="form-group mb-3">
                                                <img src="{{url('/images/user/'.$user->image)}}" width="100" height="100" alt="" class="">
                                            </div>
                                        @endif
                                        <div class="form-group mb-3">
                                            <span class="font-weight-normal  text-center ">{{$user->fname . ' ' . $user->lname}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">email : </label>
                                            <span class="font-weight-normal text-center ">{{$user->email}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">Plan name : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->plan ? $user->plan->title : ""}}
                                             (  {{$tinvoices}}/{{$last_plan ? $last_plan->invoices : 1}}  )
                                            </span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">number : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->number}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">ssn: </label>
                                            <span class="font-weight-normal  text-center ">{{$user->ssn?$user->ssn:'N\A'}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">address : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->address}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">gender : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->gender}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">aboutme : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->aboutme}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">street : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->street}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">zipcode : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->zipcode}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">country : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->country}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">card_number : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->card_number	}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">cvc : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->cvc}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">expiry month : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->ex_month}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">expiry year : </label>
                                            <span class="font-weight-normal  text-center ">{{$user->ex_year}}</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Sr#</th>
                                                    <th >{{ __('strings.date')}}</th>
                                                    <th >Plan</th>
                                                    <th >{{ __('strings.amount')}} (DKK)</th>
                                                </tr>
                                                @foreach($user->payments as $payment)
                                                    <tr>
                                                        <th>
                                                            {{$loop->index+1}}
                                                        </th>
                                                        <td>
                                                            {{$payment->created_at->format("Y-m-d")}}
                                                        </td>
                                                        <td>
                                                            {{$payment->plan ? $payment->plan->title : ''}}
                                                        </td>
                                                        <td>
                                                            {{$payment->amount}}
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>

                                        {{csrf_field()}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
                <!-- Card footer -->
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
    </script>
@endsection
