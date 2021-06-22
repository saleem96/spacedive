<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title><?php echo e($a); ?> - Spacedive</title>
    <!-- Favicon -->
    <link rel="icon" href="/images/icons/favi.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/app.css">

    <link rel="stylesheet" type="text/css" href="css/app.css">

    <link rel="stylesheet" type="text/css" href="css/invoice.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")); ?>">

    <script>
        function disableSubmitters() {
            document.querySelectorAll('button:not([name]), input[type=reset], input[type=button]').forEach(function (b) {
                b.disabled = true;
            });
            document.querySelectorAll('input, datalist, textarea, select, button[name], input[type=submit]').forEach(function (i) {
                i.readOnly = true;
            });
        }

        function disableEnterSubmit(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        }

        function autosizeTextarea() {
            this.style.height = '';
            this.style.height = (this.scrollHeight + 2) + 'px';
        }

        window.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('textarea').forEach(function (ta) {
                if (!ta.value || ta.value.length == 0) return;
                ta.style.height = '';
                ta.style.height = (ta.scrollHeight + 2) + 'px';
            });
        });
    </script>


    <script>
        expenseData = [
            {
                description: "",
                quantity: 1,
                value: 0
            },
        ];

        tax1Data = {
            percent: 25,
            description: null,
        };
        const tax2Data = {
            percent: null,
            description: null,
        };
        const defaultDueDays = null;
    </script>


    <script>
        function invoiceDeletePrompt(event) {
            if (confirm('Are you sure you want to delete this invoice?')) {
                disableSubmitters();
                return true;
            }
            event.preventDefault();
            return false;
        };


    </script>
    <style>
        input{
            color: #4E4E4E !important;
        }
        .text-menu{
            color: #F0827E !important;
        }
        @media  print
        {
            @page  {
                size: 7in 9.25in;
                margin: 27mm 16mm 27mm 16mm;
            }
            .row {
                display: block;
            }
            .app {
                max-width: 100%;
                margin-left: 20px;
                margin-right: 20px;
                position: relative;
            }
            nav {
                display: none !important;
            }
            #sidenav-main {
                display: none !important;
            }
            .header {
                display: none !important;

            }
            #invoice__buttons {
                display: none !important;
            }
            #imgInp {
                display: none !important;
            }
            .invoice_submit_button{
                display: none !important;
            }
        }
    </style>
</head>

<body>
<div class="modal" id="addTask" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('strings.new_task')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(url('add_task')); ?>" method="post">

                <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="name" placeholder="<?php echo e(__('strings.name')); ?>" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <select name="client_id" class="form-control" id="">
                                <option value="">Select Client</option>
                                <?php $__currentLoopData = \App\Client::where('user_id',auth()->id())->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="price"  placeholder="<?php echo e(__('strings.price')); ?>" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="time"  placeholder="<?php echo e(__('strings.time')); ?>" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="job_type"  placeholder="<?php echo e(__('strings.job_type')); ?>" type="text">
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

<div class="modal" id="addClient" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(__('strings.new_client')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(url('add_client')); ?>" method="post">

                <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="name" placeholder="<?php echo e(__('strings.company_name')); ?>" type="text" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="num"  placeholder="<?php echo e(__('strings.registration_num')); ?>" type="text" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="ean"  placeholder="<?php echo e(__('strings.ean')); ?>" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="address"  placeholder="<?php echo e(__('strings.billing_address')); ?>" type="text" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="cname"  placeholder="<?php echo e(__('strings.contact_name')); ?>" type="text" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="email"  placeholder="<?php echo e(__('strings.email')); ?>" type="email" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="phone"  placeholder="<?php echo e(__('strings.phone')); ?>" type="text" required>
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

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <div class="d-xl-none">
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner" style="float: right;margin-top: 5px;">
                        <i class="sidenav-toggler-line" style="background-color: #0a0c0d"></i>
                        <i class="sidenav-toggler-line" style="background-color: #0a0c0d"></i>
                        <i class="sidenav-toggler-line" style="background-color: #0a0c0d"></i>
                    </div>
                </div>

            </div>
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="/img/newLogo.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" style="margin-top: 85px" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link  <?php echo e($a == __('strings.home') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">
                            <i class="ni ni-tv-2 text-menu"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link <?php echo e($a == __('strings.tasks') ? 'active' : ''); ?>" href="<?php echo e(url('/tasks')); ?>">
                            <i class="ni ni-settings text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.tasks')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == __('strings.my_invoices') ? 'active' : ''); ?>" href="<?php echo e(url('/invoices')); ?>">
                            <i class="ni ni-money-coins text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.my_invoices')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == __('strings.new_invoice') ? 'active' : ''); ?>" href="<?php echo e(url('/new_invoice')); ?>">
                            <i class="ni ni-fat-add text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.new_invoice')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == __('strings.my_drafts') ? 'active' : ''); ?>" href="<?php echo e(url('/draft_invoices')); ?>">
                            <i class="ni ni-archive-2 text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.my_drafts')); ?></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == __('strings.clients') ? 'active' : ''); ?>" href="<?php echo e(url('/clients')); ?>">
                            <i class="ni ni-circle-08 text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.clients')); ?></span>
                        </a>
                    </li>



                    <br>
                    <br>
                    <hr>
                    <br>
                    <br>
                    <li class="nav-item" >
                        <a class="nav-link <?php echo e($a == __('strings.profile') ? 'active' : ''); ?>" href="<?php echo e(url('/profile')); ?>">
                            <i class="ni ni-single-02 text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.profile')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == __('strings.plan_payment') ? 'active' : ''); ?>" href="<?php echo e(url('/payments')); ?>">
                            <i class="ni ni-credit-card text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.plan_payment')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($a == 'Support' ? 'active' : ''); ?>" href="<?php echo e(url('/support')); ?>">
                            <i class="ni ni-headphones text-menu"></i>
                            <span class="nav-link-text">Support</span>
                        </a>
                    </li>

                    <li class="nav-item" >
                        <a class="nav-link logout-btn" href="<?php echo e(url('/logout')); ?>" id="">
                            <i class="ni ni-button-power text-menu"></i>
                            <span class="nav-link-text"><?php echo e(__('strings.logout')); ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" >
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->

                        <?php if(!auth()->user()->plan_id || auth()->user()->plan_id == 1): ?>
                            <a style="margin-right: 5px" href="<?php echo e(url('/plans')); ?>"><button class="btn btn-sm " style="background-color: #F0827E;margin-left: 5px;color:#fff">
                                    <?php echo e(__('strings.upgrade_plan')); ?>

                                </button></a>
                        <?php endif; ?>
                        <span class="h6 text-white d-inline-block mb-0 fname" style="margin-right: 0px"><?php echo e(__('strings.welcome')); ?> <?php echo e(auth()->user()->fname); ?>! </span>
                        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="<?php echo e(__('strings.search')); ?>" type="text" id="search">
                                </div>
                            </div>
                            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </form>
                        <!-- Navbar links -->
                        <a href="<?php echo e(url("/new_tasks")); ?>"><button class="btn btn-sm " style="background-color: #F0827E; color:#fff">
                                + <?php echo e(__('strings.create_gig')); ?>

                            </button></a>
                        <ul class="navbar-nav align-items-center  ml-md-auto ">
                            <li class="nav-item d-xl-none">
                                <!-- Sidenav toggler -->
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-sm-none">
                                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                    <i class="ni ni-zoom-split-in"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ni ni-bell-55"

                                       <?php if(count($notifications->where('read',0))): ?>
                                       style="color: red"
                                        <?php endif; ?>
                                    ></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                    <!-- Dropdown header -->
                                    <div class="px-3 py-3">
                                        <h6 class="text-sm text-muted m-0"><?php echo e(__('strings.you_notification',['num'=>count($notifications)])); ?>.</h6>
                                    </div>
                                    <!-- List group -->
                                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="list-group list-group-flush">
                                            <a href="<?php echo e(url('admin_notification_read_'.$notification->id)); ?>" class="list-group-item list-group-item-action">
                                                <div class="row align-items-center">
                                                    <div class="col ml--2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h4 class="mb-0 text-sm"><?php echo e($notification->title == "invoice_status_change"||$notification->title == "Task status changed" ? __('strings.'.$notification->title) : $notification->title); ?></h4>
                                                            </div>

                                                            <?php
                                                            if(App::getLocale() == 'danish'){
                                                               \Carbon\Carbon::setLocale('da');
                                                            }else{
                                                                \Carbon\Carbon::setLocale('en');
                                                            }
                                                            ?>
                                                            <div class="text-right text-muted">
                                                                <small><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        $arr = explode('$#',$notification->data);
                                                    ?>
                                                        <?php if(count($arr) > 2 ): ?>
                                                         <p class="text-sm mb-0"><?php echo e($arr[0] . ' ' . __('strings.'.trim($arr[1])) . ' ' . __('strings.'.trim($arr[2]))); ?></p>
                                                        <?php else: ?>
                                                            <p class="text-sm mb-0"><?php echo e($notification->data); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!-- View all -->
                                </div>
                            </li>
                        </ul>
                        <form id="change_language" method="get" action="<?php echo e(url('change_language')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <select name="lang"  id="langSelect" style="color: #ffffff;background-color: #5354ce" class=" selectpicker" data-width="fit">
                                <option value="en" <?php echo e(App::getLocale() == "en" ? "selected" : ''); ?> data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                                <option value="danish"  <?php echo e(App::getLocale() == "danish" ? "selected" : ''); ?>  data-content='<span class="flag-icon flag-icon-mx"></span> Dansk'>Dansk</option>
                            </select>
                        </form>
                        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="" src="<?php echo e(url('/images/user/'.auth()->user()->image)); ?>">
                  </span>
                                        <div class="media-body  ml-2  d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold"><?php echo e(auth()->user()->fname); ?> <?php echo e(auth()->user()->lname); ?></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right ">

                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0"><?php echo e(__('strings.welcome')); ?>!</h6>
                                    </div>

                                    <a href="<?php echo e(url('/tasks')); ?>" class="dropdown-item">
                                        <i class="ni ni-settings text-menu"></i>
                                        <span><?php echo e(__('strings.tasks')); ?></span>
                                    </a>
                                    <a href="<?php echo e(url('/invoices')); ?>" class="dropdown-item">
                                        <i class="ni ni-money-coins text-menu"></i>
                                        <span><?php echo e(__('strings.my_invoices')); ?></span>
                                    </a>
                                    <a href="<?php echo e(url('/new_invoice')); ?>" class="dropdown-item">
                                        <i class="ni ni-fat-add text-menu"></i>
                                        <span><?php echo e(__('strings.new_invoice')); ?></span>
                                    </a>
                                    <a href="<?php echo e(url('/draft_invoices')); ?>" class="dropdown-item">
                                        <i class="ni ni-archive-2 text-menu"></i>
                                        <span><?php echo e(__('strings.my_drafts')); ?></span>
                                    </a>

                                    <a href="<?php echo e(url('/clients')); ?>" class="dropdown-item">
                                        <i class="ni ni-circle-08 text-menu"></i>
                                        <span><?php echo e(__('strings.clients')); ?></span>
                                    </a>
                                    <a href="<?php echo e(url('/profile')); ?>" class="dropdown-item">
                                        <i class="ni ni-single-02 text-menu"></i>
                                        <span><?php echo e(__('strings.profile')); ?></span>
                                    </a>
                                    <div class="dropdown-divider"></div>

                                    <a  class="dropdown-item logout-btn" href="<?php echo e(url('/logout')); ?>" >
                                        <i class="ni ni-button-power text-menu"></i>
                                        <span><?php echo e(__('strings.logout')); ?></span>
                                    </a>
                                </div>
                            </li>
                        </ul>

            </div>
        </div>
    </nav>
    <div id="display" style="padding: 0px 80px">

    </div>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary" >
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0"><?php echo e(isset($a) ? $a : 'Invoices'); ?></h6>

                    </div>

                </div>
                <!-- Card stats -->
            </div>
        </div>
    </div>
    <!-- Page content -->
    <?php if(isset($errors) && count($errors->all())): ?>
        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo $error; ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
    <?php if(isset($msg) && $msg != ''): ?>
        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div><?php echo e($msg); ?></div>
        </div>
    <?php endif; ?>
    <div class="container-fluid" >
        <?php echo $__env->yieldContent('body'); ?>
    </div>
</div>


<!-- Argon Scripts -->
<!-- Core -->
<script>desc_lang = "<?php echo e(__('strings.desc')); ?>"</script>
<script>tax_lang = "<?php echo e(__('strings.tax')); ?>"</script>
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-cookie/js.cookie.js"></script>
<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.2.0"></script>

<script>


    $('#langSelect').on('change',function () {
        console.log($('#change_language'))
        $('#change_language').submit()
    })
    const currencyData = {
        code: "USD",
        precision: 2,
        step: "0.01"
    };

    const formatData = {
        negDisplay: 0,
        fSep: 46,
        gSep: 44,
        gLen: 3
    };

    function handlePaymentSubmit(e) {
        if (currencyData.precision == 0) return true;

        const paymentInput = document.getElementById('payment__input');
        paymentInput.value = Math.round(paymentInput.value * ('1e' + currencyData.precision));
        return true;
    }

</script>

<script src="js/mithril.min.js" charset="utf-8" defer></script>
<script src="js/invoice.js?v=2" charset="utf-8" defer></script>
<script src="js/app.js"></script>

<script>
    function disableSubmitters() {
        document.querySelectorAll('button:not([name]), input[type=reset], input[type=button]').forEach(function(b) { b.disabled = true; });
        document.querySelectorAll('input, datalist, textarea, select, button[name], input[type=submit]').forEach(function(i) { i.readOnly = true; });
    }

    function disableEnterSubmit(e) {
        if(e.keyCode == 13) {
            e.preventDefault();
        }
    }

    function autosizeTextarea() {
        this.style.height = '';
        this.style.height = (this.scrollHeight + 2) + 'px';
    }

    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('textarea').forEach(function(ta) {
            if(!ta.value || ta.value.length == 0) return;
            ta.style.height = '';
            ta.style.height = (ta.scrollHeight + 2) + 'px';
        });
    });
    // const allCheckbox = document.getElementById('draft_all_checkbox');
    const invoiceCheckboxes = document.querySelectorAll('.draft__checkbox');
    // const invoiceActions = document.getElementById('invoice_actions');

    let totalChecked = 0;

    function handleInvoiceCheckboxChanged() {
        totalChecked = 0;
        invoiceCheckboxes.forEach(function(checkbox) {
            if(checkbox.checked) totalChecked++;
        });

        // allCheckbox.classList.remove('label--checked', 'label--semi-checked');
        // invoiceActions.classList.remove('display--none');

        // if(totalChecked == invoiceCheckboxes.length) {
        //     allCheckbox.classList.add('label--checked');
        // } else if(totalChecked > 0) {
        //     allCheckbox.classList.add('label--semi-checked');
        // } else if(totalChecked == 0) {
        //     // invoiceActions.classList.add('display--none');
        // }
    }

    invoiceCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', handleInvoiceCheckboxChanged);
    });

    // allCheckbox.addEventListener('click', function() {
    //     if(totalChecked == invoiceCheckboxes.length) {
    //         invoiceCheckboxes.forEach(function(checkbox) {
    //             checkbox.checked = false;
    //         });
    //     } else {
    //         invoiceCheckboxes.forEach(function(checkbox) {
    //             checkbox.checked = true;
    //         });
    //     }
    //     handleInvoiceCheckboxChanged();
    // });

    // Update for clients that support JavaScript
    // allCheckbox.classList.remove('display--none');
    // invoiceActions.classList.add('display--none');

    function confirmDraftsDelete(event) {
        if(!confirm('Are you sure you want to delete ' + totalChecked + ' invoice' + (totalChecked > 1 ? 's' : '') + '?')) {
            event.stopPropagation();
            event.preventDefault();
            return false;
        }
    }
    $("#search").keyup(function(){
        var name = $('#search').val();

        if (name == "") {
            //Assigning empty value to "display" div in "search.php" file.
            $("#display").html("");
        }else{
            $.ajax({
                //AJAX type is "Post".
                type: "get",
                //Data will be sent to "ajax.php".
                url: "/search",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function(res) {
                    //Assigning result to "display" div in "search.php" file.
                    str = '';
                    res.forEach(function(a,b){
                        str += '<ul><li><a href="/invoice_'+a.id+'"><h4>'+a.invoice_num+'</h4></a></li></ul>'
                    })
                    $("#display").html(str).show();

                }
            });
        }
    })
    $(".logout-btn").click(function(e) {
        if(!confirm("<?php echo e(__('strings.logout_msg')); ?>")) {
            e.preventDefault();
            return false;
        }
    });

</script>
<script src="<?php echo e(asset("assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")); ?>"></script>
<script>
    $(".tdatepicker").datepicker({
        format: "yyyy-mm-dd",
    })
</script>
<?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH /home/spacairt/my.spacedive.io/resources/views/dashboard.blade.php ENDPATH**/ ?>