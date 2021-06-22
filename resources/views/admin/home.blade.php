@extends('admin.dashboard',['a' => 'Home'])
@section('body')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats" style="height: 200px">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_users}}</span>
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
                            <span class="h2 font-weight-bold mb-0">{{count($invoices)}}</span>
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
                        <span class="h2 font-weight-bold mb-0">{{$invoices->sum('total')}}</span>
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
                        <span class="h2 font-weight-bold mb-0">{{$payments->sum('tamount')}} DKK</span>

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
                            <span class="h2 font-weight-bold mb-0">{{\App\User::onlyTrashed()->count()}}</span>
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
                            <span class="h2 font-weight-bold mb-0">{{\App\Task::where('status','completed')->count('status')}}</span>
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
                            <span class="h2 font-weight-bold mb-0">{{\App\Task::where('status','open')->count('status')}}</span>
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
                            <span class="h2 font-weight-bold mb-0">{{\App\Task::where('status','confirmed')->count('status')}}</span>
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
                        @foreach($users as $client)
                        <tr>
                            <th scope="row">
                                {{$client->total}}
                            </th>
                            <td>
                                {{$client->plan ? $client->plan->title : ''}}
                            </td>
                        </tr>
                        @endforeach
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
                        @foreach($payments as $client)
                            <tr>
                                <th scope="row">
                                    {{$client->tamount}}
                                </th>
                                <td>
                                    {{$client->plan ? $client->plan->title : 0}}
                                </td>
                            </tr>
                        @endforeach
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
    @foreach($graph_data as $data)
        <script>amount_arr.push("{{$data->total}}")</script>
        <script>date_arr.push("{{date('M',strtotime($data->new_date))}}")</script>
    @endforeach
    <script>
        date_arr3 = []
        amount_arr3 = []
    </script>
    @foreach($graph_data3 as $data)
        <script>amount_arr3.push("{{$data->total}}")</script>
        <script>date_arr3.push("{{date('M',strtotime($data->new_date))}}")</script>
    @endforeach
    <script>
        date_arr2 = []
        amount_arr2 = []
    </script>
    @foreach($graph2_data as $data)
        <script>amount_arr2.push("{{$data->total}}")</script>
        <script>date_arr2.push("{{date('M',strtotime($data->new_date))}}")</script>
    @endforeach
    <script>
        date_arr4 = []
        amount_arr4 = []
    </script>
    @foreach($graph_data4 as $data)
        <script>amount_arr4.push("{{$data->total}}")</script>
        <script>date_arr4.push("{{date('M',strtotime($data->new_date))}}")</script>
    @endforeach
    <script>
        date_arr5 = []
        amount_arr5 = []
    </script>
    @foreach($graph_data5 as $data)
        <script>amount_arr5.push("{{$data->total}}")</script>
        <script>date_arr5.push("{{date('M',strtotime($data->new_date))}}")</script>
    @endforeach
@endsection
@section('script')
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
@endsection
