@extends('main')
@section('title', 'post')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2 style="margin-top: 6px; width: 50%; float:left;">Show Category</h2>
            <a href="{{ url('/category/create') }}" style="float:right;" class="btn btn-primary pull-right">Create New Category</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User_id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->user->name }}</td>
                    <td>{{$cat->name }}</td>
                    <td>{{$cat->description}}</td>
                    <td>{{$cat->status}}</td>
                    <td>{{$cat->created_at}}</td>
                    <td>
                        <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        {{ Form::open(['route' => ['category.destroy', $cat->id], 'method' => 'DELETE']) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) }}
                        {{ Form::close() }}
                        {{--<a href="{{ route('category.destroy', $cat->id) }}" class="btn btn-xs btn-danger"> Delete</a>--}}
                    </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection