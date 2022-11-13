@extends('admin.layouts.app')

@section('content')
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                    <h4 class="mb-0">$53k</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                    <h4 class="mb-0">2,300</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than lask month</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">New Clients</p>
                    <h4 class="mb-0">3,462</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-header p-3 pt-2">
                <div
                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Sales</p>
                    <h4 class="mb-0">$103,430</h4>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
            </div>
        </div>
    </div>
    <div class="card mt-4">

        <h1>
            Orders
        </h1>
        <div class="container-fluid pt-5">
            <div class="col card">
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Note</th>
                            <th>Payment</th>
                            <th>Status</th>


                        </tr>

                        @foreach ($orderPending as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_phone }}</td>
                                <td>{{ $item->customer_email }}</td>
                                <td>{{ $item->customer_address }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->size }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ $item->total }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->payment }}</td>
                                <td>
                                    <div class="input-group input-group-static mb-4">
                                        <select name="status" class="form-control select-status"
                                            data-action="{{ route('admin.orders.update_status', $item->id) }}">
                                            @foreach (config('order.status') as $status)
                                                <option value="{{ $status }}"
                                                    {{ $status == $item->status ? 'selected' : '' }}>{{ $status }}
                                                </option>
                                            @endforeach
                                        </select>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $orderPending->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $(document).on("change", ".select-status", function(e) {
                e.preventDefault();
                let url = $(this).data("action");
                let data = {
                    status: $(this).val(),
                };

                $.post(url, data, (res) => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Success!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });
            });
        });
    </script>
@endsection
