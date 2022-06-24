<?php

namespace App\Http\Requests\Admin\StripeSubscriptionPlanDetail;

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
            // TODO - Populate
        ];
    }
}
