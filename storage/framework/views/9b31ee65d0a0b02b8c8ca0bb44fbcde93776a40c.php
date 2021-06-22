<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">

                <div class="card-body pt-0">

                    <div class="text-center">
                        <h5 class="h1">
                            <?php echo e($user->plan ? $user->plan->title : 'None'); ?>

                        </h5>
                        <div class="h4 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Current Plan
                        </div>
                        <div class="h5 mt-4">
                            <a data-toggle="modal" data-target="#plan" ><button class="btn btn-sm btn-info">Upgrade Plan</button></a>
                        </div>
                        <div class="h5 mt-4">
                            <a href="<?php echo e(url('/admin_endplan?id='.$user->id)); ?>" id="end"><button class="btn btn-sm btn-danger">Cancel Subscription</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Edit profile </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                        <?php echo e(csrf_field()); ?>

                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <?php if($user->image): ?>
                                <div class="col-lg-6">
                                    <img src="<?php echo e(url('/images/user/'.$user->image)); ?>" alt="Image placeholder" class="card-img-top">
                                </div>
                                <?php endif; ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Upload Photo</label>
                                        <input type="file" id="input-email" class="form-control" name="image" placeholder="jesse@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">First name</label>
                                        <input type="text" id="input-first-name" class="form-control" placeholder="First name" name="fname" value="<?php echo e($user->fname); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-last-name">Last name</label>
                                        <input type="text" id="input-last-name" class="form-control" placeholder="Last name" name="lname" value="<?php echo e($user->lname); ?>">
                                    </div>
                                </div>
                            </div><div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-city">Gender</label>
                                        <select name="gender" class="form-control" id="">
                                            <option value="male" <?php echo e($user->gender =="male" ? 'selected' : ''); ?>>Male</option>
                                            <option value="female" <?php echo e($user->gender =="female" ? 'selected' : ''); ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username"><?php echo e(__('strings.ssn')); ?></label>
                                        <input type="text" id="input-username" class="form-control" placeholder="<?php echo e(__('strings.ssn')); ?>" name="ssn" value="<?php echo e($user->ssn); ?>">
                                    </div>
                                </div>
                            </div><div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-country">Password</label>
                                        <input type="password" name="password" value="%change-password-key%" id="input-postal-code" class="form-control" placeholder="">
                                    </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Contact Number</label>
                                        <input type="text" name="number" value="<?php echo e($user->number); ?>" id="input-email" class="form-control" placeholder="123123">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Address</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="Address" name="address" value="<?php echo e($user->address); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Street</label>
                                        <input type="text" name="street" value="<?php echo e($user->street); ?>" id="input-email" class="form-control" placeholder="Street">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">zipcode</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="zipcode" name="zipcode" value="<?php echo e($user->zipcode); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">city</label>
                                        <input type="text" name="city" value="<?php echo e($user->city); ?>" id="input-email" class="form-control" placeholder="city">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">country</label>
                                        <input type="text" id="input-username" class="form-control" placeholder="country" name="country" value="<?php echo e($user->country); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email address</label>
                                        <input type="email" name="email" value="<?php echo e($user->email); ?>" id="input-email" class="form-control" placeholder="jesse@example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Credit Card Details -->
                        <h6 class="heading-small text-muted mb-4">Credit Card Details</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="card">Card Number</label>
                                        <input type="text" name="card_number" value="<?php echo e($user->card_number); ?>" id="card" class="form-control" placeholder="Credit Card Number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-cvc">CVC</label>
                                        <input type="text" id="input-cvc" class="form-control" placeholder="CVC" name="cvc" value="<?php echo e($user->cvc); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="month">Expiry Month</label>
                                        <input type="text" name="ex_month" value="<?php echo e($user->ex_month); ?>" id="month" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="year">Expiry Year</label>
                                        <input type="text" name="ex_year" value="<?php echo e($user->ex_year); ?>" id="year" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <!-- Description -->
                        <h6 class="heading-small text-muted mb-4">About me</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Tell is a little about yourself</label>
                                <textarea name="aboutme" rows="4" class="form-control" placeholder="A few words about you ..."><?php echo e($user->aboutme); ?></textarea>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary" style="background-color: #5354CE !important;">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?php echo e(URL()->to("admin_update-plan")); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
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
                                    <?php $__currentLoopData = Plan::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($plan->id); ?>" <?php echo e($plan->id == $user->plan_id ? "selected" : ''); ?>><?php echo e($plan->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo csrf_field(); ?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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

<?php echo $__env->make('admin.dashboard',['a' => 'Profile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/admin/profile.blade.php ENDPATH**/ ?>