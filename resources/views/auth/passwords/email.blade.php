@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('forgot.sendMail') }}"
                          aria-label="{{ __('Reset Password') }}">
                        @csrf
                        <h1>Email</h1>
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
                        <div class="clearfix"></div>
                        <div>
                            <button type="submit" class="btn btn-info">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                        <div class="clearfix"></div>

                        <div class="separator">
                            <div>
                                <h1><i class="fa fa-paw"></i> Happyness Admin!</h1>
                                <p>©2018 by Magixbow</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
