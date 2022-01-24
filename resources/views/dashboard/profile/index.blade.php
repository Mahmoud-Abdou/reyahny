@extends('dashboard.index')
@section('content')
    <h2> {{ __('lang.editProfile') }}</h2>
    <div class="container">
        <div class="row">
            <div class="col">
                @if ($user->image)
                    <img src="/storage/profiles/{{ $user->image }}"class="round" style="width:180px" alt="">
                @else
                <img src="/storage/no_image.jpg"class="round" style="width:180px" alt="">
                @endif
                <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" name="image" class="form-control-file" id="image">
                    </div>           
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>  
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>  
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="password" name="password"  class="form-control" placeholder="{{ __('lang.password') }}">
                    </div>    
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"type="submit"> {{ __('lang.save') }}</button>
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
