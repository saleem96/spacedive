@extends('admin.dashboard',['a' => __('strings.tasks')])
@section('body')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">View Gig</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>User</td>
                            <td>{{$task->user->fname . ' ' . $task->user->lname}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.task_name')}}</td>
                            <td>{{$task->name}}</td>
                        </tr>
                        <tr>
                            <td>Ref.#</td>
                            <td>{{$task->reference_no?$task->reference_no:''}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.start_date')}}</td>
                            <td>{{$task->start_date}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.end_date')}}</td>
                            <td>{{$task->end_date}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.clients')}}</td>
                            <td>{{$task->client->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.estimated_time')}}</td>
                            <td>{{$task->time}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.industry')}}</td>
                            <td>{{$task->job_type}}</td>
                        </tr>
                        <tr>
                            <td>{{__('strings.task_price')}}</td>
                            <td>{{$task->price}}</td>
                        </tr>
                        <tr>
                            <td>message to your client</td>
                            <td>{{$task->client_msg}}</td>
                        </tr>
                    </table>

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
