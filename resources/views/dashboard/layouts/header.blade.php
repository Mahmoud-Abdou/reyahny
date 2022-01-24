<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="SOLID SOLUTIONS">
    <title>{{$titleofpage}}</title>
    <link rel="apple-touch-icon" href="/app-assets-admin/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" href="/{!! asset('images/logo.png') !!}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/vendors/css/vendors.min.css">
      <link rel="stylesheet" type="text/css" href="/app-assets-admin/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/vendors/css/extensions/swiper.min.css">


    <!-- END: Vendor CSS-->
<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.0.0/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.0.0/quill.core.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- BEGIN: Theme CSS-->

    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css{{__('lang.directiontext') == "rtl" ? "-rtl":""}}/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css{{__('lang.directiontext') == "rtl" ? "-rtl":""}}/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css{{__('lang.directiontext') == "rtl" ? "-rtl":""}}/colors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css{{__('lang.directiontext') == "rtl" ? "-rtl":""}}/components.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/themes/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/core/colors/palette-gradient.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/plugins/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/plugins/extensions/swiper.min.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/pages/data-list-view.min.css">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

    {{-- <script src="JsBarcode.all.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="/app-assets-admin/vendors/css/tables/datatable/datatables.min.css">

    {{-- <link rel="stylesheet" type="text/css" href="/app-assets-admin/css/print.min.css"> --}}

@if(__('lang.directiontext') == "rtl" )
      <link rel="stylesheet" type="text/css" href="/app-assets/css-rtl/style.css">
@endif

<style>
table.data-list-view.dataTable tbody tr td:first-child, table.data-thumb-view.dataTable tbody tr td:first-child {
    padding-left: 3rem !important;
    padding-right: 3rem !important;
}
.product-img{
    width: 100px !important;
}
.product-img img{
    width: 100% !important
}
.fa-arrow-down:hover{
    font-size: 15px !important;
    color: #626262 !important
}
.moreimages{
    width: 450px !important;
}
.moreimages img {
    width: 100% !important;
}
.data-items {
    overflow-y: scroll;
}
.showw {
    width: 93% !important;
}
#dataListUpload2 .dzs-success-mark{
    position: absolute;
    width: 40px;
    height: 40px;
    font-size: 30px;
    text-align: center;
    right: -10px;
    top: -10px;
    display: inline-block;

}
#dataListUpload2 span{

    color:red;
    cursor: pointer;
}

#imagesWrapper  > div{
    width:110px !important;
    display:inline-block !important;

}
.btn {
    background-image: none;
    background: #EDBF50;
}
.btn i {
    left : 0px
}
.btn:hover i {
    left: 2px;
    color: #EDBF50;
}
footer.footer .scroll-top:hover i{
    color: white;
    left: 0px;
}
.table-responsive{
    background: white;
    padding-top: 50px;
}
.top {
    margin-bottom : 50px
}
.table-responsive .table tr {
    background : none;
}
table.data-thumb-view.dataTable tbody tr  {
    box-shadow : none;
}
table.data-thumb-view.dataTable tbody tr:hover {
    transform: none;
}
.icon-trash {
    color: red
}
.icon-edit {
    color : #88ff80;
}

th{
    border-bottom: 2px solid black !important;
}
.badge.badge-danger {
  background : #EDBF50;
}
.action-filters .dataTables_length {
  display : inline-block;
}
.action-filters .dataTables_filter {
  display : inline-block;
}
.action-filters .dataTables_filter input {
    padding: 1.45rem 2.8rem!important;
    border-radius: 1.428rem;
    border: 1px solid #DAE1E7;
}
.action-filters .dataTables_filter label {
  position : relative;
}

.action-filters .dataTables_length select {
    width: 8.714rem !important;
    height: 3rem!important;
    border-radius: 1.428rem;
    border: 1px solid #DAE1E7;
    font-size: 1rem !important;
}
table.data-list-view.dataTable thead .sorting:before, table.data-list-view.dataTable thead .sorting_asc:before, table.data-list-view.dataTable thead .sorting_desc:before, table.data-thumb-view.dataTable thead .sorting:before, table.data-thumb-view.dataTable thead .sorting_asc:before, table.data-thumb-view.dataTable thead .sorting_desc:before  {
    left: 0 !important;
}
</style>
    @if(__('lang.directiontext') == "rtl" )
        <link rel="stylesheet" type="text/css" href="/app-assets/css-rtl/style.css">
    @endif
    <!-- END: Custom CSS-->
  <style>
    .main-menu.menu-light .navigation>li.active>a{
      background-color:#EDBF50 !important;
    }
    .brand-logo{

    background: url('{!! asset(session()->get('user.image')) !!}') -65px -54px no-repeat;
    }
    .validate{
      border: 1px solid #ff4545 !important;
    }
    .msg{
        color: #ff4545;
    }
    .customizer-toggle{
      display:none !important;
    }


    table.data-list-view.dataTable tbody tr td:first-child, table.data-thumb-view.dataTable tbody tr td:first-child {
        padding-top: 12px !important;
        padding-bottom: 12px !important;
        padding-left: 7px !important;
    }
    td{
      padding-top: 12px !important;
        padding-bottom: 12px !important;
        padding-left: 7px !important;
    }
    .swal2-confirm .swal2-styled{
      background: transparent !important;
    }
    table.data-list-view.dataTable thead .sorting, table.data-list-view.dataTable thead .sorting_asc, table.data-list-view.dataTable thead .sorting_desc, table.data-thumb-view.dataTable thead .sorting, table.data-thumb-view.dataTable thead .sorting_asc, table.data-thumb-view.dataTable thead .sorting_desc {
        padding-right: 15px;
    }
    a{
      color:black;
    }
  .preloader {
    width : 100%;
    height : 100%;
    position : relative ;
  }
  .load{position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);
    /*change these sizes to fit into your project*/
    width:100px;
    height:100px;
  }
  .load hr{border:0;margin:0;width:40%;height:40%;position:absolute;border-radius:50%;animation:spin 2s ease infinite}

  .load :first-child{background:#19A68C;animation-delay:-1.5s}
  .load :nth-child(2){background:#F63D3A;animation-delay:-1s}
  .load :nth-child(3){background:#FDA543;animation-delay:-0.5s}
  .load :last-child{background:#193B48}

  @keyframes spin{
    0%,100%{transform:translate(0)}
    25%{transform:translate(160%)}
    50%{transform:translate(160%, 160%)}
    75%{transform:translate(0, 160%)}
  }
  body {
    overflow : hidden;
  }
  #imagesWrapper  > div{
    width:110px !important;
    display:inline-block !important;

}
i.feather.icon-book-open{
    color:blue;
}

    .pagination .page-item.active > .page-link{
        background: #468cfb !important;
        color: white !important;
    }
  </style>

<script>

$( document ).ready(function() {
    $('.preloader').fadeOut(600 , function () {
      $('body').css('overflow', 'auto');
    });
    $('.load').fadeOut(500);
});
</script>


</head>
  <body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


  <!-- start preloader section -->
  <div class="preloader">
    <div class="load">
      <hr/><hr/><hr/><hr/>
    </div>
  </div>
  <!-- end preloader section -->


  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
      <div class="navbar-wrapper">
       
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
              <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu ficon"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a></li>
              </ul>
                       <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
{{--                  <img class="img-fluid" src="/app-assets/images/mobicard/search icon.png" alt="search icon">--}}
                </li>
{{--                <li class="nav-item d-none d-lg-block">--}}
{{--                  <input type="text" placeholder="{{ __('lang.search') }}" style="border: none;">--}}
{{--                </li>--}}
              </ul>
            </div>
            <ul class="nav navbar-nav float-right">

              <li class="dropdown dropdown-language nav-item">
                  <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="/profile">{{ __('lang.profile') }}</a>
                    <a class="dropdown-item" href="/logout">{{ __('lang.logout') }}</a>
                  </div>
              {{-- setlang/ar --}}
              {{-- setlang/en --}}
                 <li class="dropdown dropdown-language nav-item">
                    <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          @switch(session()->get('lang'))
                            @case("ar")
                              <i class="flag-icon flag-icon-sa"></i>
                              <span class="selected-language">{{ __('lang.languageAR') }}</span>
                              @break

                            @case("en")
                              <i class="flag-icon flag-icon-us"></i>
                              <span class="selected-language">{{ __('lang.languageEN') }}</span>
                                @break
                            @default
                              <i class="flag-icon flag-icon-us"></i>
                              <span class="selected-language">{{ __('lang.languageEN') }}</span>
                        @endswitch
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                      <a class="dropdown-item" href="/setlang/ar" >
                        <i class="flag-icon flag-icon-sa"></i> {{ __('lang.languageAR') }}</a>
                        <a class="dropdown-item" href="/setlang/en" > <i class="flag-icon flag-icon-us"></i> {{ __('lang.languageEN') }}</a>
                    </div>
              </li>


              <!-- Notify -->


              <li class="dropdown dropdown-user nav-item" id="showElement">
                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                  <span><img class="round" src="/app-assets/images/mobicard/profile.png" alt="avatar" height="40" width="40"></span>
                </a>
              </li>

{{--              <li class="dropdown dropdown-notification nav-item">--}}
{{--                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">--}}
{{--                  <i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up badge-danger">0</span>--}}
{{--                </a>--}}
{{--              </li>--}}


            </ul>
          </div>
        </div>
      </div>
    </nav>


