@extends('main')
@section('title', 'edit comment')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2 style="margin-top: 6px; width: 50%; float:left;">Edit Comment</h2>
            <a href="{{ url('/post/create') }}" style="float:right;" class="btn btn-primary pull-right">Create New Post</a>
            <div class="col-md-8 col-md-offset-2">
                {!! Form::model($comment, ['route' => ['comment.update', $comment->id], 'method' => 'PATCH']) !!}
            @if(!Auth::check()){
                <div class="form-group col-md-6">
                    {{ Form::label('user_id', 'Username') }}
                    {{ Form::text('user_id', null, ['class' => 'form-control', 'placeholder' => 'Username']) }}
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Your Email Adress']) }}
                </div>
                }
                @endif
                <input name="post_id" type="hidden" value="{{ $post->id }}">
                <div class="form-group col-md-12">
                    {{ Form::label('body', 'Comment') }}
                    {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Comment ...']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status',['0' => 'Disactive', '1' => 'Active'], null,['class' => 'select2-multi form-control','placeholder' => 'Choose Status...'] ) }}
                </div>

                {{ Form::submit('Create Comment', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection