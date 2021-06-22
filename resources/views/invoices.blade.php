@extends('dashboard',['a' => __('strings.my_invoices')])
@section('body')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
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
                               <label class="form-control-label" for="input-city">{{__('strings.invoice_type')}}</label>
                               <select name="type" class="form-control" id="">
                                   <option value="">{{__('strings.select')}} Type</option>
                                   <option value="pending">{{__('strings.Pending')}}</option>
                                   <option value="send">{{__('strings.Send')}}</option>
                                   <option value="paid">{{__('strings.Paid')}}</option>
                                   <option value="overdue">{{__('strings.Overdue')}}</option>
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
                <div class="card-header border-0">
                    <h3 class="mb-0">{{__('strings.invoices')}}</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Sr#</th>
                            <th scope="col" class="sort" data-sort="name">{{__('strings.invoice_no')}}.</th>
                            <th scope="col" class="sort" data-sort="name">Ref.#</th>
                            <th scope="col" class="sort" data-sort="budget">{{__('strings.client')}}</th>
                            <th scope="col" class="sort" data-sort="budget">Gig</th>
                            <th scope="col" class="sort" data-sort="status">{{__('strings.total')}}</th>
                            <th scope="col" class="sort" data-sort="status">{{__('strings.status')}}</th>
                            <th scope="col" class="sort" data-sort="status">{{__('strings.due')}}</th>
                                <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">
                                    {{$loop->index+1}}
                                </th>
                                <td class="budget">

                                    <a href="{{url('/invoice_'.$invoice->id)}}">{{$invoice->invoice_num}}</a>
                                </td>
                                <td class="budget">
                                    {{$invoice->task?$invoice->task->reference_no:''}}
                                </td>
                                <td class="budget">
                                    {{$invoice->client}}
                                </td>

                                <td class="budget">
                                    {{$invoice->task ? $invoice->task->name : ""}}
                                </td>
                                <td class="budget">
                                    {{$invoice->total}} {{ $invoice->task?$invoice->task->currency:'' }}
                                </td>
                                <td class="budget">
                                    {{__('strings.'.ucwords($invoice->status))}}
                                </td>
                                <td class="budget">
                                    {{json_decode($invoice->data)->date_due}}
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{url('/invoice_'.$invoice->id)}}">{{__('strings.view')}}</a>
                                            @if(!$invoice->final)
                                            <a class="dropdown-item" href="{{url('/edit_invoice_'.$invoice->id)}}">{{__('strings.edit')}}</a>
                                            <a class="dropdown-item" href="#">{{__('strings.delete')}}</a>
                                            @endif
                                        </div>
                                    </div>
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


@endsection
