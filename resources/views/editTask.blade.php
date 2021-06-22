@extends('dashboard',['a' => __('strings.tasks')])
@section('body')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{__('strings.edit_task')}} </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        {{csrf_field()}}
                        <h6 class="heading-small text-muted mb-4">{{__('strings.user_info')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.task_name')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required class="form-control" name="name" value="{{$task->name}}"  id="name" placeholder="{{__('strings.task_name')}}" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.start_date')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required id="invoice__dateDue" class="tdatepicker form-control" value="{{$task->start_date}}"  name="start_date" type="text" placeholder="{{__('strings.yyyy')}}" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.end_date')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required id="invoice__dateDue" class="tdatepicker form-control" name="end_date" value="{{$task->end_date}}"  type="text" placeholder="{{__('strings.yyyy')}}" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                            </div><div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label style="    width: 100%;" class="form-control-label" for="input-first-name">
                                            {{__('strings.clients')}}
                                            <span style="float: right" data-toggle="modal" data-target="#addClient">+ {{__('strings.add_new')}}</span></label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <select required name="client_id" id="client_id" class="form-control" id="">
                                                <option value="">Select Client</option>
                                                @foreach(\App\Client::where('user_id',auth()->id())->get() as $client)
                                                    <option value="{{$client->id}}" {{$task->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.estimated_time')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required class="form-control" value="{{$task->time}}"  name="time"  id="time"  placeholder="{{__('strings.time')}}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.industry')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <select data-value="{{$task->job_type}}" required name="job_type" id="job_type" class="form-control" >
                                                <option value="">Select Industry</option>
                                                <option value="Industry 1" {{$task->job_type == "Industry 1" ? "selected" : ""}}>Industry 1</option>
                                                <option value="Industry 2"  {{$task->job_type == "Industry 2" ? "selected" : ""}}>Industry 2</option>
                                                <option value="Other" {{$task->job_type == "Other" ? "selected" : ""}}> Other</option>
                                                <option value="Fotograf" {{$task->job_type == "Fotograf" ? "selected" : ""}}>Fotograf</option>
                                                <option value="Skuespiller" {{$task->job_type == "Skuespiller" ? "selected" : ""}} >Skuespiller</option>
                                                <option value="Model" {{$task->job_type == "Model" ? "selected" : ""}} >Model</option>
                                                <option value="Danser" {{$task->job_type == "Danser" ? "selected" : ""}} >Danser</option>
                                                <option value="Runner" {{$task->job_type == "Runner" ? "selected" : ""}} >Runner</option>
                                                <option value="Produktionsassistent" {{$task->job_type == "Produktionsassistent" ? "selected" : ""}} >Produktionsassistent</option>
                                                <option value="Stylist" {{$task->job_type == "Stylist" ? "selected" : ""}} >Stylist</option>
                                                <option value="Lysmester" {{$task->job_type == "Lysmester" ? "selected" : ""}} >Lysmester</option>
                                                <option value="Indspilningsleder" {{$task->job_type == "Indspilningsleder" ? "selected" : ""}} >Indspilningsleder</option>
                                                <option value="Scenograf" {{$task->job_type == "Scenograf" ? "selected" : ""}} >Scenograf</option>
                                                <option value="Assistent" {{$task->job_type == "Assistent" ? "selected" : ""}} >Assistent</option>
                                                <option value="Tonemester" {{$task->job_type == "Tonemester" ? "selected" : ""}} >Tonemester</option>
                                                <option value="Instruktør" {{$task->job_type == "Instruktør" ? "selected" : ""}} >Instruktør</option>
                                                <option value="Forfatter" {{$task->job_type == "Forfatter" ? "selected" : ""}} >Forfatter</option>
                                                <option value="Sminkør" {{$task->job_type == "Sminkør" ? "selected" : ""}} >Sminkør</option>
                                                <option value="Frisør" {{$task->job_type == "Frisør" ? "selected" : ""}} >Frisør</option>
                                                <option value="Klipper" {{$task->job_type == "Klipper" ? "selected" : ""}} >Klipper</option>
                                                <option value="Musiker" {{$task->job_type == "Musiker" ? "selected" : ""}} >Musiker</option>
                                                <option value="Location scout" {{$task->job_type == "Location scout" ? "selected" : ""}} >Location scout</option>
                                                <option value="Producer" {{$task->job_type == "Producer" ? "selected" : ""}} >Producer</option>
                                                <option value="Oversætter/Tolk" {{$task->job_type == "Oversætter/Tolk" ? "selected" : ""}} >Oversætter/Tolk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div><div class="row">
                                <div class="col-lg-4">

                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.task_price')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required class="form-control" name="price" value="{{$task->price}}" id="price"  placeholder="{{__('strings.task_price')}}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.currency')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">


                                            <select name="currency" id="" class="form-control" >
                                                <option value="AED">AED (.د.إ)</option>

                                                <option value="AFN">AFN (؋)</option>

                                                <option value="ALL">ALL (L)</option>

                                                <option value="AMD">AMD (դր.)</option>

                                                <option value="ANG">ANG (ƒ)</option>

                                                <option value="AOA">AOA ()</option>

                                                <option value="ARS">ARS ($)</option>

                                                <option value="AUD">AUD ($)</option>

                                                <option value="AWG">AWG (ƒ)</option>

                                                <option value="AZN">AZN (₼)</option>

                                                <option value="BAM">BAM (KM)</option>

                                                <option value="BBD">BBD ($)</option>

                                                <option value="BDT">BDT ()</option>

                                                <option value="BGN">BGN (лв)</option>

                                                <option value="BIF">BIF ()</option>

                                                <option value="BMD">BMD ($)</option>

                                                <option value="BND">BND ($)</option>

                                                <option value="BOB">BOB (Bs.)</option>

                                                <option value="BRL">BRL (R$)</option>

                                                <option value="BSD">BSD ($)</option>

                                                <option value="BWP">BWP (P)</option>

                                                <option value="BZD">BZD (BZ$)</option>

                                                <option value="CAD">CAD ($)</option>

                                                <option value="CDF">CDF ()</option>

                                                <option value="CHF">CHF (CHF)</option>

                                                <option value="CLP">CLP ($)</option>

                                                <option value="CNY">CNY (元)</option>

                                                <option value="COP">COP ($)</option>

                                                <option value="CRC">CRC (₡)</option>

                                                <option value="CVE">CVE ()</option>

                                                <option value="CZK">CZK (Kč)</option>

                                                <option value="DJF">DJF ()</option>

                                                <option value="DKK" selected>DKK (kr)</option>

                                                <option value="DOP">DOP (RD$)</option>

                                                <option value="DZD">DZD (.د.ج)</option>

                                                <option value="EGP">EGP (£)</option>

                                                <option value="ETB">ETB ()</option>

                                                <option value="EUR">EUR (€)</option>

                                                <option value="FJD">FJD ($)</option>

                                                <option value="FKP">FKP (£)</option>

                                                <option value="GBP">GBP (£)</option>

                                                <option value="GEL">GEL ()</option>

                                                <option value="GIP">GIP (£)</option>

                                                <option value="GMD">GMD ()</option>

                                                <option value="GNF">GNF ()</option>

                                                <option value="GTQ">GTQ (Q)</option>

                                                <option value="GYD">GYD ($)</option>

                                                <option value="HKD">HKD ($)</option>

                                                <option value="HNL">HNL (L)</option>

                                                <option value="HRK">HRK (kn)</option>

                                                <option value="HTG">HTG ()</option>

                                                <option value="HUF">HUF (Ft)</option>

                                                <option value="IDR">IDR (Rp)</option>

                                                <option value="ILS">ILS (₪)</option>

                                                <option value="INR">INR (₹)</option>

                                                <option value="ISK">ISK (kr)</option>

                                                <option value="JMD">JMD (J$)</option>

                                                <option value="JPY">JPY (¥)</option>

                                                <option value="KES">KES (KSh)</option>

                                                <option value="KGS">KGS (сом)</option>

                                                <option value="KHR">KHR (៛)</option>

                                                <option value="KMF">KMF ()</option>

                                                <option value="KRW">KRW (₩)</option>

                                                <option value="KYD">KYD ($)</option>

                                                <option value="KZT">KZT (₸)</option>

                                                <option value="LAK">LAK (₭)</option>

                                                <option value="LBP">LBP (£)</option>

                                                <option value="LKR">LKR (₨)</option>

                                                <option value="LRD">LRD ($)</option>

                                                <option value="LSL">LSL ()</option>

                                                <option value="MAD">MAD (.د.م)</option>

                                                <option value="MDL">MDL ()</option>

                                                <option value="MGA">MGA ()</option>

                                                <option value="MKD">MKD (ден)</option>

                                                <option value="MMK">MMK ()</option>

                                                <option value="MNT">MNT (₮)</option>

                                                <option value="MOP">MOP ()</option>

                                                <option value="MRO">MRO ()</option>

                                                <option value="MUR">MUR (₨)</option>

                                                <option value="MVR">MVR ()</option>

                                                <option value="MWK">MWK ()</option>

                                                <option value="MXN">MXN ($)</option>

                                                <option value="MYR">MYR (RM)</option>

                                                <option value="MZN">MZN (MT)</option>

                                                <option value="NAD">NAD ($)</option>

                                                <option value="NGN">NGN (₦)</option>

                                                <option value="NIO">NIO (C$)</option>

                                                <option value="NOK">NOK (kr)</option>

                                                <option value="NPR">NPR (₨)</option>

                                                <option value="NZD">NZD ($)</option>

                                                <option value="PAB">PAB (B/.)</option>

                                                <option value="PEN">PEN (S/)</option>

                                                <option value="PGK">PGK ()</option>

                                                <option value="PHP">PHP (₱)</option>

                                                <option value="PKR">PKR (₨)</option>

                                                <option value="PLN">PLN (zł)</option>

                                                <option value="PYG">PYG (Gs)</option>

                                                <option value="QAR">QAR (﷼)</option>

                                                <option value="RON">RON (lei)</option>

                                                <option value="RSD">RSD (Дин.)</option>

                                                <option value="RUB">RUB (₽)</option>

                                                <option value="RWF">RWF ()</option>

                                                <option value="SAR">SAR (﷼)</option>

                                                <option value="SBD">SBD ($)</option>

                                                <option value="SCR">SCR (₨)</option>

                                                <option value="SEK">SEK (kr)</option>

                                                <option value="SGD">SGD ($)</option>

                                                <option value="SHP">SHP (£)</option>

                                                <option value="SLL">SLL ()</option>

                                                <option value="SOS">SOS (S)</option>

                                                <option value="SRD">SRD ($)</option>

                                                <option value="STD">STD ()</option>

                                                <option value="SVC">SVC ($)</option>

                                                <option value="SZL">SZL ()</option>

                                                <option value="THB">THB (฿)</option>

                                                <option value="TJS">TJS ()</option>

                                                <option value="TOP">TOP ()</option>

                                                <option value="TRY">TRY (₺)</option>

                                                <option value="TTD">TTD (TT$)</option>

                                                <option value="TWD">TWD (NT$)</option>

                                                <option value="TZS">TZS (TSh)</option>

                                                <option value="UAH">UAH (₴)</option>

                                                <option value="UGX">UGX (USh)</option>

                                                <option value="USD" >USD ($)</option>

                                                <option value="UYU">UYU ($U)</option>

                                                <option value="UZS">UZS (so’m)</option>

                                                <option value="VND">VND (₫)</option>

                                                <option value="VUV">VUV ()</option>

                                                <option value="WST">WST ()</option>

                                                <option value="XAF">XAF ()</option>

                                                <option value="XCD">XCD ($)</option>

                                                <option value="XOF">XOF ()</option>

                                                <option value="XPF">XPF ()</option>

                                                <option value="YER">YER (﷼)</option>

                                                <option value="ZAR">ZAR (R)</option>

                                                <option value="ZMW">ZMW ()</option>

                                            </select>

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group m-form__group">
                                <label class="form-control-label" for="exampleTextarea">
                                    Add a message to your client
                                </label>
                                <textarea class="form-control m-input m-input--solid" name="client_msg"  id="exampleTextarea" rows="3">{{$task->client_msg}}</textarea>
                            </div><div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.terms_conditions')}}</label>
                                        <div class="form-check well">
                                            <input style="visibility: visible !important;" type="checkbox" checked required class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Accept terms & conditions</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <p>
                                        I hereby confirm and accept the regular Terms & Conditions by creating this
                                        task and state that the information provided is correct and the following task shall be
                                        invoiced and paid out by Spacedive.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button  value="0" name="is_draft" class="btn btn-lg btn-primary" style="background-color: #F0827E !important;border: none">{{__('strings.update_task')}}</button>
                                <button value="1" name="is_draft" class="btn btn-lg btn-info" style="background-color: #F0827E !important;border: none">{{__('strings.update')}}</button>

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

        $( document ).ready(function() {
            console.log($("#job_type").val())
            if($("#job_type").val() == ""){
                var temp = $("#job_type").data('value')
                $("#job_type").append('<option selected value="'+ temp +'">'+ temp +'</option>')
            }        });
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
