@extends('laravel-components::layouts.app', ["pageTitle" => $stripeSubscriptionPlanDetail->name])

@section('content')
    <x-laravel-components-card>
        <x-laravel-components-card-header title="{{ $stripeSubscriptionPlanDetail->name }}">
            @canany(['update', 'delete', 'restore'], $stripeSubscriptionPlanDetail)
                <x-laravel-components-dropdown-menu label="Actions" id="topActions">
                    @can('update', $stripeSubscriptionPlanDetail)
                        <x-laravel-components-dropdown-item label="Edit" href="{{ route('admin.stripeSubscriptionPlanDetail.edit', ['stripeSubscriptionPlanDetail' => $stripeSubscriptionPlanDetail->id]) }}" />
                    @endcan
                    <x-laravel-components-dropdown-divider />
                    @if (filled($stripeSubscriptionPlanDetail->deleted_at))
                        @can('restore', $stripeSubscriptionPlanDetail)
                            <x-laravel-components-dropdown-modal
                                label="Restore"
                                modal="restore-stripe-subscription-plan-detail-modal"
                                :classes="['container' => 'text-success']"
                            />
                        @endcan
                    @else
                        @can('delete', $stripeSubscriptionPlanDetail)
                            <x-laravel-components-dropdown-modal
                                label="Archive"
                                modal="archive-stripe-subscription-plan-detail-modal"
                                :classes="['container' => 'text-danger']"
                            />
                        @endcan
                    @endif
                </x-laravel-components-dropdown-menu>
            @endcanany
        </x-laravel-components-card-header>
        <x-laravel-components-card-data
            :data="[['label' => 'Name', 'value' => $stripeSubscriptionPlanDetail->name]]]"
        />
    </x-laravel-components-card>
@endsection
@push('modals')
    @if (filled($stripeSubscriptionPlanDetail->deleted_at))
        @can('restore', $stripeSubscriptionPlanDetail)
            <x-laravel-components-confirmation-modal
                id="restore-stripe-subscription-plan-detail-modal"
                action="{{ route('admin.stripeSubscriptionPlanDetail.restore', ['stripeSubscriptionPlanDetail' => $stripeSubscriptionPlanDetail->id]) }}"
                method="PATCH"
                title="Restore Stripe Subscription Plan Detail"
                confirmationText="Are you sure you wish to restore {{ $stripeSubscriptionPlanDetail->name }}?"
                confirmationButtonText="Restore"
                :classes="['confirmation-button' => 'btn-success']"
            />
        @endcan
    @else
        @can('delete', $stripeSubscriptionPlanDetail)
            <x-laravel-components-confirmation-modal
                id="archive-stripe-subscription-plan-detail-modal"
                action="{{ route('admin.stripeSubscriptionPlanDetail.destroy', ['stripeSubscriptionPlanDetail' => $stripeSubscriptionPlanDetail->id]) }}"
                method="DELETE"
                title="Archive Stripe Subscription Plan Detail"
                confirmationText="Are you sure you wish to archive {{ $stripeSubscriptionPlanDetail->name }}?"
                confirmationButtonText="Archive"
                :classes="['confirmation-button' => 'btn-danger']"
            />
        @endcan
    @endif
@endpush
