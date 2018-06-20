@extends('main')
@section('title', 'post')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <h1 class="text-center">Create New Category</h1>
                {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name'); !!}
                        {!! Form::text('name', null, ['class' => 'form-control']); !!}
                    </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description'); !!}
                    {!! Form::text('description', null, ['class' => 'form-control']); !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status'); !!}
                    {!! Form::select('status',['0' => 'Disactive', '1' => 'Active'], null,['class' => 'select2-multi form-control','placeholder' => 'Choose Status...'] ); !!}
                </div>
                {!! Form::submit('Create', ['class' => 'btn btn-primary']); !!}
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
@endsection