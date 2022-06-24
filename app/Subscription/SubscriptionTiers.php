<?php

namespace App\Subscription;

use BenSampo\Enum\Enum;
use Illuminate\Support\Str;
use JordenPowleyWebDev\LaravelPermissionHelper\Enums\UserRolesInterface;

/**
 * Class SubscriptionTiers
 * @package App\Enums
 */
final class SubscriptionTiers extends Enum implements UserRolesInterface
{
    const FREE      = "free";
    const REGULAR   = "regular";
    const PREMIUM   = "premium";

    /**
     * SubscriptionTiers::asJsArray()
     *
     * @return string[]
     */
    public static function asJsArray(): array
    {
        return [
            'FREE'      => self::FREE,
            'REGULAR'   => self::REGULAR,
            'PREMIUM'   => self::PREMIUM,
        ];
    }

    /**
     * SubscriptionTiers::toLabel()
     *
     * @param $value
     * @return string
     */
    public static function toLabel($value): string
    {
        return Str::title($value);
    }

    /**
     * SubscriptionTiers::toInputArray()
     *
     * @return array
     */
    public static function toInputArray(): array
    {
        $response = [];
        $values = self::getValues();

        foreach ($values as $value) {
            $response[] = [
                "label" => self::toLabel($value),
                "value" => $value,
            ];
        }

        return $response;
    }
}
