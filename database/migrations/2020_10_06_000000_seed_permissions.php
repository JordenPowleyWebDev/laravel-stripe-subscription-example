<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedPermissions extends Migration
{
    /** @var array $permissions */
    private const PERMISSIONS = [
        "view-any-user",
        "view-user",
        "store-user",
        "update-user",
        "delete-user",
        "restore-user",

        "view-any-subscription",
        "view-subscription",
        "store-subscription",
        "update-subscription",
        "delete-subscription",
        "restore-subscription",

        "view-any-stripe-subscription-plan-detail",
        "view-stripe-subscription-plan-detail",
        "store-stripe-subscription-plan-detail",
        "update-stripe-subscription-plan-detail",
        "delete-stripe-subscription-plan-detail",
        "restore-stripe-subscription-plan-detail",
    ];

    /**
     * @return void
     */
    public function up()
    {
        $now = now();
        $permissions = collect(self::PERMISSIONS);

        $permissionsInsert = $permissions->map(function (string $permission) use ($now) {
            return [
                'name'          => $permission,
                'guard_name'    => 'web',
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        });

        DB::table('permissions')->insert($permissionsInsert->toArray());
    }

    /**
     * @return void
     */
    public function down()
    {
        /** @var array $permissions */
        $permissions = self::PERMISSIONS;

        DB::table('permissions')
            ->whereIn('name', $permissions)
            ->delete();
    }
}
