@extends('laravel-components::layouts.app', ["pageTitle" => "Create User"])

@section('content')
    <x-laravel-components-card>
        <x-laravel-components-card-header title="Create User" />
        <form method="post" action="{{ route('admin.user.store') }}">
            @csrf
            <div class="row m-0 p-0">
                <div class="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <x-laravel-components-form-input
                        name="first_name"
                        label="First Name"
                        value="{{ old('first_name') }}"
                        required="{{ true }}"
                        type="text"
                        :attributes="['attributes' => ['autofocus' => true]]"
                    />
                </div>
                <div class="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <x-laravel-components-form-input
                        name="last_name"
                        label="Last Name"
                        value="{{ old('last_name') }}"
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
                        value="{{ old('email') }}"
                        required="{{ true }}"
                        type="email"
                    />
                </div>
                <div class="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <x-laravel-components-form-input
                        name="role"
                        label="Role"
                        value="{{ old('role') }}"
                        required="{{ true }}"
                        type="select"
                        :attributes="['options' => $roles]"
                    />
                </div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <x-laravel-components-form-input
                        name="password"
                        label="Password"
                        required="{{ true }}"
                        type="password"
                    />
                </div>
                <div class="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <x-laravel-components-form-input
                        name="password_confirmation"
                        label="Confirm Password"
                        required="{{ true }}"
                        type="password"
                    />
                </div>
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-between">
                <x-laravel-components-button
                    type="href"
                    label="Back"
                    :classes="['container' => 'btn-secondary text-white']"
                    :options="['href' => route('admin.user.index')]"
                />
                <x-laravel-components-button
                    type="submit"
                    label="Submit"
                    :classes="['container' => 'btn-success text-white']"
                />
            </div>
        </form>
    </x-laravel-components-card>
@endsection
