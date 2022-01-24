@extends('dashboard.index')
@section('content')

<form action="/settings/update" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-4"> 
            <input type="hidden" name="id" value="{{ $settings->id }}">
            <div class="form-group">
                <label for="phone">{{ __('lang.phone') }}</label>
                 <input type="number" name="phone" class="form-control" value="{{ $settings->phone}}" required>
            </div>
        </div>
        <div class="col-4"> 
            <div class="form-group">
                <label for="facebook">{{ __('lang.facebook_links') }}</label>
                <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook_link}}" required>
            </div>
        </div>
        <div class="col-4"> 
            <div class="form-group">
                <label for="whatsapp">{{ __('lang.whatsapp_link') }}</label>
                <input type="text" name="whatsapp" class="form-control" value="{{ $settings->whatsapp_link}}" required>
            </div>
        </div>
        <div class="col-4"> 
            <div class="form-group">
                <label for="location">{{ __('lang.location') }}</label>
                <input type="string" name="location" class="form-control" value="{{ $settings->location_lat}}"required>
            </div>
        </div>

        <div class="col-4"> 
            <div class="form-group">
                <label for="logo">{{ __('lang.logo') }}</label>
                <input type="file" name="file" class="form-control-file">
            </div>
        </div>

        <div class="col-4"> 
            <div class="form-group">
                <label for="app_name">{{ __('lang.app_name') }}</label>
                <input type="text" name="app_name" class="form-control-file" value="{{ $settings->app_name }}">
            </div>
        </div>
        <div class="col-4">
            @if (isset($settings->logo))
                 <img src="{{$settings->logo }}" alt="" class="img-fluid">
            @endif
        </div>
    </div>

    <div class="col-4">
        <button type="submit" class="btn btn-primary">{{ __('lang.save') }} </button>
    </div>


</form>
@endsection