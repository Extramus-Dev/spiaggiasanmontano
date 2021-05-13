@extends('layouts.adminmaster')

@section('section')
  <div class="paddingTop50">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $set_admin->id }}">
                        <div class="form-group row">
                            <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Minimum Booking Days') }}</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="max_no_days" value="{{ $set_admin->max_no_days }}" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="closing_time" class="col-md-4 col-form-label text-md-right">{{ __('Closing Time') }}</label>
                            <div class="col-md-6">
                                <input type="time" class="form-control" name="closing_time" value="{{ $set_admin->closing_time }}" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adult1_price" class="col-md-4 col-form-label text-md-right">{{ __('Daily Fee') }}</label>
                            <div class="col-md-6">
                                <input type="number" step="0.01" class="form-control" name="daily_fee" value="{{ $set_admin->daily_fee }}" required>

                            </div>
                        </div>
                        <br><hr>
                        <div class="form-group row">
                            <label for="startingtime" class="col-md-4 col-form-label text-md-right">{{ __('Starting Time') }}(m-d-y)</label>
                            <div class="col-md-6">
                                <input type="datetime-local" class="form-control" name="starting_time" value="{{ date("Y-m-d\TH:i", strtotime($set_admin->booking_start)) }}" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="endlingtime" class="col-md-4 col-form-label text-md-right">{{ __('Ending Time') }}(m-d-y)</label>
                            <div class="col-md-6">
                                <input type="datetime-local" class="form-control" name="ending_time" value="{{ date("Y-m-d\TH:i", strtotime($set_admin->booking_end)) }}" required>

                            </div>
                        </div>
                        <br><hr>
                        <div class="form-group row">
                            <label for="seasonStart" class="col-md-4 col-form-label text-md-right">{{ __('Season Start') }}(m-d-y)</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="season_start" value="{{ $set_admin->season_start }}"  required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="seasonEnd" class="col-md-4 col-form-label text-md-right">{{ __('Season End') }}(m-d-y)</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="season_end"  value="{{ $set_admin->season_end }}"  required>
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="float:right;">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div style="padding-top: 150px;"></div>
@endsection
