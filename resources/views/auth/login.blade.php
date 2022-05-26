@extends('layouts.login')

@section('title', 'Login')

@section('content')
<section role="login">
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column col-md-4 col-8 mt-5 pt-5">
            <div class="login-logo mt-5 pt-5">
                <a href="\">
                    <img src="/img/logo/logo.svg" class="img-fluid"/>
                </a>
            </div>
            <div class="login-box-body">
                <h3>{{ __('Login') }}</h3>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group has-feedback">
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                            name="password" 
                            required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-8 col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


