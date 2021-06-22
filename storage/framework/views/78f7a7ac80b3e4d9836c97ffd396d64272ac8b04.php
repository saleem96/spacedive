<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <form action="">
                   <div class="row">
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city"><?php echo e(__('strings.clients')); ?></label>
                               <select name="client_id" class="form-control" id="">
                                   <option value=""><?php echo e(__('strings.select')); ?> <?php echo e(__('strings.client')); ?></option>
                                   <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                           </div>
                       </div>
                       <div class="col-lg-3">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city"><?php echo e(__('strings.invoice_type')); ?></label>
                               <select name="type" class="form-control" id="">
                                   <option value=""><?php echo e(__('strings.select')); ?> Type</option>
                                   <option value="pending"><?php echo e(__('strings.Pending')); ?></option>
                                   <option value="send"><?php echo e(__('strings.Send')); ?></option>
                                   <option value="paid"><?php echo e(__('strings.Paid')); ?></option>
                                   <option value="overdue"><?php echo e(__('strings.Overdue')); ?></option>
                               </select>
                           </div>
                       </div>
                       <div class="col-lg-2">
                           <div class="form-group">
                               <label class="form-control-label" for="input-city"> </label>
                               <button class="btn btn-lg btn-primary form-control" name="subBtn" style="background-color: #5354CE !important;"><?php echo e(__('strings.update')); ?> </button>
                           </div>
                       </div>
                   </div>
                </form>
                <div class="card-header border-0">
                    <h3 class="mb-0"><?php echo e(__('strings.invoices')); ?></h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Sr#</th>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.invoice_no')); ?>.</th>
                            <th scope="col" class="sort" data-sort="name">Ref.#</th>
                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.client')); ?></th>
                            <th scope="col" class="sort" data-sort="budget">Gig</th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.total')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.status')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.due')); ?></th>
                                <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row">
                                    <?php echo e($loop->index+1); ?>

                                </th>
                                <td class="budget">

                                    <a href="<?php echo e(url('/invoice_'.$invoice->id)); ?>"><?php echo e($invoice->invoice_num); ?></a>
                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->task?$invoice->task->reference_no:''); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->client); ?>

                                </td>

                                <td class="budget">
                                    <?php echo e($invoice->task ? $invoice->task->name : ""); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->total); ?> <?php echo e($invoice->task?$invoice->task->currency:''); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e(__('strings.'.ucwords($invoice->status))); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e(json_decode($invoice->data)->date_due); ?>

                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?php echo e(url('/invoice_'.$invoice->id)); ?>"><?php echo e(__('strings.view')); ?></a>
                                            <?php if(!$invoice->final): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('/edit_invoice_'.$invoice->id)); ?>"><?php echo e(__('strings.edit')); ?></a>
                                            <a class="dropdown-item" href="#"><?php echo e(__('strings.delete')); ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.my_invoices')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/invoices.blade.php ENDPATH**/ ?>