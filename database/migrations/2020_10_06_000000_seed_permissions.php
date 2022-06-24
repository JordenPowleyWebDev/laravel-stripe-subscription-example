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
