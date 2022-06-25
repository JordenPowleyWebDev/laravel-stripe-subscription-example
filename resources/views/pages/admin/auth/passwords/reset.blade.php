@extends('laravel-components::layouts.pane')

@section('content')
    <x-laravel-components-pane-card title="Reset Password">
        <form method="post" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <x-laravel-components-form-input
                name="email"
                label="Email"
                value="{{ old('email') }}"
                required="{{ true }}"
                type="email"
                :attributes="['attributes' => ['placeholder' => 'Email Address', 'autocomplete' => 'email', 'autofocus' => true]]"
            />
            <x-laravel-components-form-input
                name="password"
                label="New Password"
                required="{{ true }}"
                type="password"
            />
            <x-laravel-components-form-input
                name="password_confirmation"
                label="Confirm Password"
                required="{{ true }}"
                type="password"
                :classes="['container' => 'mb-4']"
            />
            <div class="form-group row mb-0">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                    <x-laravel-components-button
                        type="submit"
                        label="Reset"
                        :classes="['container' => 'mb-2 btn-success text-white']"
                    />
                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </form>
    </x-laravel-components-pane-card>
@endsection
