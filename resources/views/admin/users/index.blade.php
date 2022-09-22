@extends('admin.layouts.app')
@section('title', 'Users')
@section('content')

<div class="card">
    @if (session('message'))
        <h2 class="text-primary">{{session('message')}}</h2>
    @endif
    <h1>
        Users list
    </h1>
    <div>
        <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button href="" class="btn btn-danger">Delete</Button>  
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
        <div>
            <a href="{{ route('users.create') }}" class = "btn btn-primary">Create</a>
        </div>
    </div>
</div>

@endsection