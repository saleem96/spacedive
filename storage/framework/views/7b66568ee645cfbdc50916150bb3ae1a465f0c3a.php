<?php $__env->startSection('body'); ?>
    <div class="row">
        
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0"><?php echo e(__('strings.contact_us')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="pl-lg-6">
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label"><?php echo e(__('strings.need_help')); ?></label>
                                    <textarea name="aboutme" rows="4" class="form-control" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary" style="background-color: #5354CE !important;">Send</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => 'Support'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/support.blade.php ENDPATH**/ ?>