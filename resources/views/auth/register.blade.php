@extends('layouts.app')
@section('content')
    <div class="login">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Đăng ký') }}">
                        @csrf
                        <h1>Đăng ký</h1>
                        <div>
                            <input id="name" type="text"
                                   placeholder="Nhập tên"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div>
                            <input id="email" type="email"
                                   placeholder="Nhập email"
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
                                   placeholder="Nhập mật khẩu"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input id="password_confirmation" type="password"
                                   placeholder="Nhập lại mật khẩu"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <button type="submit" class="btn btn-info">
                                {{ __('Đăng ký') }}
                            </button>
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