@extends('admin.dashboard',['a' => 'Deleted Users'])
@section('body')
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Deleted Users</h3>
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
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($users as $user)
                            <tr class="rowParent">
                                <th scope="row"   data-id="cid">{{$user->fname . ' ' . $user->lname}}</th>
                                <th scope="row"   data-id="cid">{{$user->email}}</th>
                                <th scope="row"   data-id="cid">{{$user->number}}</th>
                                <th scope="row"   data-id="cid">{{$user->plan ? $user->plan->title : ''}}</th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view{{$user->id}}">View</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
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
                                                    <span class="font-weight-normal  text-center ">{{$user->plan ? $user->plan->title : ""}}</span>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="text-primary">number : </label>
                                                    <span class="font-weight-normal  text-center ">{{$user->number}}</span>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class="text-primary">dob : </label>
                                                    <span class="font-weight-normal  text-center ">{{$user->dob}}</span>
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
                        </tbody>
                    </table>
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
