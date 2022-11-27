@extends('admin.layouts.app')

@section('content')
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
                        +{{ (($productToday - $productYesterday) / $productYesterday) * 100 }}%</span> than yesterday</p>
                @else
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        {{ (($productToday - $productYesterday) / $productYesterday) * 100 }}% </span> than yesterday</p>
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
                <h4 class="mb-0">{{ $moneyToday }}</h4>
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
                    <p class="text-sm mb-0 text-capitalize">Monthly User</p>
                    <h4 class="mb-0">{{ $userCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                    @if ($userCountMonth - $userLastMonth >= 0)
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            +{{ (($userCountMonth - $userLastMonth) / $userLastMonth) * 100 }}%</span> than last month</p>
                    @else
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                            {{ (($userCountMonth - $userLastMonth) / $userLastMonth) * 100 }}% </span> than last month</p>
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
                    <p class="text-sm mb-0 text-capitalize">Monthly Orders</p>
                    <h4 class="mb-0">{{ $orderCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                     @if ($orderCountMonth - $userLastMonth >= 0)
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            +{{ (($orderCountMonth - $orderLastMonth) / $orderLastMonth) * 100 }}%</span> than last month</p>
                    @else
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                            {{ (($orderCountMonth - $orderLastMonth) / $orderLastMonth) * 100 }}% </span> than last month</p>
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
                    <p class="text-sm mb-0 text-capitalize">Monthly Products</p>
                    <h4 class="mb-0">{{ $productCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($userLastMonth > 0)
                    @if ($orderCountMonth - $userLastMonth >= 0)
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            +{{ (($productCountMonth - $productLastMonth) / $productLastMonth) * 100 }}%</span> than last month
                    </p>
                    @else
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                            {{ (($productCountMonth - $productLastMonth) / $productLastMonth) * 100 }}% </span> than last month
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
                    <p class="text-sm mb-0 text-capitalize">Monthly Money</p>
                    <h4 class="mb-0">{{ $moneyCountMonth }}</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                @if ($moneyLastMonth > 0)
                    @if ($moneyCountMonth - $moneyLastMonth >= 0)
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                            +{{ (($moneyCountMonth - $moneyLastMonth) / $moneyLastMonth) * 100 }}%</span> than last month</p>
                    @else
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                            {{ (($moneyCountMonth - $moneyLastMonth) / $moneyLastMonth) * 100 }}% </span> than last month</p>
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
                <p class="text-sm mb-0 text-capitalize">Yearly User</p>
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
                <p class="text-sm mb-0 text-capitalize">Yearly Orders</p>
                <h4 class="mb-0">{{ $orderCountYear }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            @if ($orderLastYear > 0)
                @if ($orderCountYear - $orderLastYear >= 0)
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                        +{{ (($orderCountYear - $orderLastYear) / $orderLastYear) * 100 }}%</span> than last year</p>
                @else
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        {{ (($orderCountYear - $orderLastYear) / $orderLastYear) * 100 }}% </span> than last year</p>
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
                <p class="text-sm mb-0 text-capitalize">Yearly Products</p>
                <h4 class="mb-0">{{ $productCountYear }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            @if ($productLastYear > 0)
                @if ($productCountYear - $productLastYear >= 0)
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                        +{{ (($productCountYear - $productLastYear) / $productLastYear) * 100 }}%</span> than last year</p>
                @else
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        {{ (($productCountYear - $productLastYear) / $productLastYear) * 100 }}% </span> than last year</p>
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
                <p class="text-sm mb-0 text-capitalize">Yearly Money</p>
                <h4 class="mb-0">{{ $moneyCountYear }}</h4>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            @if ($moneyLastYear > 0)
                @if ($moneyCountYear - $moneyLastYear >= 0)
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">
                        +{{ (($moneyCountYear - $moneyLastYear) / $moneyLastYear) * 100 }}%</span> than last year</p>
                @else
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">
                        {{ (($moneyCountYear - $moneyLastYear) / $moneyLastYear) * 100 }}% </span> than last year</p>
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
