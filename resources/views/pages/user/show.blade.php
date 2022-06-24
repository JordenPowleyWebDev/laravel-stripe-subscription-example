@extends('laravel-components::layouts.app', ["pageTitle" => $user->name])

@section('content')
    <x-laravel-components-card>
        <x-laravel-components-card-header title="{{ $user->name }}">
            @canany(['update', 'delete', 'restore'], $user)
                <x-laravel-components-dropdown-menu label="Actions" id="topActions">
                    @can('update', $user)
                        <x-laravel-components-dropdown-item label="Edit" href="{{ route('user.edit', ['user' => $user->id]) }}" />
                    @endcan
                    <x-laravel-components-dropdown-divider />
                    @if (filled($user->deleted_at))
                        @can('restore', $user)
                            <x-laravel-components-dropdown-modal
                                label="Restore"
                                modal="restore-user-modal"
                                :classes="['container' => 'text-success']"
                            />
                        @endcan
                    @else
                        @can('delete', $user)
                            <x-laravel-components-dropdown-modal
                                label="Archive"
                                modal="archive-user-modal"
                                :classes="['container' => 'text-danger']"
                            />
                        @endcan
                    @endif
                </x-laravel-components-dropdown-menu>
            @endcanany
        </x-laravel-components-card-header>
        <x-laravel-components-card-data
            :data="[['label' => 'Name', 'value' => $user->name], ['label' => 'Email', 'value' => $user->email], ['label' => 'Role', 'value' => $user->role_name], ['label' => 'Created', 'value' => App\Enums\DateFormats::format($user->created_at, App\Enums\DateFormats::DATE_HM)]]"
        />
    </x-laravel-components-card>
@endsection
@push('modals')
    @if (filled($user->deleted_at))
        @can('restore', $user)
            <x-laravel-components-confirmation-modal
                id="restore-user-modal"
                action="{{ route('user.restore', ['user' => $user->id]) }}"
                method="PATCH"
                title="Restore User"
                confirmationText="Are you sure you wish to restore {{ $user->name }}?"
                confirmationButtonText="Restore"
                :classes="['confirmation-button' => 'btn-success']"
            />
        @endcan
    @else
        @can('delete', $user)
            <x-laravel-components-confirmation-modal
                id="archive-user-modal"
                action="{{ route('user.destroy', ['user' => $user->id]) }}"
                method="DELETE"
                title="Archive User"
                confirmationText="Are you sure you wish to archive {{ $user->name }}?"
                confirmationButtonText="Archive"
                :classes="['confirmation-button' => 'btn-danger']"
            />
        @endcan
    @endif
@endpush
