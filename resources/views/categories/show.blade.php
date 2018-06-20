@extends('main')
@section('title', "$category->name")
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="col-md-12">
        @foreach($posts as $post)
            @if($post->image !== null)
                <img src="{{ asset('img/'.$post->image) }}" style="width: 750px; height: 300px;">

            @else
                <img src="{{ asset('img/default.png') }}" alt="Image Photo" style=" width: 750px; height: 300px; ">
            @endif
        <h1>{{ $post->title }}</h1>
        <p>{!! substr($post->body, 0, 50) !!}</p>
        <a href="{{url('post/'.$post->id)}}" class="btn btn-primary">Show Post</a>
        <div>
            <span class="badge">Posted {{ $post->created_at }}</span><div class="pull-right"><span class="label label-default">alice</span> <span class="label label-primary">story</span> <span class="label label-success">blog</span> <span class="label label-info">personal</span> <span class="label label-warning">Warning</span>
                <span class="label label-danger">Danger</span></div>
        </div>
        <hr>
        @endforeach
    </div>
</div>
@endsection