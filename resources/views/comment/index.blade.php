@extends('main')
@section('title', 'comment')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2 style="margin-top: 6px; width: 50%; float:left;">Show Comment</h2>
            <a href="{{ url('/post/create') }}" style="float:right;" class="btn btn-primary pull-right">Create New Post</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>user_name</th>
                    <th>email</th>
                    <th>body</th>
                    <th>post_id</th>
                    <th>status</th>
                    <th>created_at</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->user_id}}</td>
                        <td>{{$comment->email }}</td>
                        <td>{{$comment->body }}</td>
                        <td>{{$comment->post->title}}</td>
                        <td>{{$comment->status}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>
                            <a href="{{ route('comment.edit', $comment->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            {{ Form::open(['route' => ['comment.destroy', $comment->id], 'method' => 'DELETE']) }}
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