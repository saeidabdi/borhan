@include('teacher.header')

@yield('content')

<loading :active.sync="isLoading" 
         color="#fff"
         background-color="#000"
         loader="dots"></loading>
@include('teacher.footer')