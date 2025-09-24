<!DOCTYPE html>
<html lang="en">

<head>
  @include('back.include.meta')
</head>

<body>
  @include('back.include.sidebar')
  <div class="wrapper d-flex flex-column min-vh-100">
    @include('back.include.nav')
    <div class="body flex-grow-1">
      <div class="container-lg px-4">

        @yield('content')

      </div>
    </div>
  @include('back.include.footer')
  </div>
  @include('back.include.script')
</body>

</html>
