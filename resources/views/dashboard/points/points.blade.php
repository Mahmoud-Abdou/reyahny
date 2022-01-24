@extends('dashboard.index')
@section('content')

       <!-- // Basic Floating Label Form section start -->
       <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('lang.editPoints') }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form"action="points/save" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="first-name-floating" class="form-control" placeholder="{{ __('lang.amountCurrency') }}" value="{{$point->amount_of_currency}}"  name="amount_of_currency">
                                                <label for="first-name-floating">{{ __('lang.amountCurrency') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="email-id-floating" class="form-control" value="{{$point->amount_of_points}}"  name="amount_of_points" placeholder="{{ __('lang.amountPoints') }}">
                                                <label for="email-id-floating">{{ __('lang.amountPoints') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number" value="{{$point->rank_number}}"  class="form-control solid_up_required" name="rank_number">
                                                <label for="edit-phone">{{ __('lang.rankNumber') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number"value="{{$point->rank_number_silver}}"  class="form-control solid_up_required" name="rank_number_silver">
                                                 <label for="edit-name">{{ __('lang.rankNumberSilver') }}</label>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number" value="{{$point->rank_number_gold}}" class="form-control solid_up_required" name="rank_number_gold">
                                                <label for="edit-name">{{ __('lang.rankNumberGold') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="number" value="{{$point->rank_number_bronze}}" class="form-control solid_up_required" name="rank_number_bronze">
                                                <label for="edit-name">{{ __('lang.rankNumberBronze') }}</label>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 mb-1">{{ __('lang.update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>







@endsection
