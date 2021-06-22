<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <form action="">
                    <div class="row col-lg-12">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Plans</label>
                                <select name="plan_id" class="form-control" id="">
                                    <option value="">All users</option>
                                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($plan_id == $plan->id ? "selected":''); ?> value="<?php echo e($plan->id); ?>"><?php echo e($plan->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button class="btn btn-lg btn-primary form-control" name="subBtn" value="submit" style="background-color: #5354CE !important;">Update</button>
                            </div>
                        </div>
                        <div class=" col-lg-2 pull-right">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city"> </label>
                                <button type="submit" value="admin_export_users" class="btn btn-sm btn-success form-control" name="subBtn"  style="background-color: #5354CE !important;">Export Users</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">Users</h3>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">Name</th>
                            <th scope="col" class="sort" data-sort="name">Email</th>
                            <th scope="col" class="sort" data-sort="name">Number</th>
                            <th scope="col" class="sort" data-sort="name">Plan Name</th>
                            <th scope="col" class="sort" data-sort="name">Created At</th>
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="rowParent">

                                <th scope="row"   data-id="cid"> <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view<?php echo e($user->id); ?>"><?php echo e($user->fname . ' ' . $user->lname); ?></a></th>
                                <th scope="row"   data-id="cid"><?php echo e($user->email); ?></th>
                                <th scope="row"   data-id="cid"><?php echo e($user->number); ?></th>
                                <th scope="row"   data-id="cid"><?php echo e($user->plan ? $user->plan->title : ''); ?></th>
                                <th scope="row"   data-id="cid"><?php echo e(date("d F Y H:i:s",strtotime($user->created_at))); ?></th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view<?php echo e($user->id); ?>">View</a>
                                            <a class="dropdown-item" href="<?php echo e(url('/admin_profile_'.$user->id)); ?>">Edit</a>
                                            <a class="dropdown-item" href="<?php echo e(url('/del_user/'.$user->id)); ?>">Delete</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
                        $last_plan = \App\Payment::where('user_id',$user->id)->orderBy('id','desc')->first();
                        $tinvoices = \App\Invoice::where('user_id',$user->id)->where("status","<>","draft")
                            ->when($last_plan,function ($q) use ($last_plan) {
                                return $q->where('created_at',">=",$last_plan->created_at);
                            })->count();

                        ?>
                    <div class="modal" id="view<?php echo e($user->id); ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="max-height: 600px;overflow-y: scroll">

                                <div class="modal-header">
                                    <h5 class="modal-title">User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo e(url('edit_client')); ?>" method="post">

                                    <input type="hidden" id="idd" name="id">
                                    <input type="hidden" id="" name="user_id" value="<?php echo e(auth()->id()); ?>">

                                    <div class="modal-body">

                                        <?php if($user->image): ?>
                                            <div class="form-group mb-3">
                                                <img src="<?php echo e(url('/images/user/'.$user->image)); ?>" width="100" height="100" alt="" class="">
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group mb-3">
                                            <span class="font-weight-normal  text-center "><?php echo e($user->fname . ' ' . $user->lname); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">email : </label>
                                            <span class="font-weight-normal text-center "><?php echo e($user->email); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">Plan name : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->plan ? $user->plan->title : ""); ?>

                                             (  <?php echo e($tinvoices); ?>/<?php echo e($last_plan ? $last_plan->invoices : 1); ?>  )
                                            </span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">number : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->number); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">ssn: </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->ssn?$user->ssn:'N\A'); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">address : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->address); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">gender : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->gender); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">aboutme : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->aboutme); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">street : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->street); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">zipcode : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->zipcode); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">country : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->country); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">card_number : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->card_number); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">cvc : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->cvc); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">expiry month : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->ex_month); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="text-primary">expiry year : </label>
                                            <span class="font-weight-normal  text-center "><?php echo e($user->ex_year); ?></span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Sr#</th>
                                                    <th ><?php echo e(__('strings.date')); ?></th>
                                                    <th >Plan</th>
                                                    <th ><?php echo e(__('strings.amount')); ?> (DKK)</th>
                                                </tr>
                                                <?php $__currentLoopData = $user->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <th>
                                                            <?php echo e($loop->index+1); ?>

                                                        </th>
                                                        <td>
                                                            <?php echo e($payment->created_at->format("Y-m-d")); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($payment->plan ? $payment->plan->title : ''); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($payment->amount); ?>

                                                        </td>
                                                    </tr>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </div>

                                        <?php echo e(csrf_field()); ?>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!-- Card footer -->
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard',['a' => 'Users'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/admin/users.blade.php ENDPATH**/ ?>