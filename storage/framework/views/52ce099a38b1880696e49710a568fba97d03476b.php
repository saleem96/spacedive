<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spacedive – <?php echo e(__('strings.Confirm gig')); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="/images/icons/favi.png" type="image/png">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Roboto">


    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="row col-lg-12">
                <div class="col-lg-4">
                    <div class="login100-pic " style="   position:relative;
">
                        <img src="images/img-01.png" alt="IMG" style="max-width: 60% !important;">
                        
                    </div>
                </div>
                <div class="col-lg-8">

                    <form action="" method="post" >
                        <?php echo e(csrf_field()); ?>


                        <div class="">
                            <div class="container">

                                <div class="row" style="overflow-x:auto;">
                                    <table class="table table-striped">
                                        <thead style="background-color: #5354CE">
                                        <tr>
                                            <th colspan="100" style="color: #FFFFFF"><?php echo e(__('strings.Confirm gig')); ?> <span  style="font-size:14px; color: #FFFFFF; padding-top:2px; float: right;">Ref.<?php echo e($task->reference_no?$task->reference_no:''); ?></span></th>

                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Freelancer</td>
                                            <td><?php echo e(__('strings.tk_name')); ?></td>
                                            <td><?php echo e(__('strings.price')); ?> (<?php echo e($task->currency); ?>)</td>
                                            <td><?php echo e(__('strings.Time Hours')); ?></td>
                                            <td>Job Type</td>
                                        </tr>
                                        <tr>
                                            <?php if($task->user): ?>
                                            <td><?php echo e($task->user->fname . ' ' . $task->user->lname); ?></td>
                                            <?php else: ?>
                                            <td></td>
                                            <?php endif; ?>
                                            <td><?php echo e($task->name); ?></td>
                                            <td><?php echo e($task->price); ?></td>
                                            <td><?php echo e($task->time); ?></td>
                                            <td><?php echo e($task->job_type); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p><?php echo e(__('strings.Are you sure you want to approve this gig')); ?>?</p>
                                <div class="wrap-input100 validate-input" data-validate = "Terms is required">
                       <span class="txt2"> <span style="cursor: pointer"  onMouseOver="this.style.color='#5e72e4'"  onMouseOut="this.style.color='#666666'"  data-toggle="modal" data-target="#terms"><?php echo e(__('strings.accept')); ?></span><br>
                           <?php echo e(__('strings.iaccept')); ?>: </span><input  class="input" required type="checkbox" value="0" name="terms">
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "Terms is required">
                       <span class="txt2"> <?php echo e(__('strings.Is the freelancer covered by your insurance on this gig')); ?> ?
                            </span><input type="radio"
                                          name="insurance"
                                          value="1"
                                          checked>
                                        <?php echo e(__('strings.Yes')); ?>

                                    </input>

                                    <input type="radio"
                                           name="insurance"
                                           value="0">
                                        <?php echo e(__('strings.No')); ?>

                                    </input>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" style="background-color: #5354CE"><?php echo e(__('strings.Approve gig')); ?></button>

                        </div>

                    </form>
                </div>
            </div>

            <div class="modal show" id="terms" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" >
                    <div class="modal-content"  style="overflow-y: auto !important;">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e(__('strings.terms_conditions')); ?></h5>
                        </div>

                        <div class="modal-body" >
                            <p style="line-height: normal;">
                                <?php echo __('strings.confirmation_terms'); ?>


                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"  style="background-color: #5354CE"><?php echo e(__('strings.close')); ?></button>

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>


</div>


<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
    $('#langSelect').on('change',function () {
        console.log($('#change_language'))
        $('#change_language').submit()
    })

</script>

<script type="text/javascript">
    $(window).on('load', function() {
        // $('#tasks').modal('show');
    });
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
<?php /**PATH /home/spacairt/my.spacedive.io/resources/views/approve_gig.blade.php ENDPATH**/ ?>