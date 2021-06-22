<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Users</label>
                                <select name="user_id" class="form-control" id="">
                                    <option value="">Select User</option>
                                    <?php $__currentLoopData = \App\User::where('is_admin',0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($client->id); ?>"><?php echo e($client->email); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="open">Open</option>
                                    <option value="sent_to_client">Sent to client</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>

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

                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0"><?php echo e(__('strings.gig')); ?></h3>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">User</th>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.task_name')); ?></th>
                            <th scope="col" class="sort" data-sort="reference_no">Ref.#</th>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.client')); ?></th>
                            <th scope="col" class="sort" data-sort="ean"><?php echo e(__('strings.price')); ?></th>
                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.time')); ?> ( hours )</th>
                            <th scope="col" class="sort" data-sort="status">JobType</th>
                            <th scope="col" class="sort" data-sort="status">Invoiced</th>
                            <th scope="col" class="sort" data-sort="status">Insurance by client</th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.status')); ?></th>
                            <th scope="col" class="sort" data-sort="status">Client Approved</th>
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>


                        <tbody class="list">

                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="rowParent">
                                <th scope="row"  style="display: none" data-id="cid"><?php echo e($task->id); ?></th>
                                
                                <th scope="row"   data-id="username"> <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#view<?php echo e($task->user?$task->user->id:''); ?>"><?php echo e($task->user ? ($task->user->fname . ' ' . $task->user->lname ) : ''); ?></a></th>
                                <th scope="row" data-id="name"><a href="<?php echo e(url('admin_task_'.$task->id)); ?>"><?php echo e($task->name); ?></a></th>
                                <th scope="row"  data-id="reference_no"><?php echo e($task->reference_no?$task->reference_no:''); ?></th>
                                <th scope="row"  style="display: none" data-id="client_id"><?php echo e($task->client_id); ?></th>


                                <th scope="row" data-id="client" data-toggle="modal" data-target="#client<?php echo e($task->id); ?>">
                                    <a href="#"><?php echo e($task->client ? $task->client->name : ''); ?></a></th>
                                <th scope="row" data-id="price"><?php echo e($task->price); ?> <?php echo e($task->currency); ?></th>
                                <th scope="row" data-id="time"><?php echo e($task->time); ?></th>
                                <th scope="row" data-id="type"><?php echo e($task->job_type); ?></th>
                                <th scope="row" data-id="type"><?php echo $task->invoice ? '<a href="/admin_invoice_'.$task->invoice->id.'">View Invoice</a>' : 'No'; ?></th>
                                <th scope="row" data-id="type"><?php echo e($task->insurance ? 'Yes' : 'No'); ?></th>
                                <th scope="row" data-id="status"><?php echo e(ucwords(implode(' ',explode('_',$task->status)))); ?></th>
                                <th scope="row" data-id="status"><?php echo e($task->is_client_approved ? "Yes" : "No"); ?></th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#editTask">Update Status</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <div class="modal" id="client<?php echo e($task->id); ?>" tabindex="-1" role="dialog">
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
                                                    <?php echo e($task->client->name); ?>

                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Registration Number : </span>
                                                    <?php echo e($task->client->num); ?>

                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Billing Address : </span>
                                                    <?php echo e($task->client->address); ?>

                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Contact Name : </span>
                                                    <?php echo e($task->client->cname); ?>

                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Company Email : </span>
                                                    <?php echo e($task->client->email); ?>

                                                </div>
                                                <div>
                                                    <span style="margin-right: 10px">Company Phone : </span>
                                                    <?php echo e($task->client->phone); ?>

                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('strings.close')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </tbody>
                    </table>
                </div>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($task->user): ?>
                <div class="modal" id="view<?php echo e($task->user->id); ?>" tabindex="-1" role="dialog">
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

                                    <?php if($task->user->image): ?>
                                        <div class="form-group mb-3">
                                            <img src="<?php echo e(url('/images/user/'.$task->user->image)); ?>" width="100" height="100" alt="" class="">
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group mb-3">
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->fname . ' ' . $task->user->lname); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">email : </label>
                                        <span class="font-weight-normal text-center "><?php echo e($task->user->email); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">Plan name : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->plan ? $task->user->plan->title : ""); ?>


                                        </span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">number : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->number); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">ssn: </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->ssn?$task->user->ssn:'N\A'); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">address : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->address); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">gender : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->gender); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">aboutme : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->aboutme); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">street : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->street); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">zipcode : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->zipcode); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">country : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->country); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">card_number : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->card_number); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">cvc : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->cvc); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">expiry month : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->ex_month); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="text-primary">expiry year : </label>
                                        <span class="font-weight-normal  text-center "><?php echo e($task->user->ex_year); ?></span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Sr#</th>
                                                <th ><?php echo e(__('strings.date')); ?></th>
                                                <th >Plan</th>
                                                <th ><?php echo e(__('strings.amount')); ?> (DKK)</th>
                                            </tr>
                                            <?php $__currentLoopData = $task->user->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- Card footer -->
            </div>
        </div>
    </div>


    <div class="modal" id="editTask" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Gig</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(url('admin_edit_task')); ?>" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                    <input type="hidden" name="id"  id="idss" value="">
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <select name="status" id="status" class="form-control" id="">
                                    <option value="open">Open</option>
                                    <option value="sent_to_client">Send to client for approval</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="Canceled">Canceled</option>

                                </select>
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('strings.save_changes')); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('strings.close')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(".editBtn").click(function(){
            console.log($(this).parents('.rowParent'))
            console.log($(this).parents('.rowParent'))
            console.log($(this).parents('.rowParent').find("[data-id='cid']").html())
            $("#idss").val($(this).parents('.rowParent').find("[data-id='cid']").html())

            $('#status option[value="'+$(this).parents('.rowParent').find("[data-id='status']").html()+'"]').prop('selected', true)

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard',['a' => 'Gigs'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/admin/tasks.blade.php ENDPATH**/ ?>