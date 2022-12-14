@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')

    <div class="card">
        @if (session('message'))
            <h2 class="text-primary">{{ session('message') }}</h2>
        @endif
        <h1>
            User list
        </h1>
        <div>
            <table class="table table-hover">
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verify</th>
                    <th>Phone</th>
                </tr>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><img src="{{ $item->image_path }}"
                                width="100px" height="100px" alt=""></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->email_verified_at }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $item->id) }}" id="form-delete{{ $item->id }}"
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
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
            </div>
            {{ $users->links() }}
        </div>
    </div>

@endsection
