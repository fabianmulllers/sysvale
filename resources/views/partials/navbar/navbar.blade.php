@if (Auth::check())
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    @include('partials.navbar.navbar-top')

    @if(Auth::user()->type=='admin')
        @include('admin.partials.nav-lateral')
   @endif
    @if(Auth::user()->type=='user')
        @include('usuario.partials.nav-lateral')
    @endif
    @if(Auth::user()->type=='approver')
        @include("approver.partials.nav-lateral")
    @endif
</nav>
@endif