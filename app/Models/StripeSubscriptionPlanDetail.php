<?php

namespace App\Models;

use App\Subscription\SubscriptionTiers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StripeSubscriptionDetail
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $stripe_product_id
 * @property int $price
 * @property string $display_price
 * @property string $description
 * @property string $tier
 * @property int $trial_length_days
 * @property string $created_at
 * @property string $updated_at
 */
class StripeSubscriptionPlanDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'stripe_product_id',
        'price',
        'display_price',
        'description',
        'tier',
        'trial_length_days',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'access'        => SubscriptionTiers::class,
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
