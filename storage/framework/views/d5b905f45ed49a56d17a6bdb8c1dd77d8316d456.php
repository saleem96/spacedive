<?php $__env->startSection('body'); ?>
    <style>
        @media  print
        {
            body * { visibility: hidden; }
            .DivIdToPrint * { visibility: visible; }
            .DivIdToPrint { position: absolute; top: 40px; left: 30px; }
        }
    </style>
    <div class="row ">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats" style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                                <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.total_invoice_amount')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($invoices->sum('total')); ?> DKK</span>
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

        <div class="col-xl-4 col-md-6 ">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.payment_received')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($paid_amount); ?> DKK</span>
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

        <div class="col-xl-4 col-md-6">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.total_invoice_send')); ?></h5>
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


        <div class="col-xl-4 col-md-6">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.payment_overdue')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($total); ?> DKK</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="col-xl-4 col-md-6">
            <div class="card card-stats" style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.open_gig')); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($gigs->where('status','open')->count()); ?></span>
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
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.confirmed_gig')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($gigs->where('status','confirmed')->count()); ?></span>
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
        <div class="col-xl-4 col-md-6 ">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.completed_gig')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($gigs->where('status','completed')->count()); ?></span>
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
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats"  style="height: 230px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e(__('strings.total_gig_amount')); ?></h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo e($gigs->sum('price')); ?> DKK</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>




        <div class="col-xl-8">
            <div class="card bg-default">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-light text-uppercase ls-1 mb-1"></h6>
                            <h5 class="h3 text-white mb-0"><?php echo e(__('strings.payment_received')); ?></h5>
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

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1"></h6>
                            <h5 class="h3 mb-0"><?php echo e(__('strings.amount_invoiced')); ?></h5>
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
        <div class="col-xl-8 DivIdToPrint">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><?php echo e(__('strings.top_client')); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"><?php echo e(__('strings.client')); ?></th>
                            <th scope="col"><?php echo e(__('strings.invoice_amount')); ?></th>
                            <th>Gigs</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row">
                                <?php echo e($client->name); ?>

                            </th>
                            <td>
                                <?php echo e($client->invoice_total); ?>

                            </td>
                            <td><?php echo e(count($client->tasks)); ?></td>
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
        <script>date_arr.push("<?php echo e(__('strings.'.date('M',strtotime($data->new_date)))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>
    date_arr2 = []
    amount_arr2 = []
</script>
    <?php $__currentLoopData = $graph2_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>amount_arr2.push("<?php echo e($data->total); ?>")</script>
        <script>date_arr2.push("<?php echo e(__('strings.'.date('M',strtotime($data->new_date)))); ?>")</script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function printElem(){
            window.print()
        }

        console.log(date_arr)
        var BarsChart = function () {
            var a = $("#chart-bars");
            a.length && function (a) {
                var t = new Chart(a, {
                    type: "bar",
                    data: {
                        labels: date_arr,
                        datasets: [{label: "<?php echo e(__('strings.amount')); ?>", data:  amount_arr}]
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
                    label: 'Performance',
                    data: amount_arr2
                }]
            }
        });


        $chart.data('chart', salesChart);


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard',['a' => __('strings.home')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/spacairt/my.spacedive.io/resources/views/home.blade.php ENDPATH**/ ?>