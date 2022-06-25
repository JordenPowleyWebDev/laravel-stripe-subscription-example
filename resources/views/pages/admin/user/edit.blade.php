@extends('laravel-components::layouts.app', ["pageTitle" => "Update User"])

@section('content')
    <div id="create-edit-user-page" class="w-100" data-user-id="{{ $user->id }}"></div>
@endsection
