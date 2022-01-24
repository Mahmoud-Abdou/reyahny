@if(__('lang.directiontext') == "rtl" )
      <link rel="stylesheet" type="text/css" href="/app-assets/css-rtl/style.css">
@endif

@if(__('lang.directiontext') == "ltr" )
      <link rel="stylesheet" type="text/css" href="/app-assets/css/style-ltr.css">
@endif
@php
  // dd($data['user']->roles()->get());
  // dd($data['user']->can('write'));

@endphp
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="/"> 

        

      <img class="img-fluid" src="{!! asset('upload/logo.png') !!}" style="height: 50px; width: 65px; object-fit: contain;">
       <h3 class="brand-text mb-0"> {{  \App\Helper\Helper::settings("app-name")}}</h3>
      
      </li>
      <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
            class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
            class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
            data-ticon="icon-disc"></i>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      {{-- @can("dashboard.page") --}}
        <li class="nav-category-divider  @if($titleofpage == __('lang.control_panel'))  active @endif" style="font-size:15px">
          <a href="/dashboard">
              <span class="link-title">{{ __('lang.control_panel') }}</span>
              <i class="fa fa-tachometer" aria-hidden="true"></i>
          </a>
        </li>
      {{-- @endcan --}}
      {{-- @can("settings.page") --}}
        <li class="nav-category-divider  @if($titleofpage == __('lang.settings'))  active @endif" style="font-size:15px">
          <a href="/settings"><span
              class="link-title">{{ __('lang.settings') }}</span>
              <i class="fa fa-wrench" aria-hidden="true"></i>

          </a>
        </li>
      {{-- @endcan --}}
      {{-- @can("services.page") --}}
        <li class="nav-category-divider  @if($titleofpage == __('lang.services'))  active @endif" style="font-size:15px">
        
          <a href="/categories"><span
              class="link-title">{{ __('lang.categories') }}</span>
              <i class="fa fa-home" aria-hidden="true"></i>

          </a>
        </li>
      {{-- @endcan --}}
      {{-- @can("vendors.page")       --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.vendors'))  active @endif" style="font-size:15px">
        <a href="/vendors"><span
          class="link-products">{{ __('lang.vendors') }}</span>
          <i class="fa fa-user" aria-hidden="true"></i>

        </a>
      </li>
      {{-- @endcan --}}
      {{-- @can("users.page")            --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.users'))  active @endif" style="font-size:15px">
        <a href="/users"><span
          class="link-title">{{ __('lang.users') }}</span>
          <i class="fa fa-users" aria-hidden="true"></i>

        </a>
      </li>
      {{-- @endcan
      @can("cities.page")        --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.cities'))  active @endif" style="font-size:15px">
          <a href="/cities"><span
            class="link-title">{{ __('lang.cities') }}</span>
            <i class="fas fa-city"></i>
            </a>
      </li>
      {{-- @endcan --}}
      {{-- @can("towns.page")         --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.towns'))  active @endif" style="font-size:15px">
          <a href="/towns"><span
            class="link-title">{{ __('lang.towns') }}</span>
            <i class="fas fa-city"></i>
          </a>
      </li>
      {{-- @endcan
      @can("timetable.page")      --}}
        <li class="nav-category-divider  @if($titleofpage == __('lang.timetable'))  active @endif" style="font-size:15px">
            <a href="/timetable"><span
              class="link-title">{{ __('lang.timetable') }}</span>
              <i class="fa fa-clock-o" aria-hidden="true"></i>

            </a>
        </li>
      {{-- @endcan
      @can("bookings.page")      --}}
        <li class="nav-category-divider  @if($titleofpage == __('lang.bookings'))  active @endif" style="font-size:15px">
            <a href="/bookings"><span
              class="link-title">{{ __('lang.bookings') }}</span>
              <i class="far fa-newspaper" aria-hidden="true"></i>        
            </a>
        </li>
      {{-- @endcan
      @can("contact-us.page")      --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.contact_us'))  active @endif" style="font-size:15px">
          <a href="/contact-us"><span
            class="link-title">{{ __('lang.contact_us') }}</span>
            <i class="far fa-id-card" aria-hidden="true"></i>      
            </a>
      </li>
      {{-- @endcan
      @can("notifications.page")       --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.notifications'))  active @endif" style="font-size:15px">
          <a href="/notifications"><span
            class="link-title">{{ __('lang.notifications') }}</span>
            <i class="fas fa-bell-slash" aria-hidden="true"></i>   
            </a>
      </li>
      {{-- @endcan
      @can("packages.page")  --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.packages'))  active @endif" style="font-size:15px">
          <a href="/packages"><span
            class="link-title">{{ __('lang.packages') }}</span>
            <i class="fas fa-box" aria-hidden="true"></i>   
            </a>
      </li>
      {{-- @endcan
      @can("coupons.page")  --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.coupon'))  active @endif" style="font-size:15px">
          <a href="/coupons"><span
            class="link-title">{{ __('lang.coupon') }}</span>
            <i class="fas fa-percentage" aria-hidden="true"></i>     
            </a>
      </li>
      {{-- @endcan
      @can("comments.page") --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.comments'))  active @endif" style="font-size:15px">
          <a href="/comments"><span
            class="link-title">{{ __('lang.comments') }}</span>
            <i class="fas fa-comments" aria-hidden="true"></i>     
            </a>
      </li>
      {{-- @endcan
      @can("reviews.page") --}}
      <li class="nav-category-divider  @if($titleofpage == __('lang.reviews'))  active @endif" style="font-size:15px">
          <a href="/reviews"><span
            class="link-title">{{ __('lang.reviews') }}</span>
            <i class="fas fa-comment-medical"aria-hidden="true"></i>    
            </a>
      </li>
      {{-- @endcan --}}
      @if(auth()->user()->role == "admin")
        <li class="nav-category-divider " >
            
              <a ><span
              class="link-title">{{ __('lang.Roles&Permissions') }}</span>
              </a>
        </li>
        
        <li class="nav-category-divider  @if($titleofpage == __('lang.roles'))  active @endif" style="font-size:15px">
            <a href="/roles"><span
              class="link-title">{{ __('lang.roles') }}</span>
              <i class="fas fa-comment-medical"aria-hidden="true"></i>    
              </a>
        </li>

        <li class="nav-category-divider  @if($titleofpage == __('lang.permissions'))  active @endif" style="font-size:15px">
            <a href="/permissions"><span
              class="link-title">{{ __('lang.permissions') }}</span>
              <i class="fas fa-comment-medical"aria-hidden="true"></i>    
              </a>
        </li>

        <li class="nav-category-divider  @if($titleofpage == __('lang.permission_roles'))  active @endif" style="font-size:15px">
            <a href="/permission_roles"><span
              class="link-title">{{ __('lang.permission_roles') }}</span>
              <i class="fas fa-comment-medical"aria-hidden="true"></i>    
              </a>
        </li>
      @endif

    </ul>
  </div>
</div>
<!-- END: Main Menu-->
