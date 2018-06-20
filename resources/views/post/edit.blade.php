@extends('main')
@section('title', 'post')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    {!! Html::style('css/jquery.tag-editor.css') !!}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <h1 class="text-center">Create New Post</h1>
                {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'PATCH', 'files' => true]) !!}
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('body', 'Body') }}
                    {{ Form::text('body', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('image', 'Image') }}
                    {{ Form::file('image', ['class' => 'form-control']) }}
                    @if($post->image !== null)
                    <img src="{{asset('img/'.$post->image)}}" style="width: 200px; height: 200px;">
                    {{--{{ asset('img/default.png') }}--}}
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('category_id', 'Category') }}
                    {{--{{ Form::select('category_id', $categories, $categories->name, ['class' => 'form-control']) }}--}}
                    <select class="form-control" name="category_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('tags', 'Tags') }}
                    {{ Form::text('tags', null, ['class' => 'form-control tag']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status',['0' => 'Disactive', '1' => 'Active'], null,['class' => 'select2-multi form-control','placeholder' => 'Choose Status...'] ) }}
                </div>

                {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('.select2-multi').select2({
            minimumResultsForSearch: -1
        });
        // $('.select2-multi').select2();
    </script>
    {!! Html::script('js/jquery.tag-editor.min.js') !!}
    <script>
        $('.tag').tagEditor();
    </script>
@endsection