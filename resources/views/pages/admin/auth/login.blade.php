@extends('laravel-components::layouts.pane')

@section('content')
    <x-laravel-components-pane-card title="Login">
        <form method="post" action="{{ route('admin.login') }}">
            @csrf
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
                label="Password"
                required="{{ true }}"
                type="password"
                :classes="['container' => 'mb-4']"
                :attributes="['attributes' => ['autocomplete' => 'current-password']]"
            />
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <x-laravel-components-button
                        type="submit"
                        label="Login"
                        :classes="['container' => 'btn-success text-white']"
                    />
                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </form>
    </x-laravel-components-pane-card>
@endsection
