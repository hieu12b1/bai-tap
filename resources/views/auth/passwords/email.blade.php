@extends('layouts.app')

@section('title')
    Recover your password
@endsection

@section('content')
    <h2>Recover your password</h2>
    <div class="fxt-form">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-1">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="fxt-transformY-50 fxt-transition-delay-4">
                    <button type="submit" class="fxt-btn-fill">Send Me Email</button>
                </div>
            </div>
        </form>
    </div>
    <div class="fxt-footer">
        <div class="fxt-transformY-50 fxt-transition-delay-9">
            <p>Don't have an account?<a href="{{ route('register') }}" class="switcher-text2 inline-text">Register</a></p>
        </div>
    </div>
@endsection
