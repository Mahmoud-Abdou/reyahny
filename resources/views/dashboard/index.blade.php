@include('dashboard.layouts.header')
@include('dashboard.layouts.navbar')
@include('dashboard.layouts.side')
@include('dashboard.layouts.bodystart')
{{-- @include('sweet::alert') --}}

    <!-- Page Content -->
    {{-- <div class="container">

      <div class="row"> --}}

                @yield('content')

                
       
      {{-- </div> --}}
      <!-- /.row -->

    {{-- </div> --}}
    <!-- /.container -->


@include('dashboard.layouts.bodyend')
@include('dashboard.layouts.footer')


<script>

$( document ).ready(function() {

console.log($('.header-fixed .t-header'));
$('.header-fixed .t-header').css('background-color', 'red !important');
});
</script>