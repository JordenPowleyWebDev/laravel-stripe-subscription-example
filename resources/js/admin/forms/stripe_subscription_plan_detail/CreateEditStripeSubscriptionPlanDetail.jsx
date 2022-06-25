import React, {useState, useRef, useEffect} from 'react';
import axios from "axios";
import {toast} from "react-toastify";
import _ from "lodash";
import Button from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/Button';
import FormInput from '../../../../../vendor/jordenpowleywebdev/laravel-components/resources/js/components/forms/FormInput';

const STRIPE_SUBSCRIPTION_PLAN_DETAIL_DEFAULTS = {
    name:               "",
    stripe_product_id:  "",
    price:              "",
    display_price:      "",
    description:        "",
    tier:               "",
    trial_length_days:  0,
}

const CreateEditStripeSubscriptionPlanDetail = (props) => {
    const {
        stripeSubscriptionPlanDetailId  = null,
        onCancel                        = () => {},
        onComplete                      = () => {},
        onDelete                        = () => {},
        parentId                        = "",
    } = props;

    const prepareDefaultValues = (defaultTier = null) => {
        let stripeSubscriptionPlanDetail = STRIPE_SUBSCRIPTION_PLAN_DETAIL_DEFAULTS;

        if (!!defaultTier) {
            stripeSubscriptionPlanDetail.tier = defaultTier;
        }

        return stripeSubscriptionPlanDetail;
    }

    const [submitting, setSubmitting]                                       = useState(false);
    const [tiers, setTiers]                                                 = useState([]);
    const [stripeSubscriptionPlanDetail, setStripeSubscriptionPlanDetail]   = useState(prepareDefaultValues());
    const [errors, setErrors]                                               = useState(null);

    useEffect(() => {
        load();
    }, [stripeSubscriptionPlanDetailId]);

    const load = () => {
        axios.get(route('web-api.admin.stripeSubscriptionPlanDetail.data', {stripe_subscription_plan_detail_id: stripeSubscriptionPlanDetailId}).toString())
            .then((response) => {
                if (!!response && !!response.data) {
                    if (!!response.data.tiers) {
                        setTiers(response.data.tiers);
                    }

                    if (!!response.data.stripe_subscription_plan_detail) {
                        setStripeSubscriptionPlanDetail(response.data.stripe_subscription_plan_detail);
                    } else {
                        setStripeSubscriptionPlanDetail(prepareDefaultValues(!!response.data.default_tier ? response.data.default_tier : ""));
                    }
                }
            })
            .catch((error) => {
                console.log(error);
                toast.error(<div>{"An error occurred"}</div>);
                setSubmitting(false);
            });
    }

    useEffect(() => {
        if (!!submitting) {
            submit();
        }
    }, [submitting]);

    const reset = () => {
        setStripeSubscriptionPlanDetail(STRIPE_SUBSCRIPTION_PLAN_DETAIL_DEFAULTS);

        setSubmitting(false);
        setErrors(null);
    }

    const payload = () => {
        return {
            method: !!stripeSubscriptionPlanDetailId ? 'patch' : 'post',
            url:    !!stripeSubscriptionPlanDetailId ? route('web-api.admin.stripeSubscriptionPlanDetail.update', {stripeSubscriptionPlanDetail: stripeSubscriptionPlanDetailId}).toString() : route('web-api.admin.stripeSubscriptionPlanDetail.store').toString(),
            data:   {
                ...stripeSubscriptionPlanDetail,
            },
        }
    }

    const submit = () => {
        axios(payload())
            .then((response) => {
                reset();
                onComplete(response.data.stripe_subscription_plan_detail_id);
            })
            .catch((error) => {
                if (!!error.response && !!error.response.data && !!error.response.data.errors) {
                    setErrors(error.response.data.errors);

                    // TODO - Fix React Toasts Not Working
                    toast.error(<div>{!!error.response.data.message ? error.response.data.message : "An error occurred"}</div>);
                }

                setSubmitting(false);
            });
    }

    const handleClose = () => {
        if (!submitting) {
            reset();
            onCancel();
        }
    }

    const onChange = (field, value) => {
        const clone = _.cloneDeep(stripeSubscriptionPlanDetail);

        switch (field) {
            default:
                clone[field] = value;
                break;
        }

        setStripeSubscriptionPlanDetail(clone);
    }

    const renderControls = () => {
        return (
            <div className="mt-3 d-flex align-items-center justify-content-between">
                <Button
                    label={"Cancel"}
                    classes={{container: "btn-secondary text-white"}}
                    type={"on_click"}
                    options={{on_click: () => handleClose()}}
                />
                <Button
                    label={"Save Stripe Subscription Plan Detail"}
                    classes={{container: "btn-success text-white"}}
                    type={"on_click"}
                    options={{on_click: () => setSubmitting(true)}}
                />
            </div>
        );
    }

    return (
        <React.Fragment>
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"name"}
                        label={"Name"}
                        required={true}
                        type={"text"}
                        value={stripeSubscriptionPlanDetail.name}
                        disabled={submitting}
                        onChange={(value) => onChange('name', value)}
                        error={!!errors && !!errors.name ? errors.name : null}
                        inputAttributes={{attributes: {
                            placeholder: "Name to be displayed",
                        }}}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"stripe_product_id"}
                        label={"Stripe Product ID"}
                        required={true}
                        type={"text"}
                        value={stripeSubscriptionPlanDetail.stripe_product_id}
                        disabled={submitting}
                        onChange={(value) => onChange('stripe_product_id', value)}
                        error={!!errors && !!errors.stripe_product_id ? errors.stripe_product_id : null}
                        inputAttributes={{attributes: {
                            placeholder: "GUID From Stripe" ,
                        }}}
                    />
                </div>
            </div>
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"price"}
                        label={"Price"}
                        required={true}
                        type={"number"}
                        value={stripeSubscriptionPlanDetail.price}
                        disabled={submitting}
                        onChange={(value) => onChange('price', value)}
                        error={!!errors && !!errors.price ? errors.price : null}
                        inputAttributes={{attributes: {
                            min: "0",
                            step: "0.01",
                            placeholder: "10.00"
                        }}}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"display_price"}
                        label={"Display Price"}
                        required={true}
                        type={"text"}
                        value={stripeSubscriptionPlanDetail.display_price}
                        disabled={submitting}
                        onChange={(value) => onChange('display_price', value)}
                        error={!!errors && !!errors.display_price ? errors.display_price : null}
                        inputAttributes={{attributes: {
                            placeholder: "£0.00" ,
                        }}}
                    />
                </div>
            </div>
            <div className="row m-0 p-0">
                <div className="col-12 col-md-6 m-0 p-0 pe-md-2">
                    <FormInput
                        name={"tier"}
                        label={"Tier"}
                        required={true}
                        type={"select"}
                        value={stripeSubscriptionPlanDetail.tier}
                        disabled={submitting}
                        onChange={(value) => onChange('tier', value)}
                        inputAttributes={{options: tiers}}
                        error={!!errors && !!errors.tier ? errors.tier : null}
                    />
                </div>
                <div className="col-12 col-md-6 m-0 p-0 ps-md-2">
                    <FormInput
                        name={"trial_length_days"}
                        label={"Trial Length Days"}
                        required={true}
                        type={"number"}
                        value={stripeSubscriptionPlanDetail.trial_length_days}
                        disabled={submitting}
                        onChange={(value) => onChange('trial_length_days', value)}
                        error={!!errors && !!errors.trial_length_days ? errors.trial_length_days : null}
                        inputAttributes={{attributes: {
                            min: "0",
                            step: "1",
                        }}}
                    />
                </div>
            </div>
            <div className="row m-0 p-0">
                <div className="col-12 m-0 p-0">
                    <FormInput
                        name={"description"}
                        label={"Description"}
                        required={true}
                        type={"textarea"}
                        value={stripeSubscriptionPlanDetail.description}
                        disabled={submitting}
                        onChange={(value) => onChange('description', value)}
                        error={!!errors && !!errors.description ? errors.description : null}
                        inputAttributes={{attributes: {
                            rows: "5",
                            placeholder: "Description visible via the subscription widget.",
                        }}}
                    />
                </div>
            </div>
            {renderControls()}
        </React.Fragment>
    );
}

export default CreateEditStripeSubscriptionPlanDetail;
