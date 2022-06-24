@extends('laravel-components::layouts.pane')

@section('content')
    <x-laravel-components-pane-card title="Forgot Password">
        <form method="post" action="{{ route('password.email') }}">
            @csrf
            <x-laravel-components-form-input
                name="email"
                label="Email"
                value="{{ old('email') }}"
                required="{{ true }}"
                type="email"
                :classes="['container' => 'mb-4']"
                :attributes="['attributes' => ['placeholder' => 'Email Address', 'autocomplete' => 'email', 'autofocus' => true]]"
            />
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <x-laravel-components-button
                        type="submit"
                        label="Reset"
                        :classes="['container' => 'btn-success text-white']"
                    />
                    <a class="btn btn-link" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
            </div>
        </form>
    </x-laravel-components-pane-card>
@endsection
