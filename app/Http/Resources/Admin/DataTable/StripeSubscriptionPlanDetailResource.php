<?php

namespace App\Http\Resources\Admin\DataTable;

use App\Enums\DateFormats;
use App\Models\StripeSubscriptionPlanDetail;
use App\Subscription\SubscriptionTiers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StripeSubscriptionPlanDetailResource
 */
class StripeSubscriptionPlanDetailResource extends JsonResource
{
    /**
     * StripeSubscriptionPlanDetailResource::toArray().
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        /** @var StripeSubscriptionPlanDetail $this */
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'stripe_product_id' => $this->stripe_product_id,
            'price'             => $this->price,
            'display_price'     => $this->display_price,
            'description'       => $this->description,
            'tier'              => SubscriptionTiers::toLabel($this->tier->value),
            'trial_length_days' => $this->trial_length_days,
            'created_at'        => DateFormats::format($this->created_at, DateFormats::DB),
            'deleted_at'        => $this->when(($this->deleted_at !== null), DateFormats::format($this->deleted_at, DateFormats::DB)),
            'can'               => $this->permissions_array,
        ];
    }
}
