<?php

namespace App\Http\Requests\Admin\StripeSubscriptionPlanDetail;

use App\Subscription\SubscriptionTiers;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class UpdateStripeSubscriptionPlanDetailRequest
 * @package App\Http\Requests\Admin\Management
 */
class UpdateStripeSubscriptionPlanDetailRequest extends FormRequest
{
    /**
     * UpdateStripeSubscriptionPlanDetailRequest::authorize()
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * UpdateStripeSubscriptionPlanDetailRequest::rules()
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'stripe_product_id' => [
                'required',
                'string',
                'max:255',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'display_price' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'tier' => [
                'required',
                'string',
                new EnumValue(SubscriptionTiers::class),
            ],
            'trial_length_days' => [
                'required',
                'numeric',
                'min:0'
            ],
        ];
    }
}
