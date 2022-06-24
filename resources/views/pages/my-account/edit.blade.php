@extends('laravel-components::layouts.app', ["pageTitle" => "Update My Account"])

@section('content')
    <x-laravel-components-card>
        <x-laravel-components-card-header title="Update My Account" />
        <form method="post" action="{{ route('my-account.update') }}">
            @csrf
            @method('patch')
            <div class="row m-0 p-0">
                <div class="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <x-laravel-components-form-input
                        name="first_name"
                        label="First Name"
                        value="{{ old('first_name', $user->first_name) }}"
                        required="{{ true }}"
                        type="text"
                        :attributes="['attributes' => ['autofocus' => true]]"
                    />
                </div>
                <div class="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <x-laravel-components-form-input
                        name="last_name"
                        label="Last Name"
                        value="{{ old('last_name', $user->last_name) }}"
                        required="{{ true }}"
                        type="text"
                    />
                </div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <x-laravel-components-form-input
                        name="email"
                        label="Email"
                        value="{{ old('email', $user->email) }}"
                        required="{{ true }}"
                        type="email"
                    />
                </div>
            </div>
            <div class="h4 my-3">Optionally Change Password</div>
            <div class="row m-0 p-0">
                <div class="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <x-laravel-components-form-input
                        name="password"
                        label="Password"
                        required="{{ false }}"
                        type="password"
                    />
                </div>
                <div class="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <x-laravel-components-form-input
                        name="password_confirmation"
                        label="Confirm Password"
                        required="{{ false }}"
                        type="password"
                    />
                </div>
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-end">
                <x-laravel-components-button
                    type="submit"
                    label="Submit"
                    :classes="['container' => 'btn-success text-white']"
                />
            </div>
        </form>
    </x-laravel-components-card>
@endsection
