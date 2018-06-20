@extends('main')
@section('title', 'post')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {!! Html::style('css/jquery.tag-editor.css') !!}
    <script src='https://www.google.com/recaptcha/api.js'></script>

@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-push-2">
                @if($post->image !== null)
                <img src="{{ asset('img/'.$post->image) }}" style="width: 750px; height: 300px;">

                @else
                    <img src="{{ asset('img/default.png') }}" alt="Image Photo" style=" width: 750px; height: 300px; ">
                @endif
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <hr>
                <div class="show-comment">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h3>Comment</h3>
                            @foreach($comments as $comment)
                                <ul>
                                    <li>{{ $comment->user_id }}</li>
                                    <li>{{ $comment->email }}</li>
                                    <li>{{ $comment->body }}</li>
                                    <li>{{ $comment->created_at }}</li>
                                </ul>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <div class="row">
                    <div class="col-md-10 text-center">
                        <h1 class="text-center">Create New Comment</h1>
                        {!! Form::open(['route' => 'comment.store', 'method' => 'POST']) !!}
                        @if(!Auth::check())
                        <div class="form-group col-md-6">
                            {{ Form::label('user_id', 'Username') }}
                            {{ Form::text('user_id', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email Adress']) }}
                        </div>
                        @endif
                        <input name="post_id" type="hidden" value="{{ $post->id }}">
                        <div class="form-group col-md-12">
                            {{ Form::label('body', 'Comment') }}
                            {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Comment ...']) }}
                        </div>

                        <div class="form-group col-md-12">
                            <div class="g-recaptcha" data-sitekey="6Lfh81gUAAAAADOvyEXCiNRHwFAKrn2OVlzQwK5D"></div>
                        </div>
                        {{ Form::submit('Create Comment', ['class' => 'btn btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection