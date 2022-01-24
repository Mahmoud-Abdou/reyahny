

<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Mode With solid Solutions Egypt .">
    <meta name="keywords" content="Mode, solid Solutions Egypt">
    <meta name="author" content="solid Solutions Egypt ">
        <title>{{$titleofpage}}</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.html">
    @if (isset($settings->logo))
    <link rel="shortcut icon" href="{{ $settings->logo}}">
    @else
    <link rel="shortcut icon" href="upload/logo.png">
    @endif
  
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/style-ltr.css">
    
    @if(__('lang.directiontext') == "rtl" )
        <link rel="stylesheet" type="text/css" href="/app-assets/css-rtl/style.css">
    @endif
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <!-- END: Custom CSS-->
<style>

</style>
</head>

<body
  class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
  data-open="click" data-menu="vertical-menu-modern" data-col="1-column" style="display: grid; align-content: center;">


        <!-- start login -->
        <section class="login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <div class="row parent">
                            <div class="col-md-12 text-center">
                                @if(  isset($settings->logo) )
                                    <img class="img-fluid" src="{{ $settings->logo }}">
                                @else
                                    <img class="img-fluid" src="{!! asset('upload/logo.png') !!}">
                                @endif
                                <h5>! <bdi>{{ __('lang.welcome_back') }}</bdi></h5>
                                <p>{{ __('lang.login_to_your_account') }}</p>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- for the session messages --}}
                                @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">{{ __('lang.'.session()->get('success')) }}</div>
                                @elseif (session()->has('danger'))
                                <div class="alert alert-danger" role="alert">{{ __('lang.'.session()->get('danger')) }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 form">
                                <form method="POST" action="user-login">
                                    {{ csrf_field() }}
                                    <label>{{ __('lang.phone') }}</label>
                                    <input type="text" class="form-control"  name="email" id="email"
                                    placeholder="{{ __('lang.phone') }}"onfocus="this.placeholder=''" onblur="this.placeholder='{{ __('lang.username') }}'" required>
                                    <label>{{ __('lang.password') }}</label>
                                     <input type="password" name="password"  id="password" class=" form-control" 
                                      placeholder="{{ __('lang.password') }}" onfocus="this.placeholder=''"
                                      onblur="this.placeholder='{{ __('lang.password') }}'">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="form-control" id="submit">{{ __('lang.login') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end login -->


        


  <!-- BEGIN: Vendor JS-->
  <script src="app-assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  <!-- END: Page Vendor JS-->

  <!-- BEGIN: Theme JS-->
  <script src="app-assets/js/core/app-menu.min.js"></script>
  <script src="app-assets/js/core/app.min.js"></script>
  <script src="app-assets/js/scripts/components.min.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  <!-- END: Page JS-->





<script>
 
    toggleChevron = function(button) {
      $("#eyebutton").toggleClass('mdi-eye mdi-eye-off');
      var pwdType = jQuery("#password").attr("type");
        var newType = (pwdType === "password")?"text":"password";
        jQuery("#password").attr("type", newType);

    }
</script>


<script>
var myHeight = window.outerHeight ;
$('.right-items').css('height', myHeight + 'px');




</script>


</body>
 

</html>

