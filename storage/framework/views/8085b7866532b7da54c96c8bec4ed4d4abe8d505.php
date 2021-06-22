<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"><?php echo e(__('strings.my_drafts')); ?></h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive" style="min-height: 200px">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Sr#</th>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.invoice_no')); ?>.</th>
                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.client')); ?></th>
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
                                    <?php echo e($invoice->client); ?>

                                </td>
                                <td class="budget">
                                    <?php echo e($invoice->total); ?>

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
                                            <?php endif; ?>
                                            <a class="delInvoice dropdown-item" href="<?php echo e(url('/delete_invoice_'.$invoice->id)); ?>"><?php echo e(__('strings.delete')); ?></a>
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
<?php $__env->startSection('script'); ?>
    <script>

        $(".delInvoice").click(function(e) {
            if(!confirm('Are you sure you want to delete this invoice?')) {
                e.preventDefault();
                return false;
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.my_drafts')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/draftinvoices.blade.php ENDPATH**/ ?>