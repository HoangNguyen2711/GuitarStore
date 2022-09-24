@extends('admin.layouts.app')
@section('title', 'Roles')
@section('content')

<div class="card">
    @if (session('message'))
        <h2 class="text-primary">{{session('message')}}</h2>
    @endif
    <h1>
        Roles list
    </h1>
    <div>
        <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Action</th>
            </tr>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id}}</td>
                    <td>{{ $role->name}}</td>
                    <td>{{ $role->display_name}}</td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" id="form-delete{{ $role->id }}" method="post">
                        @csrf
                        @method('delete')

                        </form>
                        <button class="btn btn-delete btn-danger" data-id={{ $role->id }}>Delete</button> 
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $roles->links() }}
        <div>
            <a href="{{ route('roles.create') }}" class = "btn btn-primary">Create</a>
        </div>
    </div>
</div>

@endsection
