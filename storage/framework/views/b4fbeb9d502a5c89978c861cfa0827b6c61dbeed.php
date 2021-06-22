<?php $__env->startSection('body'); ?>

    <div class="row" >
        <div class="col">
            <div class="card">
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
                                <label class="form-control-label" for="input-city"><?php echo e(__('strings.status')); ?></label>
                                <select name="status" class="form-control" id="">
                                    <option value=""><?php echo e(__('strings.select_status')); ?> </option>
                                    <option value="open"><?php echo e(__('strings.open')); ?> </option>
                                    <option value="sent_to_client"><?php echo e(__('strings.sent to client')); ?> </option>
                                    <option value="confirmed"><?php echo e(__('strings.confirmed')); ?> </option>
                                    <option value="completed"><?php echo e(__('strings.completed')); ?> </option>
                                    <option value="canceled"><?php echo e(__('strings.canceled')); ?> </option>



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
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-6">
                            <h3 class="mb-0"><?php echo e(__('strings.tasks')); ?></h3>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <a href="<?php echo e(url("/new_tasks")); ?>"><button class="btn btn-sm" style="background-color: #F0827E !important; color: #fff">+ <?php echo e(__('strings.add_new')); ?></button></a>
                        </div>
                    </div>
                </div>

                <!-- Light table -->
                    <div class="container-fluid">
                <div class="table-responsive">
                    <?php if(count($tasks)): ?>
                        <table class="table align-items-center table-flush" >

                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.task_name')); ?></th>
                                    <th scope="col" class="sort" data-sort="name">Ref.#</th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.client')); ?></th>
                                    <th scope="col" class="sort" data-sort="start"><?php echo e(__('strings.start_date')); ?></th>
                                    <th scope="col" class="sort" data-sort="end"><?php echo e(__('strings.end_date')); ?></th>
                                    <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.time')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.industry')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.estimated_amount')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.status')); ?></th>
                                    <th scope="col" class="sort" data-sort="status">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="rowParent">
                                        <th scope="row"  style="display: none" data-id="cid"><?php echo e($task->id); ?></th>
                                        <th scope="row" data-id="name"><?php echo e($task->name); ?></th>
                                        <th scope="row"  style="display: none" data-id="client_id"><?php echo e($task->client_id); ?></th>
                                        <th scope="row" data-id="ref_no"><?php echo e($task->reference_no ? $task->reference_no: ''); ?></th>
                                        <th scope="row" data-id="client"><?php echo e($task->client ? $task->client->name : ''); ?></th>

                                        <th scope="row" data-id="start"><?php echo e($task->start_date); ?></th>
                                        <th scope="row" data-id="end"><?php echo e($task->end_date); ?></th>
                                        <th scope="row" data-id="time"><?php echo e($task->time); ?></th>
                                        <th scope="row" data-id="type"><?php echo e($task->job_type); ?></th>
                                        <th scope="row" data-id="type"><?php echo e($task->price); ?> <?php echo e($task->currency); ?></th>
                                        <th scope="row" data-id="status"><?php echo e(__('strings.'.strtolower(implode(' ',explode('_',$task->status))))); ?></th>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <?php if($task->status == 'open'): ?>
                                                    <a class="dropdown-item" href="<?php echo e(url('/edit_tasks_'.$task->id)); ?>"><?php echo e(__('strings.edit')); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(url('/del_task/'.$task->id)); ?>"><?php echo e(__('strings.delete')); ?></a>
                                                    <?php else: ?>
                                                        <a class="dropdown-item" href="<?php echo e(url('/del_task/'.$task->id)); ?>"><?php echo e(__('strings.delete')); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(url('/new_invoice_'.$task->id)); ?>"><?php echo e(__('strings.create_invoice_from_task')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>

                        <table class="table align-items-center table-flush" >
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.task_name')); ?></th>
                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.client')); ?></th>
                                <th scope="col" class="sort" data-sort="start"><?php echo e(__('strings.start_date')); ?></th>
                                <th scope="col" class="sort" data-sort="end"><?php echo e(__('strings.end_date')); ?></th>
                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.time')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.industry')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.estimated_amount')); ?></th>
                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.status')); ?></th>
                                <th scope="col" class="sort" data-sort="status">Actions</th>
                            </tr>
                            </thead>

                            <tbody class="list">
                            <tr>
                                <td colspan="100">
                            <?php if(request()->has('status') || request()->has('client_id')): ?>

                            <p>You currently have 0 <?php echo e(request()->get('status')); ?> gigs, <a href="<?php echo e(url("/tasks")); ?>"> OK</a></p>
                        <?php else: ?>
                            <p><?php echo e(__('strings.dont_have_task')); ?>, <a href="<?php echo e(url("/new_tasks")); ?>"><?php echo e(__('strings.create_one_here')); ?></a></p>
                        <?php endif; ?>
                                </td>
                        </tr>
                            </tbody>
                        </table>

                        <?php endif; ?>
                </div>
            </div>

                <!-- Card footer -->
            </div>
        </div>
    </div>


    <div class="modal" id="editTask" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(url('edit_task')); ?>" method="post">

                    <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                    <input type="hidden" name="id"  id="id" value="">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="name"  id="name" placeholder="<?php echo e(__('strings.name')); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <select name="client_id" id="client_id" class="form-control" id="">
                                    <option value="">Select Client</option>
                                    <?php $__currentLoopData = \App\Client::where('user_id',auth()->id())->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="price"   id="price"  placeholder="<?php echo e(__('strings.price')); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="time"  id="time"  placeholder="<?php echo e(__('strings.time')); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" name="job_type" id="job_type"  placeholder="<?php echo e(__('strings.job_type')); ?>" type="text">
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
            $("#id").val($(this).parents('.rowParent').find("[data-id='cid']").html())
            $("#name").val($(this).parents('.rowParent').find("[data-id='name']").html())
            $("#price").val($(this).parents('.rowParent').find("[data-id='price']").html())
            $('#client_id option[value="'+$(this).parents('.rowParent').find("[data-id='client_id']").html()+'"]').prop('selected', true)

            // $("#client_id").val($(this).parents('.rowParent').find("[data-id='client']").html())
            $("#time").val($(this).parents('.rowParent').find("[data-id='time']").html())
            $("#job_type").val($(this).parents('.rowParent').find("[data-id='type']").html())
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.tasks')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/tasks.blade.php ENDPATH**/ ?>