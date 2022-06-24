<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AddPermissionsToSuperAdmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var object $role */
        $role = self::getRole();
        $permissions = self::getPermissions();

        $employeeHasPermissionsInsert = $permissions->map(function ($permission) use ($role) {
            return [
                'permission_id' => $permission->id,
                'role_id'       => $role->id,
            ];
        })->toArray();

        DB::table('role_has_permissions')->insert($employeeHasPermissionsInsert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /** @var object $role */
        $role = self::getRole();
        $permissions = self::getPermissions();

        DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->whereIn('permission_id', $permissions->map->id)
            ->delete();
    }

    /**
     * @return array
     */
    private static function permissions(): array
    {
        return [
            "view-any-user",
            "view-user",
            "store-user",
            "update-user",
            "delete-user",
            "restore-user",
        ];
    }

    /**
     * @return object|null
     */
    private static function getRole(): ?object
    {
        return DB::table('roles')
            ->where('name', '=', "super_admin")
            ->first();
    }

    /**
     * @return Collection
     */
    private static function getPermissions()
    {
        return DB::table('permissions')
            ->whereIn('name', self::permissions())
            ->get();
    }
}
