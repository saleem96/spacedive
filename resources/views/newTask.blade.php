@extends('dashboard',['a' => __('strings.tasks')])
@section('body')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h3 class="mb-0">{{__('strings.create_gig')}} </h3>
                        </div>
                        <div class="">
                             {{$reference_no}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="hidden" name="reference_no" value="{{$reference_no}}">
                        {{csrf_field()}}

                        <h6 class="heading-small text-muted mb-4">{{__('strings.user_info')}}</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-4">
                                <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.task_name')}}</label>
                                    <div class="input-group input-group-merge input-group-alternative">

                                        <input required class="form-control" name="name"  id="name" placeholder="{{__('strings.gig_place')}}" type="text">
                                    </div>
                                </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                            <label class="form-control-label" for="input-first-name">{{__('strings.start_date')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required id="invoice__dateDue" class="tdatepicker form-control" name="start_date" type="text" placeholder="{{__('strings.yyyy')}}" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                            <label class="form-control-label" for="input-first-name">{{__('strings.end_date')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required id="invoice__dateDue" class="tdatepicker form-control" name="end_date" type="text" placeholder="{{__('strings.yyyy')}}" autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                            </div><div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                            <label style="    width: 100%;" class="form-control-label" for="input-first-name">
                                                {{__('strings.clients')}}

                                                <span class="btn btn-sm " style="background-color: #F0827E;margin-left: 5px;color:#fff;float: right"  data-toggle="modal" data-target="#addClient">+ {{__('strings.add_new1')}}</span></label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <select required name="client_id" id="client_id" class="form-control" id="">
                                                <option value="">{{__('strings.select')}} {{__('strings.client')}}</option>
                                                @foreach(\App\Client::where('user_id',auth()->id())->get() as $client)
                                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                     </div>
                                    </div>

                                <div class="col-lg-4">

                                <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.estimated_time')}}</label>
                                    <div class="input-group input-group-merge input-group-alternative">

                                        <input required class="form-control" name="time"  id="time"  placeholder="{{__('strings.time')}}" type="text">
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                            <label class="form-control-label" for="input-first-name">{{__('strings.industry')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <select required name="job_type" id="job_type" class="form-control" id="">
                                                <option value="">{{__('strings.select')}} Type</option>

                                                <option value="other">{{__('strings.other_select')}}</option>
                                                <option value="Fotograf">{{__('strings.Fotograf')}}</option>
                                                <option value="Skuespiller">{{__('strings.Skuespiller')}}</option>
                                                <option value="Model">{{__('strings.Model')}}</option>
                                                <option value="Danser">{{__('strings.Danser')}}</option>
                                                <option value="Runner">{{__('strings.Runner')}}</option>
                                                <option value="Produktionsassistent">{{__('strings.Produktionsassistent')}}</option>
                                                <option value="Stylist">{{__('strings.Stylist')}}</option>
                                                <option value="Lysmester">{{__('strings.Lysmester')}}</option>
                                                <option value="Indspilningsleder">{{__('strings.Indspilningsleder')}}</option>
                                                <option value="Scenograf">{{__('strings.Scenograf')}}</option>
                                                <option value="Assistent">{{__('strings.Assistent')}}</option>
                                                <option value="Tonemester">{{__('strings.Tonemester')}}</option>
                                                <option value="Instruktør">{{__('strings.Instruktør')}}</option>
                                                <option value="Forfatter">{{__('strings.Forfatter')}}</option>
                                                <option value="Sminkør">{{__('strings.Sminkør')}}</option>
                                                <option value="Frisør">{{__('strings.Frisør')}}</option>
                                                <option value="Klipper">{{__('strings.Klipper')}}</option>
                                                <option value="Musiker">{{__('strings.Musiker')}}</option>
                                                <option value="Location scout">{{__('strings.Location_scout')}} </option>
                                                <option value="Producer">{{__('strings.Producer')}}</option>
                                                <option value="Oversætter/Tolk">{{__('strings.Oversætter/Tolk')}}</option>
                                                <option value="Casting Director">{{__('strings.Casting_Director')}}</option>
                                                <option value="Choreograph">{{__('strings.Choreograph')}}</option>
                                                <option value="Social Media">{{__('strings.Social_Media')}}</option>
                                                <option value="PR">{{__('strings.PR')}}</option>
                                                <option value="Grafiker">{{__('strings.Grafiker')}}</option>
                                                <option value="Special_Effects">{{__('strings.Special_Effects')}}</option>
                                                <option value="Rekvisitør">{{__('strings.Rekvisitør')}}</option>
                                                <option value="Set bygger">{{__('strings.Set_bygger')}}</option>
                                                <option value="Script_supervisor">{{__('strings.Script_supervisor')}}</option>
                                                <option value="Gaffer">{{__('strings.Gaffer')}}</option>
                                                <option value="Grip">{{__('strings.Grip')}}</option>
                                                <option value="Tjener">{{__('strings.Tjener')}}</option>
                                                <option value="Kok">{{__('strings.Kok')}}</option>
                                                <option value="Catering">{{__('strings.Catering')}}</option>
                                                <option value="Rengøring">{{__('strings.Rengøring')}}</option>
                                                <option value="Chauffør">{{__('strings.Chauffør')}}</option>
                                                <option value="Alm manuelt">{{__('strings.Alm_manuelt')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div><div class="row">

                                <div class="col-lg-4">

                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.task_price')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input required class="form-control" name="price"  id="price"  placeholder="{{__('strings.amount')}}" type="text">
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

<div class="col-lg-4" id="other_cat" style="display: none">

                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.other')}}</label>
                                        <div class="input-group input-group-merge input-group-alternative">

                                            <input class="form-control" name="other_cat"  placeholder="{{__('strings.other_place')}}" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-form__group">
                                <label class="form-control-label" for="exampleTextarea">
                                    {{__('strings.msg_client')}}
                                </label>
                                <textarea class="form-control m-input m-input--solid" name="client_msg"  id="exampleTextarea" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label class="form-control-label" for="input-first-name">{{__('strings.terms_conditions')}}</label>
                                        <div class="form-check well">
                                            <input style="visibility: visible !important;" type="checkbox" required class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">{{__('strings.accept')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                <p>
                                    {{__('strings.hereby')}}
                                </p>
                            </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button  value="0" name="is_draft" type="submit" class="btn btn-lg btn-primary" id="plan" style="background-color: #5354CE !important; border: none">{{__('strings.update_new')}}</button>
                                <button value="1" name="is_draft" class="btn btn-lg btn-info" style="background-color: #5354CE !important; border: none">{{__('strings.save_draft')}}</button>

                            </div>
                        </div>
                    </form>
                    {{--  <button  class="btn btn-info btn-lg" >Open Modal</button>  --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{URL()->to("update-plan")}}" method="post" enctype="multipart/form-data">
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

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">

              <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">
              <p>  </p>
            </div>
            <div class="modal-footer">
                <button type="submit"  class="btn btn-default" data-dismiss="modal">Submit</button>
              <button type="button"  class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>

        </div>
      </div>

@endsection
@section('script')
    <script>
        $("#job_type").on('change',function(){
            if(this.value == "other"){
                $("#other_cat").show()
            }else{

                $("#other_cat").hide()
            }

        })
        $("#plan").click(function(e) {
            if(!confirm("{{__('strings.alert')}}")) {
                e.preventDefault();
                return false;
            }
        });
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
