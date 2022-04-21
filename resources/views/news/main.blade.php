<!DOCTYPE html>
<html lang="en">
    @include('news.elements.head')
<body>
<div class="super_container">
    <!-- Header -->
    @include('news.elements.header')
    @yield('content')
    <!-- Footer -->
    @include('news.elements.footer')
</div>
@include('news.elements.script')
</body>
</html>