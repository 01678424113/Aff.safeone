@extends('layouts.app')
@section('content')
    <div class="login">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Đăng nhập') }}">
                        @csrf
                        <h1>Đăng nhập</h1>
                        <div>
                            <input id="email" type="email"
                                   placeholder="Enter your email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div>
                            <input id="password" type="password"
                                   placeholder="Enter your password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="hidden">
                            <input type="checkbox"
                                   name="remember"
                                   checked {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <button type="submit" class="btn btn-info">
                                {{ __('Đăng nhập') }}
                            </button>
                            <a class="reset_pass" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div>
                                <h1><i class="fa fa-paw"></i> {{env('NAME_SYSTEM')}}!</h1>
                                <p>©2018 by Louis</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection