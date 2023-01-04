@extends('admin.layouts.app')

@section('content')

    {{-- <div class="col-12 mb-4"><canvas height="50" id="day-chart"></canvas></div> --}}
    <div class="row d-flex justify-content-center">
        <div class="col-4">
            <div row class="d-flex justify-content-center">
            From<input type="text" id="datepicker" value="{{ $currentDay->toDateString() }}">
            To<input type="text" id="datepicker2" value="{{ $currentDay->toDateString() }}">

                    </div>
            <canvas height="50" id="day-chart"></canvas>
            <label class="ms-0 d-flex justify-content-center mt-3">Daily Product Sold</label>
        </div>
    </div>
    <div class="col-12 mb-5">
        <div class="input-group input-group-static mb-4">
            <label class="ms-0">Product</label>
            <select name="product_id" class="form-control">
                @foreach ($products as $product)
                    <option value="" selected disabled hidden>Select product</option>
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <canvas height="60" id="month-chart"></canvas>
        {{-- <label class="ms-0 d-flex justify-content-center mt-3">Monthly Product Sold</label> --}}
    </div>

    {{-- Daily --}}
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today Users</p>
                    <h4 class="mb-0">{{ $userToday }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userYesterday > 0)
                    @if ($userToday - $userYesterday >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($userToday - $userYesterday) / $userYesterday) * 100 }}%</span> than yesterday</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($userToday - $userYesterday) / $userYesterday) * 100 }}% </span> than yesterday</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">reorder</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today Orders</p>
                    <h4 class="mb-0">{{ $orderToday }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($orderYesterday > 0)
                    @if ($orderToday - $orderYesterday >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($orderToday - $orderYesterday) / $orderYesterday) * 100 }}%</span> than yesterday</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($orderToday - $orderYesterday) / $orderYesterday) * 100 }}% </span> than yesterday</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today Products</p>
                    <h4 class="mb-0">{{ $productToday }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($productYesterday > 0)
                    @if ($productToday - $productYesterday >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($productToday - $productYesterday) / $productYesterday) * 100 }}%</span> than
                            yesterday</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($productToday - $productYesterday) / $productYesterday) * 100 }}% </span> than
                            yesterday</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">attach_money</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today Money</p>
                    <h4 class="mb-0">${{ $moneyToday }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($moneyYesterday > 0)
                    @if ($moneyToday - $moneyYesterday >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($moneyToday - $moneyYesterday) / $moneyYesterday) * 100 }}%</span> than yesterday</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($moneyToday - $moneyYesterday) / $moneyYesterday) * 100 }}% </span> than yesterday</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    {{-- Monthly --}}
    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Users this month</p>
                    <h4 class="mb-0">{{ $userCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                    @if ($userCountMonth - $userLastMonth >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($userCountMonth - $userLastMonth) / $userLastMonth) * 100 }}%</span> than last month
                        </p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($userCountMonth - $userLastMonth) / $userLastMonth) * 100 }}% </span> than last month
                        </p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">reorder</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Orders this month</p>
                    <h4 class="mb-0">{{ $orderCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                    @if ($orderCountMonth - $userLastMonth >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($orderCountMonth - $orderLastMonth) / $orderLastMonth) * 100 }}%</span> than last
                            month</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($orderCountMonth - $orderLastMonth) / $orderLastMonth) * 100 }}% </span> than last
                            month</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Products this month</p>
                    <h4 class="mb-0">{{ $productCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                    @if ($productCountMonth - $userLastMonth >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($productCountMonth - $productLastMonth) / $productLastMonth) * 100 }}%</span> than
                            last month
                        </p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($productCountMonth - $productLastMonth) / $productLastMonth) * 100 }}% </span> than
                            last month
                        </p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif


            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">attach_money</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Money this month</p>
                    <h4 class="mb-0">${{ $moneyCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($moneyLastMonth > 0)
                    @if ($moneyCountMonth - $moneyLastMonth >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($moneyCountMonth - $moneyLastMonth) / $moneyLastMonth) * 100 }}%</span> than last
                            month</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($moneyCountMonth - $moneyLastMonth) / $moneyLastMonth) * 100 }}% </span> than last
                            month</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>


    {{-- Yearly --}}
    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Users this year</p>
                    <h4 class="mb-0">{{ $userCountYear }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastYear > 0)
                    @if ($userCountYear - $userLastYear >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($userCountYear - $userLastYear) / $userLastYear) * 100 }}%</span> than last year</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($userCountYear - $userLastYear) / $userLastYear) * 100 }}% </span> than last year</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">reorder</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Orders this years</p>
                    <h4 class="mb-0">{{ $orderCountYear }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($orderLastYear > 0)
                    @if ($orderCountYear - $orderLastYear >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($orderCountYear - $orderLastYear) / $orderLastYear) * 100 }}%</span> than last year
                        </p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($orderCountYear - $orderLastYear) / $orderLastYear) * 100 }}% </span> than last year
                        </p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Products this years</p>
                    <h4 class="mb-0">{{ $productCountYear }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($productLastYear > 0)
                    @if ($productCountYear - $productLastYear >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($productCountYear - $productLastYear) / $productLastYear) * 100 }}%</span> than last
                            year</p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($productCountYear - $productLastYear) / $productLastYear) * 100 }}% </span> than last
                            year</p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">attach_money</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Money this year</p>
                    <h4 class="mb-0">${{ $moneyCountYear }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($moneyLastYear > 0)
                    @if ($moneyCountYear - $moneyLastYear >= 0)
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                                +{{ (($moneyCountYear - $moneyLastYear) / $moneyLastYear) * 100 }}%</span> than last year
                        </p>
                    @else
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                                {{ (($moneyCountYear - $moneyLastYear) / $moneyLastYear) * 100 }}% </span> than last year
                        </p>
                    @endif
                @else
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>No data available</p>
                @endif

            </div>
        </div>
    </div>



    {{-- Total --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Users</p>
                    <h4 class="mb-0">{{ $userCount }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">reorder</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Orders</p>
                    <h4 class="mb-0">{{ $orderCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4  mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">inventory_2</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Products</p>
                    <h4 class="mb-0">{{ $productCount }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4  mt-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">attach_money</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Total Money</p>
                    <h4 class="mb-0">${{ $moneyCount }}</h4>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
        });

        $("#datepicker2").datepicker({
            dateFormat: 'yy-mm-dd'
        });

        const dc = document.getElementById('day-chart');
        const dcChart = new Chart(dc, {
            type: 'pie',
            data: {
                labels: @json($label),
                datasets: [{
                    label: 'My First Dataset',
                    data: @json($qty),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                    hoverOffset: 4
                }]
            },
        });

        $("#datepicker").on('change', function(e) {
            var fromDate = $(this).val();
            var toDate = $('#datepicker2').val();
            const GET_DAY_CHART_URL = '/dashboard/get-day-chart';
            $.ajax({
                url: GET_DAY_CHART_URL,
                type: "GET",
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                },
                dataType: 'json'
            }).done(function(data) {
                var qty = data.qty;
                var label = data.label;
                dcChart.data.datasets[0].data = qty;
                dcChart.data.labels = label;
                dcChart.update();
            }).fail(function(response) {});
        })

        $("#datepicker2").on('change', function(e) {
            var fromDate = $('#datepicker').val();
            var toDate = $(this).val();
            const GET_DAY_CHART_URL = '/dashboard/get-day-chart';
            $.ajax({
                url: GET_DAY_CHART_URL,
                type: "GET",
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                },
                dataType: 'json'
            }).done(function(data) {
                var qty = data.qty;
                var label = data.label;
                dcChart.data.datasets[0].data = qty;
                dcChart.data.labels = label;
                dcChart.update();
            }).fail(function(response) {});
        })
    </script>

    <script>
        const mc = document.getElementById('month-chart');
        const mcChart = new Chart(mc, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                    label: 'Monthly Sold',
                    data: [],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        $('select[name="product_id"]').on('change', function(e) {
            var id = $(this).val();
            const GET_PRODUCT_URL = '/dashboard/get-product';
            $.ajax({
                url: GET_PRODUCT_URL,
                type: "GET",
                data: {
                    id: id,
                },
                dataType: 'json'
            }).done(function(data) {
                var data = data.dataArr;
                mcChart.data.datasets[0].data = data;
                mcChart.update();
            }).fail(function(response) {});
        })
    </script>
@endsection
