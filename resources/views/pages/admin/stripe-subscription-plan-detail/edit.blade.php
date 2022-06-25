@extends('laravel-components::layouts.app', ["pageTitle" => "Update Stripe Subscription Plan Detail"])

@section('content')
    <div id="create-edit-stripe-subscription-plan-detail-page"
         class="w-100"
         data-stripe-subscription-plan-detail-id="{{ $stripeSubscriptionPlanDetail->id }}"
    ></div>
@endsection
