@include('partials._head')
@include('partials._nav')
<div id="app">
    <div class="container">@include('partials._messages')</div>
    @yield('content')
</div>
@include('partials._footer')