<?php $__env->startSection('body'); ?>
    <style>
        .li-plan{

            line-height: 2;
            border-bottom: 1px #f3f3f3 solid;
        }
    </style>
    <div class="row">
        <!------ Include the above in your HEAD tag ---------->


        <div class="container mb-5 mt-5">
            <div class="pricing card-deck flex-column flex-md-row mb-3">
                <div class="col-lg-12">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->index % 2 == 0 ): ?>
                            <div class="row">
                                <?php endif; ?>
                                <div class="col-lg-5 card card-pricing popular shadow text-center px-3 mb-4">
                                    <span class=" w-60 mx-auto px-4 py-1  bg-primary text-white shadow-sm"><?php echo e($plan->title); ?></span>
                                    <div class="bg-transparent card-header pt-4 border-0">
                                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="45">Kr.<span class="price"><?php echo e($plan->amount); ?></span><span class="h6 text-muted ml-2">/ <?php echo e(__('strings.per_month')); ?></span></h1>
                                    </div>
                                    <div class="card-body pt-0">
                                        <ul class="list-unstyled mb-4">
                                            <?php $__currentLoopData = explode(',',$plan->lists); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="li-plan"><?php echo e(__('strings.'.trim($list))); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <?php if($plan->id != 1): ?>
                                            <a href="<?php echo e(url('/payment-'.$plan->id)); ?>"  class="btn btn-primary mb-3"><?php echo e(__('strings.order_now')); ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if($loop->index % 2 != 0 ): ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.plan_payment')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/plans2.blade.php ENDPATH**/ ?>