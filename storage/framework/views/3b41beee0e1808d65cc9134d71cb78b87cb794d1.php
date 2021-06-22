<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="app">

            <div class="flex flex--wrap flex--justify-space-between m-v-md m-v-lg--tablet m-v-xl--desktop" id="invoice__buttons">


                <a href="javascript:window.print()" >
                    <div class="button button--blue-inverted m-v-sm">
                        <!--                <img src="img/icon_file_sm.svg" width="10" height="10" alt="file" class="m-r-sm">-->
                        <span><?php echo e(__('strings.print')); ?></span>
                    </div>
                </a>


                <div style="flex: 1 0 10px;"></div>
                <?php if(!$invoice->final): ?>

                <button form="invoice__delete" class="invoice__deleteImageFlip button button--blue-inverted button--red-inverted-hover m-v-sm">
                    <!--            <img src="img/icon_delete_sm_blue.svg" width="10" height="10" alt="x" class="m-r-sm">-->
                    <!--            <img src="img/icon_delete_sm_red.svg" width="10" height="10" alt="x" class="m-r-sm display&#45;&#45;none">-->
                    <span><?php echo e(__('strings.delete')); ?></span>
                </button>
                <form class="display--none" id="invoice__delete" action="/delete_invoice_<?php echo e($invoice->id); ?>" method="post" onsubmit="invoiceDeletePrompt(event);" autocomplete="off">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="csrf" value="7777d3f9-3d56-41ff-82b0-b6896fef5359">
                </form>
                <?php endif; ?>
            </div>

            <div id="invoice" method="post" class="card bg-white display--block m-t-md m-t-lg--tablet m-t-xl--desktop m-b-md m-b-lg--tablet" onsubmit="disableSubmitters();">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($invoice->id); ?>">
                <div class="invoice__titles m-v-md m-v-lg--tablet">

                    <div class="m-v-md m-v-lg--tablet">
                        <input type="text" id="reference_no"  value="<?php echo e(isset($invoice->task) ? $invoice->task->reference_no:''); ?>"placeholder="Reference number" class="">
                    </div>
                    <div class="m-v-md m-v-lg--tablet">
                        <input type="text" name="invoice_num" placeholder="" value="<?php echo e($invoice->data->invoice_num); ?>" class="font-size--header blue ">
                    </div>

                    <div>
                        <input id="invoice__description" class="invoice__description invoice__description--input inputBorder p-sm ellipsis" type="text" name="description" value="<?php echo e($invoice->data->description); ?>" placeholder="<?php echo e(__('strings.project_desc')); ?>" maxlength="255" autocomplete="off"
                               onkeypress="disableEnterSubmit(event);">
                    </div>

                </div>

                <div class="invoice__dates m-v-lg">
                    <div class="m-v-md">

                        <div class="gray m-r-sm display--inline--tablet"><?php echo e(__('strings.issued')); ?></div>
                        <input id="invoice__dateIssued" class="inputBorder p-sm" name="date_issued" type="date" placeholder="yyyy-mm-dd" value="<?php echo e($invoice->data->date_issued ? $invoice->data->date_issued : date('Y-m-d')); ?>" autocomplete="off" required onkeypress="disableEnterSubmit(event);"
                               class="display--block display--inline--tablet">

                    </div>


                    <div class="m-v-md">
                        <div class="gray m-r-sm display--inline--tablet"><?php echo e(__('strings.due')); ?></div>
                        <input id="invoice__dateDue" class="inputBorder p-sm" name="date_due" value="<?php echo e($invoice->data->date_due ? $invoice->data->date_due : date('Y-m-d')); ?>" type="date" placeholder="yyyy-mm-dd" autocomplete="off" onkeypress="disableEnterSubmit(event);">
                    </div>

                </div>

                <div class="clear"></div>


                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">

                        <input type="text" id="name"  name="client" placeholder="<?php echo e(__('strings.company_name')); ?>" value="<?php echo e($invoice->data->client); ?>" class="">
                    </div>
                </div>
                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">


                        <input type="text"  id="num" name="reg_num" placeholder="<?php echo e(__('strings.registration_num')); ?>" value="<?php echo e($invoice->data->reg_num); ?>" class="">
                    </div>
                </div>

                <div class="flex flex--start">

                    <div class="m-v-md ">
                        

                        <input type="text" id="ean" name="ean" placeholder="<?php echo e(__('strings.ean')); ?>" value="<?php echo e(isset($invoice->data->ean) ? $invoice->data->ean : ''); ?>" class="">
                    </div>
                </div>
                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">


                        <input type="text" id="address"  name="address" placeholder="<?php echo e(__('strings.billing_address')); ?>" value="<?php echo e($invoice->data->address); ?>" class="">
                    </div>
                </div>
                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">


                        <input type="text" id="cname"  name="contact" placeholder="<?php echo e(__('strings.contact_name')); ?>" value="<?php echo e($invoice->data->contact); ?>" class="">
                    </div>
                </div>
                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">


                        <input type="text"  id="email" name="email" placeholder="<?php echo e(__('strings.email')); ?>" value="<?php echo e($invoice->data->email); ?>" class="">
                    </div>
                </div>
                <div class="flex flex--start">

                    <div class="m-v-md m-v-lg--tablet">


                        <input type="text"  id="phone" name="phone" placeholder="<?php echo e(__('strings.phone')); ?>"  value="<?php echo e($invoice->data->phone); ?>" class="">
                    </div>
                </div>



                <ul class="invoice__expenses display--table fullWidth fullWidth--max m-t-lg m-t-xl--tablet">
                    <li class="gray display--table-row">
                        <span class="expense__colDesc display--table-cell left"><?php echo e(__('strings.desc')); ?></span>
                        <span class="expense__colQty display--table-cell right"><?php echo e(__('strings.qty')); ?>.</span>
                        <span class="expense__colPrice display--table-cell right"><?php echo e(__('strings.price')); ?></span><span
                            class="expense__colTotal display--table-cell right"><?php echo e(__('strings.total')); ?></span>
                    </li>
                </ul>
                <div>
                    <?php
                    ?>
                    <script>  expenseData = [
                        ];
                         </script>
                    <?php if(isset($invoice->data->tax1percent) ): ?>
                        <script>
                            tax1Data = {
                                percent: "<?php echo e($invoice->data->tax1percent); ?>",
                                description: "",
                            };</script>
                    <?php endif; ?>
                    <?php $__currentLoopData = $invoice->data->exp_desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <script>
                            expenseData.push({
                                description: "<?php echo e($desc); ?>",
                                quantity: "<?php echo e($invoice->data->exp_quan[$loop->index]); ?>",
                                value: "<?php echo e($invoice->data->exp_val[$loop->index]); ?>"
                                },
                            )
                        </script>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <div id="expenses">

                </div>

                <div class="clear"></div>

                <div class="m-v-md m-v-lg--tablet">

                    <textarea id="invoice__notes" name="notes"  class="textarea--v p-sm borderBox fullWidth" placeholder="Notes..." autocomplete="off" maxlength="2000" oninput="autosizeTextarea.bind(this, event)();"><?php echo e($invoice->data->notes); ?></textarea>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label class="form-control-label" for="input-first-name"> <?php echo e(__('strings.holiday')); ?></label>
                            <div class="form-check well">
                                <input style="visibility: visible !important;" type="checkbox" class="form-check-input" <?php echo e(($invoice->holiday=="1")? "checked" : ""); ?>  id="exampleCheck1" name="holiday" value="1">
                                <label class="form-check-label" for="exampleCheck1"> <?php echo e(__('strings.pay_holiday')); ?> </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                    <p>
                        <?php echo e(__('strings.invoice_info')); ?>

                    </p>
                </div>
             </div>




                <hr/>

                <section class="flex flex--baseline flex--wrap flex--justify-space-between m-t-lg m-t-xl--tablet m-b-md">
                    <div class="details__column flex__grow flex flex--baseline">
            <span>
                <label for="invoice__currency" class="gray m-r-sm"><?php echo e(__('strings.currency')); ?></label>
                <select id="invoice__currency" name="currency" class="m-r-md">

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
            </span>
                        <div class="flex__grow"></div>
                    </div>


                    <div class="flex__grow details__gutter" style="display: none">

                        <div class="details__column flex__basis0 flex__grow flex flex--baseline invoice__submitContainer">
                            <input type="reset" id="invoice__cancelSubmit" class="button button--gray-inverted gray display--none m-r-md invoice_submit_button" value="Cancel">
                            <div class="flex__grow"></div>
                            <button id="invoice_ubmit" class="button button--blue right invoice_submit_button" name="submit" value="draft" form="invoice" type="submit">Save as draft</button>
                            <button id="invoice__submit" class="button button--blue right invoice_submit_button"  name="submit" value="send" form="invoice" type="submit">Send to Spacedive</button>
                        </div>

                    </div>


                </section>

            </div>

            


            <div>
                <input type="checkbox" id="invoiceNumberChange_show" autocomplete="off" class="modalToggle">
                <label class="modalCloser" for="invoiceNumberChange_show"></label>
                <div class="modal">
                    <div class="modal__content">
                        <h2>Change Invoice Number</h2>

                        <form id="invoice_change_number" action="/invoices/104/number" method="post" onsubmit="disableSubmitters();" autocomplete="off">
                            <input type="hidden" name="csrf" value="7777d3f9-3d56-41ff-82b0-b6896fef5359">
                            <p>You may change the number of this invoice, but no two invoices may share the same number.</p>
                            <div>
                                <input type="number" step="1" inputmode="numeric" class="inputBorder p-sm" min="0" max="999999999" placeholder="Number" name="number" value="104">
                            </div>
                            <div class="m-t-md">
                                <button class="button button--blue" form="invoice_change_number">Change Number</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div>
                <input type="checkbox" id="sendModal_show" autocomplete="off" class="modalToggle">
                <label class="modalCloser" for="sendModal_show"></label>
                <div class="modal">
                    <div class="modal__content">
                        <h2>Send</h2>

                        <form id="invoice_send" action="/invoices/104/send" method="post" onsubmit="disableSubmitters();" autocomplete="off">
                            <input type="hidden" name="csrf" value="7777d3f9-3d56-41ff-82b0-b6896fef5359">
                            <div class="float-right"><a href="/clients/24215" class="underline blue">Edit / Add Contacts</a></div>
                            <p>Ahmed</p>
                            <div class="clear"></div>


                            <hr class="hr">
                            <a href="/clients/24215">
                                <div class="m-v-md center">
                                    <!--                            <img width="16" height="16" src="img/icon_warning.svg">-->
                                    <div class="red m-b-sm bold">Warning</div>
                                    <div class="red m-b-md">This invoice wont be sent to anyone unless some contacts are added first.</div>
                                </div>
                            </a>
                            <hr class="hr">

                        </form>

                        <div class="flex m-t-md m-t-lg--tablet">
                            <form class="display--none" id="invoice_markAsSent" action="/invoices/104/send?soft" method="post" onsubmit="disableSubmitters();" autocomplete="off">
                                <input type="hidden" name="csrf" value="7777d3f9-3d56-41ff-82b0-b6896fef5359">
                            </form>
                            <button class="button button--blue-inverted" form="invoice_markAsSent">Mark as Sent</button>
                            <span class="flex__grow"></span>
                            <button class="button button--blue" form="invoice_send" id="invoice_send_button" disabled>Send</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.my_invoices')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/invoiceView.blade.php ENDPATH**/ ?>