@extends('main')
@section('title', 'post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Page Heading Secondary Text</h1>
                @foreach($posts as $post)
                <div class="post">
                    @if($post->image !== null)
                        <img src="{{ asset('img/'.$post->image) }}" style="width: 750px; height: 300px;">

                    @else
                        <img src="{{ asset('img/default.png') }}" alt="Image Photo" style=" width: 750px; height: 300px; ">
                    @endif
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <a href="{{ url('post/'.$post->id) }}" class="btn btn-primary">Read More </a>
                    <div class="time">
                        Posted on {{ $post->created_at }} by {{ $post->user->name }}
                    </div>
                </div>
                @endforeach
                {{--<div class="post">--}}
                    {{--<img src="img/default.png" alt="">--}}
                    {{--<h2>Post Title</h2>--}}
                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>--}}
                    {{--<a href="#" class="btn btn-primary">Read More </a>--}}
                    {{--<div class="time">--}}
                        {{--Posted on TIME by MOEMEN-GABALLAH--}}
                    {{--</div>--}}
                {{--</div>--}}

            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    {{--<div class="box">--}}
                        {{--<div class="search">--}}
                            {{--<h3>Search</h3>--}}
                            {{--<div class="se-input">--}}
                                {{--<input type="text" placeholder="Search for...">--}}
                                {{--<a href="#" class="btn btn-primary btn-sm">Go!</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="box">
                        {!! Form::open(array('route' => 'search', 'method' => 'GET')) !!}
                        <div class="se-input">
                        {!! Form::text('search', null,
                                               array('required',
                                                    'class'=>'form-control',
                                                    'placeholder'=>'Search for...')) !!}
                        {!! Form::submit('Search',
                                                   array('class'=>'btn btn-primary btn-sm search')) !!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="box">
                        <div class="category">
                            <h3><a href="{{ url('/category') }}" class="link-cat">Categories</a></h3>
                            <div class="cat">
                                @foreach($categories as $cat)
                                    <span><a href="category/{{ $cat->id }}">{{ $cat->name }}</a></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="side-widget">
                            <h3>Side Widget</h3>
                            <p>You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection