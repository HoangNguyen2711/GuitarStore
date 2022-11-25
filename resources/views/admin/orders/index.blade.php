@extends('admin.layouts.app')
@section('title', 'Orders')
@section('content')

    <div class="card">

        <h1>
            Orders
        </h1>
        <div class="container-fluid pt-5">

            <div class="col card">
                <div>
                    <table class="table table-hover">
                        <tr>
                            <th>Status</th>
                            <th>No</th>  
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Note</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Product</th>
                            <th>Qty</th>
                            
                        </tr>
                        @foreach ($orders as $item)
                            <tr>
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
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->customer_phone }}</td>
                                <td>{{ $item->customer_email }}</td>
                                <td>{{ $item->customer_address }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->payment }}</td>
                                <td>${{ $item->total }}</td>
                                @foreach ($item->orderdetails as $items)
                                <tr><td>+</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td>{{ $items->product->name }}</td>
                                    <td>{{ $items->quantity }}</td>
                                
                                @endforeach
                                
                            </tr>
                        @endforeach
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
<script>
$(function () {
    $(document).on("change", ".select-status", function (e) {
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
