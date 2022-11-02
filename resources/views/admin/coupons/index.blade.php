@extends('admin.layouts.app')
@section('title', 'Coupons')
@section('content')
    <div class="card">

        @if (session('message'))
            <h1 class="text-primary">{{ session('message') }}</h1>
        @endif


        <h1>
            Coupon list
        </h1>

        <div>
            <table class="table table-hover">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expery date</th>
                    <th>Action</th>
                </tr>

                @foreach ($coupons as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->vale }}</td>
                        <td>{{ $item->expery_date }}</td>
                        <td>
                            <a href="{{ route('coupons.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('coupons.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
                                method="post">
                                @csrf
                                @method('delete')

                            </form>

                            <button class="btn btn-delete btn-danger" data-id={{ $item->id }}>Delete</button>

                        </td>
                    </tr>
                @endforeach
            </table>
            <div>
                <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create</a>
    
            </div>
            {{ $coupons->links() }}
        </div>

    </div>

@endsection
