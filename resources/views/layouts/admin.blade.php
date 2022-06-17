<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
	@include('includes.header')
	@include('includes.sidebar')
	@yield('content')
	@include('includes.footer')
	</body>
</html>