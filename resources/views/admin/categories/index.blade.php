@extends('admin.layouts.app')
@section('title', 'Categories')
@section('content')

<div class="card">
    @if (session('message'))
        <h2 class="text-primary">{{session('message')}}</h2>
    @endif
    <h1>
        Category list
    </h1>
    <div>
        <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Parent Name</th>
                <th>Action</th>
            </tr>
            @foreach ($categories as $item)
                <tr>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->parent_name}}</td>
                    <td>
                        <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit" {{ $item->id }}>Delete</Button>  
                        </form>
                        
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $categories->links() }}
        <div>
            <a href="{{ route('categories.create') }}" class = "btn btn-primary">Create</a>
        </div>
    </div>
</div>

@endsection