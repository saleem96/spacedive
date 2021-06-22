<?php $__env->startSection('body'); ?>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats" style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($total_users); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Invoices</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e(count($invoices)); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Amount Invoiced</h5>

                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>

                            </div>

                        </div>
                        <span class="h2 font-weight-bold mb-0"><?php echo e($invoices->sum('total')); ?></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-vtitle text-uppercase text-muted mb-0">Total  earnings from subscriptions</h5>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <span class="h2 font-weight-bold mb-0"><?php echo e($payments->sum('tamount')); ?> DKK</span>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0">Deleted Users</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e(\App\User::onlyTrashed()->count()); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


 <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                        <h5 class="card-title text-uppercase text-muted mb-0">Completed Gigs</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e(\App\Task::where('status','completed')->count('status')); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                        <h5 class="card-title text-uppercase text-muted mb-0">Open Gigs</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e(\App\Task::where('status','open')->count('status')); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats"  style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                        <h5 class="card-title text-uppercase text-muted mb-0">confirmed Gigs</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e(\App\Task::where('status','confirmed')->count('status')); ?></span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-collection"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Graph</h6>
                            <h5 class="h3 mb-0">Users Registered per Month </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Graph</h6>
                            <h5 class="h3 mb-0">Deleted User per Month </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-bars12" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
 <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Graph</h6>
                            <h5 class="h3 mb-0">Invoices created per month </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-bars4" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1">Graph</h6>
                            <h5 class="h3 mb-0">Gigs created per month </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-bars5" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                            <h5 class="h3 text-white mb-0">Payments (DKK) per month</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-sales-dark2" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Users on different Plans</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Total Users</th>
                            <th scope="col">Plan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                                <?php echo e($client->total); ?>

                            </th>
                            <td>
                                <?php echo e($client->plan ? $client->plan->title : ''); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Payments on different Plans</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Total Payment</th>
                            <th scope="col">Plan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row">
                                    <?php echo e($client->tamount); ?>

                                </th>
                                <td>
                                    <?php echo e($client->plan ? $client->plan->title : 0); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        date_arr = []
        amount_arr = []
    </script>
    <?php $__currentLoopData = $graph_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr.push("<?php echo e(date('M',strtotime($data->new_date))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        date_arr3 = []
        amount_arr3 = []
    </script>
    <?php $__currentLoopData = $graph_data3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr3.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr3.push("<?php echo e(date('M',strtotime($data->new_date))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        date_arr2 = []
        amount_arr2 = []
    </script>
    <?php $__currentLoopData = $graph2_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr2.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr2.push("<?php echo e(date('M',strtotime($data->new_date))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        date_arr4 = []
        amount_arr4 = []
    </script>
    <?php $__currentLoopData = $graph_data4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr4.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr4.push("<?php echo e(date('M',strtotime($data->new_date))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script>
        date_arr5 = []
        amount_arr5 = []
    </script>
    <?php $__currentLoopData = $graph_data5; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr5.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr5.push("<?php echo e(date('M',strtotime($data->new_date))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>

        console.log(date_arr)
        var BarsChart = function () {
            var a = $("#chart-bars");
            a.length && function (a) {
                var t = new Chart(a, {
                    type: "bar",
                    data: {
                        labels: date_arr,
                        datasets: [{label: "Total Users", data:  amount_arr}]
                    }
                });
                a.data("chart", t)
            }(a)
        }();

        var BarsChart = function () {
            var a = $("#chart-bars4");
            a.length && function (a) {
                var t = new Chart(a, {
                    type: "bar",
                    data: {
                        labels: date_arr4,
                        datasets: [{label: "Total invoices", data:  amount_arr4}]
                    }
                });
                a.data("chart", t)
            }(a)
        }();

        var BarsChart = function () {
            var a = $("#chart-bars5");
            a.length && function (a) {
                var t = new Chart(a, {
                    type: "bar",
                    data: {
                        labels: date_arr5,
                        datasets: [{label: "Total Gigs", data:  amount_arr5}]
                    }
                });
                a.data("chart", t)
            }(a)
        }();
        var BarsChart = function () {
            var a = $("#chart-bars12");
            a.length && function (a) {
                var t = new Chart(a, {
                    type: "bar",
                    data: {
                        labels: date_arr3,
                        datasets: [{label: "Total Users", data:  amount_arr3}]
                    }
                });
                a.data("chart", t)
            }(a)
        }();

        var $chart = $('#chart-sales-dark2');
        var salesChart = new Chart($chart, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            lineWidth: 1,
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        }
                    }]
                }
            },
            data: {
                labels: date_arr2,
                datasets: [{
                    label: 'Total Amount',
                    data: amount_arr2
                }]
            }
        });


        $chart.data('chart', salesChart);

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard',['a' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/admin/home.blade.php ENDPATH**/ ?>