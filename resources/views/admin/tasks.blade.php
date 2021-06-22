@extends('admin.dashboard',['a' => 'Gigs'])
@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Users</label>
                                <select name="user_id" class="form-control" id="">
                                    <option value="">Select User</option>
                                    @foreach(\App\User::where('is_admin',0)->get() as $client)
                                        <option value="{{$client->id}}">{{$client->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="open">Open</option>
                                    <option value="sent_to_client">Sent to client</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button class="btn btn-lg btn-primary form-control" name="subBtn" style="background-color: #5354CE !important;">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">{{__('strings.gig')}}</h3>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">User</th>
                            <th scope="col" class="sort" data-sort="name">{{__('strings.task_name')}}</th>
                            <th scope="col" class="sort" data-sort="reference_no">Ref.#</th>
                            <th scope="col" class="sort" data-sort="name">{{__('strings.client')}}</th>
                            <th scope="col" class="sort" data-sort="ean">{{__('strings.price')}}</th>
                            <th scope="col" class="sort" data-sort="budget">{{__('strings.time')}} ( hours )</th>
                            <th scope="col" class="sort" data-sort="status">JobType</th>
                            <th scope="col" class="sort" data-sort="status">Invoiced</th>
                            <th scope="col" class="sort" data-sort="status">Insurance by client</th>
                            <th scope="col" class="sort" data-sort="status">{{__('strings.status')}}</th>
                            <th scope="col" class="sort" data-sort="status">Client Approved</th>
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>


                        <tbody class="list">

                        @foreach($tasks as $task)
                            <tr class="rowParent">
                                <th scope="row"  style="display: none" data-id="cid">{{$task->id}}</th>
                                {{--  <th scope="row" data-id="username">{{$task->user ? ($task->user->fname . ' ' . $task->user->lname ) : ''}}</th>  --}}
                                <th scope="row"   data-id="username"> <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view{{$task->user?$task->user->id:''}}">{{$task->user ? ($task->user->fname . ' ' . $task->user->lname ) : ''}}</a></th>
                                <th scope="row" data-id="name"><a href="{{url('admin_task_'.$task->id)}}">{{$task->name}}</a></th>
                                <th scope="row"  data-id="reference_no">{{$task->reference_no?$task->reference_no:''}}</th>
                                <th scope="row"  style="display: none" data-id="client_id">{{$task->client_id}}</th>


                                <th scope="row" data-id="client" data-toggle="modal" data-target="#client{{$task->id}}">
                                    <a href="#">{{$task->client ? $task->client->name : ''}}</a></th>
                                <th scope="row" data-id="price">{{$task->price}} {{$task->currency}}</th>
                                <th scope="row" data-id="time">{{$task->time}}</th>
                                <th scope="row" data-id="type">{{$task->job_type}}</th>
                                <th scope="row" data-id="type">{!! $task->invoice ? '<a href="/admin_invoice_'.$task->invoice->id.'">View Invoice</a>' : 'No' !!}</th>
                                <th scope="row" data-id="type">{{$task->insurance ? 'Yes' : 'No'}}</th>
                                <th scope="row" data-id="status">{{ucwords(implode(' ',explode('_',$task->status)))}}</th>
                                <th scope="row" data-id="status">{{$task->is_client_approved ? "Yes" : "No"}}</th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#editTask">Update Status</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <div class="modal" id="client{{$task->id}}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Client</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                        <input type="hidden" name="id"  id="id" value="">
                                        <div class="modal-body">
                                                <div>
                                                    <span style="margin-right: 10px">Company Name : </span>
                                                    {{$task->client->name}}
                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Registration Number : </span>
                                                    {{$task->client->num}}
                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Billing Address : </span>
                                                    {{$task->client->address}}
                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Contact Name : </span>
                                                    {{$task->client->cname}}
                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Company Email : </span>
                                                    {{$task->client->email}}
                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Company Phone : </span>
                                                    {{$task->client->phone}}
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('strings.close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach


                        </tbody>
                    </table>
                </div>
                @foreach ( $tasks as $task)
                @if($task->user)
                <div class="modal" id="view{{$task->user->id}}" tabindex="-1" role="dialog">
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

                                    @if($task->user->image)
                                        <div class="form-group mb-3">
                                            <img src="{{url('/images/user/'.$task->user->image)}}" width="100" height="100" alt="" class="">
                                        </div>
                                    @endif
                                    <div class="form-group mb-3">
                                        <span class="font-weight-normal  text-center ">{{$task->user->fname . ' ' . $task->user->lname}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">email : </label>
                                        <span class="font-weight-normal text-center ">{{$task->user->email}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">Plan name : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->plan ? $task->user->plan->title : ""}}

                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">number : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->number}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">ssn: </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->ssn?$task->user->ssn:'N\A'}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">address : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->address}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">gender : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->gender}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">aboutme : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->aboutme}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">street : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->street}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">zipcode : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->zipcode}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">country : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->country}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">card_number : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->card_number	}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">cvc : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->cvc}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">expiry month : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->ex_month}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">expiry year : </label>
                                        <span class="font-weight-normal  text-center ">{{$task->user->ex_year}}</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Sr#</th>
                                                <th >{{ __('strings.date')}}</th>
                                                <th >Plan</th>
                                                <th >{{ __('strings.amount')}} (DKK)</th>
                                            </tr>
                                            @foreach($task->user->payments as $payment)
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
                @endif
                @endforeach
                <!-- Card footer -->
            </div>
        </div>
    </div>


    <div class="modal" id="editTask" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Gig</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admin_edit_task')}}" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="id"  id="idss" value="">
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <select name="status" id="status" class="form-control" id="">
                                    <option value="open">Open</option>
                                    <option value="sent_to_client">Send to client for approval</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="Canceled">Canceled</option>

                                </select>
                            </div>
                        </div>
                        {{csrf_field()}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('strings.save_changes')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('strings.close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(".editBtn").click(function(){
            console.log($(this).parents('.rowParent'))
            console.log($(this).parents('.rowParent'))
            console.log($(this).parents('.rowParent').find("[data-id='cid']").html())
            $("#idss").val($(this).parents('.rowParent').find("[data-id='cid']").html())

            $('#status option[value="'+$(this).parents('.rowParent').find("[data-id='status']").html()+'"]').prop('selected', true)

        })
    </script>
@endsection
