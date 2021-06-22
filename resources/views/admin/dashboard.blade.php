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
    <title>Spacedive Admin - {{$a}}</title>
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
    <link rel="stylesheet" type="text/css" href="{{asset("assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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
            percent: null,
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
        @media print
        {
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
<div class="modal" id="addClient" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('add_client')}}" method="post">

                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="name" placeholder="Company Name" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="num"  placeholder="Registration Number" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="address"  placeholder="Billing Address" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="cname"  placeholder="Contact Name" type="text">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="email"  placeholder="Company Email" type="email">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <input class="form-control" name="phone"  placeholder="Company Phone" type="text">
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        <a class="nav-link  {{$a == 'Home' ? 'active' : ''}}" href="{{url('/admin')}}">
                            <i class="ni ni-tv-2 text-menu"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$a == 'Invoices' ? 'active' : ''}}" href="{{url('/admin_invoices')}}">
                            <i class="ni ni-bullet-list-67 text-menu"></i>
                            <span class="nav-link-text"> Invoices</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{$a == 'Tasks' ? 'active' : ''}}" href="{{url('/admin_tasks')}}">
                            <i class="ni ni-bullet-list-67 text-menu"></i>
                            <span class="nav-link-text">Gigs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$a == 'Users' ? 'active' : ''}}" href="{{url('/admin_users')}}">
                            <i class="ni ni-bullet-list-67 text-menu"></i>
                            <span class="nav-link-text"> Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$a == 'Deleted Users' ? 'active' : ''}}" href="{{url('/admin_del_users')}}">
                            <i class="ni ni-bullet-list-67 text-menu"></i>
                            <span class="nav-link-text">Deleted Users</span>
                        </a>
                    </li>


                    <li class="nav-item" >
                        <a class="nav-link" href="{{url('/admin_logout')}}" id="logout-btn">
                            <i class="ni ni-button-power text-menu"></i>
                            <span class="nav-link-text">Logout</span>
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
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->

                <h6 class="h2 text-white d-inline-block mb-0" style="margin-right: 5px">Welcome {{auth()->user()->fname}}! </h6>



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
                            @if(count($notifications->where('read',0)))
                            style="color: red"
                            @endif
                            ></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                            <!-- Dropdown header -->
                            <div class="px-3 py-3">
                                <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">{{count($notifications)}}</strong> notifications.</h6>
                            </div>
                            <!-- List group -->
                            @foreach($notifications as $notification)
                            <div class="list-group list-group-flush">
                                <a href="{{url('admin_notification_read_'.$notification->id)}}" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col ml--2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h4 class="mb-0 text-sm">{{$notification->title}}</h4>
                                                </div>
                                                <div class="text-right text-muted">
                                                    <small>{{$notification->created_at->diffForHumans()}}</small>
                                                </div>
                                            </div>
                                            <p class="text-sm mb-0">{{$notification->data}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <!-- View all -->
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a cla  ss="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="" src="/images/icons/favi.png">
                  </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{auth()->user()->fname}} {{auth()->user()->lname}}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">

                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>

                            <a href="{{url('/admin_invoices')}}" class="dropdown-item">
                                <i class="ni ni-bullet-list-67 text-menu"></i>
                                <span> Invoices</span>
                            </a>
                            <a href="{{url('/admin_tasks')}}" class="dropdown-item">
                                <i class="ni ni-bullet-list-67 text-menu"></i>
                                <span> Gigs</span>
                            </a>
                            <a href="{{url('/admin_users')}}" class="dropdown-item">
                                <i class="ni ni-bullet-list-67 text-menu"></i>
                                <span> Users</span>
                            </a>
                            <a href="{{url('/admin_del_users')}}" class="dropdown-item">
                                <i class="ni ni-bullet-list-67 text-menu"></i>
                                <span> Deleted Users</span>
                            </a>
                            <div class="dropdown-divider"></div>

                            <a  class="dropdown-item logout-btn" href="{{url('/admin_logout')}}" >
                                <i class="ni ni-button-power text-menu"></i>
                                <span>Logout</span>
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
    <div class="header bg-primary ">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{isset($a) ? $a : 'Invoices'}}</h6>

                    </div>

                </div>
                <!-- Card stats -->
            </div>
        </div>
    </div>
    <!-- Page content -->
    @if(isset($errors) && count($errors->all()))
        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach

        </div>
    @endif
    @if(isset($msg) && $msg != '')
        <div class="errors alert alert-dismissible fade show alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>{{$msg}}</div>
        </div>
    @endif
    <div class="container-fluid ">
        @yield('body')
    </div>
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script>desc_lang = "Description"</script>
<script>tax_lang = "Tax "</script>

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
    $("#logout-btn").click(function(e) {
        if(!confirm('Are you sure you want to logout?')) {
            e.preventDefault();
            return false;
        }
    });
</script>
<script src="{{asset("assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>

@yield('script')
</body>

</html>
