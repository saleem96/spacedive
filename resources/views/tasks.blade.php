@extends('dashboard',['a' => __('strings.tasks')])

@section('body')

    <div class="row" >
        <div class="col">
            <div class="card">
                <form action="">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">{{__('strings.clients')}}</label>
                                <select name="client_id" class="form-control" id="">
                                    <option value="">{{__('strings.select')}} {{__('strings.client')}}</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">{{__('strings.status')}}</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">{{__('strings.select_status')}} </option>
                                    <option value="open">{{__('strings.open')}} </option>
                                    <option value="sent_to_client">{{__('strings.sent to client')}} </option>
                                    <option value="confirmed">{{__('strings.confirmed')}} </option>
                                    <option value="completed">{{__('strings.completed')}} </option>
                                    <option value="canceled">{{__('strings.canceled')}} </option>



                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button class="btn btn-lg btn-primary form-control" name="subBtn" style="background-color: #5354CE !important;">{{__('strings.update')}} </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-6">
                            <h3 class="mb-0">{{__('strings.tasks')}}</h3>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <a href="{{url("/new_tasks")}}"><button class="btn btn-sm" style="background-color: #F0827E !important; color: #fff">+ {{__('strings.add_new')}}</button></a>
                        </div>
                    </div>
                </div>

                <!-- Light table -->
                    <div class="container-fluid">
                <div class="table-responsive">
                    @if(count($tasks))
                        <table class="table align-items-center table-flush" >

                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">{{__('strings.task_name')}}</th>
                                    <th scope="col" class="sort" data-sort="name">Ref.#</th>
                                    <th scope="col" class="sort" data-sort="name">{{__('strings.client')}}</th>
                                    <th scope="col" class="sort" data-sort="start">{{__('strings.start_date')}}</th>
                                    <th scope="col" class="sort" data-sort="end">{{__('strings.end_date')}}</th>
                                    <th scope="col" class="sort" data-sort="budget">{{__('strings.time')}}</th>
                                    <th scope="col" class="sort" data-sort="status">{{__('strings.industry')}}</th>
                                    <th scope="col" class="sort" data-sort="status">{{__('strings.estimated_amount')}}</th>
                                    <th scope="col" class="sort" data-sort="status">{{__('strings.status')}}</th>
                                    <th scope="col" class="sort" data-sort="status">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach($tasks as $task)
                                    <tr class="rowParent">
                                        <th scope="row"  style="display: none" data-id="cid">{{$task->id}}</th>
                                        <th scope="row" data-id="name">{{$task->name}}</th>
                                        <th scope="row"  style="display: none" data-id="client_id">{{$task->client_id}}</th>
                                        <th scope="row" data-id="ref_no">{{$task->reference_no ? $task->reference_no: ''}}</th>
                                        <th scope="row" data-id="client">{{$task->client ? $task->client->name : ''}}</th>

                                        <th scope="row" data-id="start">{{$task->start_date}}</th>
                                        <th scope="row" data-id="end">{{$task->end_date}}</th>
                                        <th scope="row" data-id="time">{{$task->time}}</th>
                                        <th scope="row" data-id="type">{{$task->job_type}}</th>
                                        <th scope="row" data-id="type">{{$task->price}} {{$task->currency}}</th>
                                        <th scope="row" data-id="status">{{__('strings.'.strtolower(implode(' ',explode('_',$task->status))))}}</th>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if($task->status == 'open')
                                                    <a class="dropdown-item" href="{{url('/edit_tasks_'.$task->id)}}">{{__('strings.edit')}}</a>
                                                    <a class="dropdown-item" href="{{url('/del_task/'.$task->id)}}">{{__('strings.delete')}}</a>
                                                    @else
                                                        <a class="dropdown-item" href="{{url('/del_task/'.$task->id)}}">{{__('strings.delete')}}</a>
                                                    <a class="dropdown-item" href="{{url('/new_invoice_'.$task->id)}}">{{__('strings.create_invoice_from_task')}}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    @else

                        <table class="table align-items-center table-flush" >
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{__('strings.task_name')}}</th>
                                <th scope="col" class="sort" data-sort="name">{{__('strings.client')}}</th>
                                <th scope="col" class="sort" data-sort="start">{{__('strings.start_date')}}</th>
                                <th scope="col" class="sort" data-sort="end">{{__('strings.end_date')}}</th>
                                <th scope="col" class="sort" data-sort="budget">{{__('strings.time')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('strings.industry')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('strings.estimated_amount')}}</th>
                                <th scope="col" class="sort" data-sort="status">{{__('strings.status')}}</th>
                                <th scope="col" class="sort" data-sort="status">Actions</th>
                            </tr>
                            </thead>

                            <tbody class="list">
                            <tr>
                                <td colspan="100">
                            @if(request()->has('status') || request()->has('client_id'))

                            <p>You currently have 0 {{request()->get('status')}} gigs, <a href="{{url("/tasks")}}"> OK</a></p>
                        @else
                            <p>{{__('strings.dont_have_task')}}, <a href="{{url("/new_tasks")}}">{{__('strings.create_one_here')}}</a></p>
                        @endif
                                </td>
                        </tr>
                            </tbody>
                        </table>

                        @endif
                </div>
            </div>

                <!-- Card footer -->
            </div>
        </div>
    </div>


    <div class="modal" id="editTask" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('edit_task')}}" method="post">

                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="id"  id="id" value="">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="name"  id="name" placeholder="{{__('strings.name')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <select name="client_id" id="client_id" class="form-control" id="">
                                    <option value="">Select Client</option>
                                    @foreach(\App\Client::where('user_id',auth()->id())->get() as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="price"   id="price"  placeholder="{{__('strings.price')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="time"  id="time"  placeholder="{{__('strings.time')}}" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="job_type" id="job_type"  placeholder="{{__('strings.job_type')}}" type="text">
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
            $("#id").val($(this).parents('.rowParent').find("[data-id='cid']").html())
            $("#name").val($(this).parents('.rowParent').find("[data-id='name']").html())
            $("#price").val($(this).parents('.rowParent').find("[data-id='price']").html())
            $('#client_id option[value="'+$(this).parents('.rowParent').find("[data-id='client_id']").html()+'"]').prop('selected', true)

            // $("#client_id").val($(this).parents('.rowParent').find("[data-id='client']").html())
            $("#time").val($(this).parents('.rowParent').find("[data-id='time']").html())
            $("#job_type").val($(this).parents('.rowParent').find("[data-id='type']").html())
        })
    </script>
@endsection
