import React, {useState, useRef, useEffect} from 'react';
import ReactDOM from "react-dom";
import Card from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Card';
import Header from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/layout/card/Header';
import CreateEditStripeSubscriptionPlanDetail from "../../forms/stripe_subscription_plan_detail/CreateEditStripeSubscriptionPlanDetail";

const CreateEditStripeSubscriptionPlanDetailPage = (props) => {
    const {
        stripeSubscriptionPlanDetailId = null,
    } = props;

    const handleCancel = () => {
        if (!!stripeSubscriptionPlanDetailId) {
            window.location.replace(route('admin.stripeSubscriptionPlanDetail.show', {
                stripeSubscriptionPlanDetail: stripeSubscriptionPlanDetailId,
            }).toString());
        } else {
            window.location.replace(route('admin.stripeSubscriptionPlanDetail.index').toString());
        }
    }

    const handleComplete = (stripeSubscriptionPlanDetailId) => {
        window.location.replace(route('admin.stripeSubscriptionPlanDetail.show', {
            stripeSubscriptionPlanDetail: stripeSubscriptionPlanDetailId,
        }).toString());
    }

    const handleDelete = () => {
        window.location.replace(route('admin.stripeSubscriptionPlanDetail.index').toString());
    }

    return (
        <Card>
            <Header title={!!stripeSubscriptionPlanDetailId ? "Edit Stripe Subscription Plan Detail" : "Create Stripe Subscription Plan Detail"} />
            <CreateEditStripeSubscriptionPlanDetail
                stripeSubscriptionPlanDetailId={stripeSubscriptionPlanDetailId}
                onCancel={() => handleCancel()}
                onComplete={(stripeSubscriptionPlanDetail) => handleComplete(stripeSubscriptionPlanDetail)}
                onDelete={() => handleDelete()}
                parentId={"create-edit-stripe-subscription-plan-detail-page"}
            />
        </Card>
    )
}

export default CreateEditStripeSubscriptionPlanDetailPage;

const target = document.getElementById('create-edit-stripe-subscription-plan-detail-page');
if (target) {
    let {
        stripeSubscriptionPlanDetailId = null,
    } = target.dataset;

    ReactDOM.render(
        <CreateEditStripeSubscriptionPlanDetailPage
            stripeSubscriptionPlanDetailId={!!stripeSubscriptionPlanDetailId && stripeSubscriptionPlanDetailId !== "" ? stripeSubscriptionPlanDetailId : null}
        />
    , target);
}
