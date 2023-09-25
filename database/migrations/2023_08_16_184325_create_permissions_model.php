<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'super admin', 'guard_name' => 'jwt']);
        Role::create(['name' => 'admin', 'guard_name' => 'jwt']);
        Role::create(['name' => 'botanist', 'guard_name' => 'jwt']);
        Role::create(['name' => 'user', 'guard_name' => 'jwt']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::all()->each(function (Role $role) {
            $role->delete();
        });
    }
};
