<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class UserPermissions
 * @package App\Enums
 */
final class UserPermissions extends Enum
{
    const VIEW_ANY_USER = "view-any-user";
    const VIEW_USER     = "view-user";
    const STORE_USER    = "store-user";
    const UPDATE_USER   = "update-user";
    const DELETE_USER   = "delete-user";
    const RESTORE_USER  = "restore-user";
}
