@extends('main')
@section('title', 'post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Page Heading Secondary Text</h1>

                <div class="post">
                    <img src="img/default.png" alt="">
                    <h2>Post Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a href="#" class="btn btn-primary">Read More </a>
                    <div class="time">
                        Posted on TIME by MOEMEN-GABALLAH
                    </div>
                </div>

                <div class="post">
                    <img src="img/default.png" alt="">
                    <h2>Post Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a href="#" class="btn btn-primary">Read More </a>
                    <div class="time">
                        Posted on TIME by MOEMEN-GABALLAH
                    </div>
                </div>

                <div class="post">
                    <img src="img/default.png" alt="">
                    <h2>Post Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a href="#" class="btn btn-primary">Read More </a>
                    <div class="time">
                        Posted on TIME by MOEMEN-GABALLAH
                    </div>
                </div>

                <div class="post">
                    <img src="img/default.png" alt="">
                    <h2>Post Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a href="#" class="btn btn-primary">Read More </a>
                    <div class="time">
                        Posted on TIME by MOEMEN-GABALLAH
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    <div class="box">
                        <div class="search">
                            <h3>Search</h3>
                            <div class="se-input">
                                <input type="text" placeholder="Search for...">
                                <a href="#" class="btn btn-primary btn-sm">Go!</a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="category">
                            <h3><a href="{{ url('/category') }}" class="link-cat">Categories</a></h3>
                            <div class="cat">
                                @foreach($categories as $cat)
                                    <span><a href="">{{ $cat->name }}</a></span>
                                @endforeach
                                {{--<span><a href="">JavaScript</a></span>--}}
                                {{--<span><a href="">Html</a></span>--}}
                                {{--<span><a href="">Css</a></span>--}}
                                {{--<span><a href="">Freebies</a></span>--}}
                                {{--<span><a href="">Tutorials</a></span>--}}
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