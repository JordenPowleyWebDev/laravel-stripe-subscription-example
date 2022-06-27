<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Str;
use JordenPowleyWebDev\LaravelPermissionHelper\Enums\UserRolesInterface;

/**
 * Class UserRoles
 * @package App\Enums
 */
final class UserRoles extends Enum implements UserRolesInterface
{
    const CUSTOMER      = "customer";
    const USER          = "user";
    const ADMIN         = "admin";
    const SUPER_ADMIN   = "super_admin";

    /**
     * UserRoles::asJsArray()
     *
     * @return string[]
     */
    public static function asJsArray(): array
    {
        return [
            'SUPER_ADMIN'   => self::SUPER_ADMIN,
            'ADMIN'         => self::ADMIN,
            'USER'          => self::USER,
            'CUSTOMER'      => self::CUSTOMER,
        ];
    }

    /**
     * UserRoles::toLabel()
     *
     * @param $value
     * @return string
     */
    public static function toLabel($value): string
    {
        switch ($value) {
            case self::SUPER_ADMIN:
                return "Super Admin";
            default:
                return Str::title($value);
        }
    }

    /**
     * UserRoles::toInputArray()
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
