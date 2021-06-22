<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <form action="">
                   <div class="row">
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city">Clients</label>
                               <select name="client_id" class="form-control" id="">
                                   <option value="">Select Client</option>
                                   <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city">Users</label>
                               <select name="user_id" class="form-control" id="">
                                   <option value="">Select User</option>
                                   <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($client->id); ?>"><?php echo e($client->email); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city">Invoice Type</label>
                               <select name="type" class="form-control" id="">
                                   <option value="">Select Type</option>
                                   <option value="draft">Drafts</option>
                                   <option value="pending">Pending</option>
                                   <option value="send">Send</option>
                                   <option value="paid">Paid</option>
                                   <option value="overdue">Overdue</option>
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
                <div class="card-header border-0">
                    <h3 class="mb-0">Invoices</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Sr#</th>
                            <th scope="col" class="sort" data-sort="name">Invoice No.</th>
                            <th scope="col" class="sort" data-sort="budget">Ref.#</th>
                            <th scope="col" class="sort" data-sort="budget">Client</th>
                            <th scope="col" class="sort" data-sort="status">Total</th>
                            <th scope="col" class="sort" data-sort="status">Status</th>
                            <th scope="col" class="sort" data-sort="status">Due Date</th>
                            <th scope="col" class="sort" data-sort="status">Holiday Allowance</th>
                            <th scope="col" class="sort" data-sort="status">Created from Gig</th>
                            <th scope="col" class="sort" data-sort="status">Created By</th>
                                <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="rowParent">
                                <th scope="row"  style="display: none" data-id="cid"><?php echo e($invoice->id); ?></th>
                                <th scope="row">
                                    <?php echo e($loop->index+1); ?>

                                </th>
                                <td class="budget">
                                    <a href="<?php echo e(url('/admin_invoice_'.$invoice->id)); ?>"><?php echo e($invoice->invoice_num); ?></a>
                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->task?$invoice->task->reference_no:''); ?>

                                </td>
                                <th scope="row" onMouseOver="this.style.color='#2162ef'"  onMouseOut="this.style.color='#525f7f'" style="cursor: pointer" data-id="client" data-toggle="modal" data-target="#client<?php echo e($invoice->id); ?>"><?php echo e($invoice->client ? $invoice->client : ''); ?></th>

                                <td class="budget">
                                    <?php echo e($invoice->total); ?> <?php echo e(json_decode($invoice->data)->currency); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e(ucwords($invoice->status)); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e(json_decode($invoice->data)->date_due); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->holiday ? "Yes" : "No"); ?>

                                </td>
                                <td class="budget">
                                    <?php echo $invoice->task ? '<a href="/admin_task_'.$invoice->task->id.'">View Gig</a>' : 'No'; ?>

                                </td>
                                <td class="budget">
                                    <a target="_blank" href="<?php echo e(url('admin_profile_'.$invoice->user_id)); ?>"> <?php echo e($invoice->user ? $invoice->user->email : ''); ?></a>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?php echo e(url('/admin_invoice_'.$invoice->id)); ?>">View</a>
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#editClient">Update Status</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php if($invoice->client_detail): ?>
                            <div class="modal" id="client<?php echo e($invoice->id); ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Client</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                                        <input type="hidden" name="id"  id="id" value="">
                                        <div class="modal-body">
                                            <div>
                                                <span style="margin-right: 10px">Company Name : </span>
                                                <?php echo e($invoice->client_detail->name); ?>

                                            </div>
                                            <div>
                                                <span style="margin-right: 10px">Registration Number : </span>
                                                <?php echo e($invoice->client_detail->num); ?>

                                            </div>
                                            <div>
                                                <span style="margin-right: 10px">Billing Address : </span>
                                                <?php echo e($invoice->client_detail->address); ?>

                                            </div>
                                            <div>
                                                <span style="margin-right: 10px">Contact Name : </span>
                                                <?php echo e($invoice->client_detail->cname); ?>

                                            </div>
                                            <div>
                                                <span style="margin-right: 10px">Company Email : </span>
                                                <?php echo e($invoice->client_detail->email); ?>

                                            </div>
                                            <div>
                                                <span style="margin-right: 10px">Company Phone : </span>
                                                <?php echo e($invoice->client_detail->phone); ?>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('strings.close')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
            </div>
        </div>
    </div>
    <div class="modal" id="editClient" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(url('admin_invoice_status')); ?>" method="post">

                    <input type="hidden" id="idd" name="id">
                    <input type="hidden" id="" name="user_id" value="<?php echo e(auth()->id()); ?>">
                    <input type="hidden" id="invoice_id" name="invoice_id" value="">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-control-label" for="input-city">Invoice Type</label>
                            <select name="invoice_type" class="form-control" id="">
                                <option value="">Select Type</option>
                                <option value="pending">Pending</option>
                                <option value="send">Send</option>
                                <option value="paid">Paid</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(".editBtn").click(function(){
            $("#invoice_id").val($(this).parents('.rowParent').find("[data-id='cid']").html())
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard',['a' => 'Invoices'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/admin/invoices.blade.php ENDPATH**/ ?>