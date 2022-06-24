<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedRoles extends Migration
{
    /** @var array $roles */
    private const ROLES = [
        "user",
        "admin",
        "super_admin",
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now();
        $roles = collect(self::ROLES);

        $rolesInsert = $roles->map(function (string $role) use ($now) {
            return [
                'name'          => $role,
                'guard_name'    => 'web',
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        });

        DB::table('roles')->insert($rolesInsert->toArray());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /** @var array $roles */
        $roles = self::ROLES;

        DB::table('roles')->whereIn('name', $roles)->delete();
    }
}
