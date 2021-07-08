@extends('layouts.master')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-4">
            <h3 class="text-center">{{ __('Register') }}</h3>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="text-md-right">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="email" class="">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password" class="">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group row">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">As Seller</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="3">
                            <label class="form-check-label" for="inlineRadio2">As Buyer</label>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
