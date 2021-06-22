<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="col-lg-12 row">
                        <div class="col-lg-8">
                            <h3 class="mb-0"><?php echo e(__('strings.clients')); ?></h3>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <button class="btn btn-sm" style="background-color: #F0827E !important; color: #fff" data-toggle="modal" data-target="#addClient">+ <?php echo e(__('strings.add_new1')); ?></button>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.company_name')); ?></th>
                            <th scope="col" class="sort" data-sort="name"><?php echo e(__('strings.registration_num')); ?></th>
                            <th scope="col" class="sort" data-sort="ean"><?php echo e(__('strings.ean')); ?></th>
                            <th scope="col" class="sort" data-sort="budget"><?php echo e(__('strings.billing_address')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.contact_name')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.email')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('strings.phone')); ?></th>
                            <th scope="col" class="sort" data-sort="status"></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="rowParent">
                                <th scope="row"  style="display: none" data-id="cid"><?php echo e($client->id); ?></th>
                                <th scope="row"  data-id="nameVal"><?php echo e($client->name); ?></th>
                                <th scope="row" data-id="numVal"><?php echo e($client->num); ?></th>
                                <th scope="row" data-id="ean"><?php echo e($client->ean); ?></th>
                                <th scope="row" data-id="addressVal"><?php echo e($client->address); ?></th>
                                <th scope="row" data-id="cnameVal"><?php echo e($client->cname); ?></th>
                                <th scope="row" data-id="emailVal"><?php echo e($client->email); ?></th>
                                <th scope="row" data-id="phoneVal"><?php echo e($client->phone); ?></th>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item editBtn" href="#" data-id="editBtn" data-toggle="modal" data-target="#editClient"><?php echo e(__('strings.edit')); ?></a>
                                            <a class="dropdown-item" href="<?php echo e(url('/del_client/'.$client->id)); ?>"><?php echo e(__('strings.delete')); ?></a>
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


    <div class="modal" id="editClient" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('strings.edit_client')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(url('edit_client')); ?>" method="post">

                    <input type="hidden" id="idd" name="id">
                    <input type="hidden" id="" name="user_id" value="<?php echo e(auth()->id()); ?>">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                                                        <label for=""><?php echo e(__('strings.company_name')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input  class="form-control" id="name" name="name" placeholder="Company Name" type="text" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.registration_num')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input class="form-control" id="num"  name="num"  placeholder="Registration Number" type="text" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.ean')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input class="form-control" id="ean"  name="ean"  placeholder="<?php echo e(__('strings.ean')); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.billing_address')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input class="form-control" id="address"  name="address"  placeholder="Billing Address" type="text" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.contact_name')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">
                                <input class="form-control" id="cname"  name="cname"  placeholder="Contact Name" type="text" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.email')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input class="form-control" id="email"  name="email"  placeholder="Company Email" type="email" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                                <label for=""><?php echo e(__('strings.phone')); ?></label>
                            <div class="input-group input-group-merge input-group-alternative">

                                <input class="form-control" id="phone"  name="phone"  placeholder="Company Phone" type="text" >
                            </div>
                        </div>
                        <?php echo e(csrf_field()); ?>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('strings.update_changes')); ?></button>
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
            $("#idd").val($(this).parents('.rowParent').find("[data-id='cid']").html())
            $("#name").val($(this).parents('.rowParent').find("[data-id='nameVal']").html())
            $("#num").val($(this).parents('.rowParent').find("[data-id='numVal']").html())
            $("#ean").val($(this).parents('.rowParent').find("[data-id='ean']").html())
            $("#address").val($(this).parents('.rowParent').find("[data-id='addressVal']").html())
            $("#cname").val($(this).parents('.rowParent').find("[data-id='cnameVal']").html())
            $("#email").val($(this).parents('.rowParent').find("[data-id='emailVal']").html())
            $("#phone").val($(this).parents('.rowParent').find("[data-id='phoneVal']").html())
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.clients')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/clients.blade.php ENDPATH**/ ?>