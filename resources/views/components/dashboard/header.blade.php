
<form action="{{ route('logout') }}" method="post">
@csrf
<nav class="navbar navbar-expand-md navbar-light shadow-sm encoach-header-container d-flex justify-content-around">
    <a class="navbar-brand" href="{{ url('/dashboard') }}">
    {{ config('app.name', 'Laravel') }}
</a>
  <input type="submit" value="ログアウト">
</nav>
</form>



