<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserPermission::create(
            [
                'user_id' => 1,
                'permission_id' => 1,
            ]);

        UserPermission::create(
            [
                'user_id' => 2,
                'permission_id' => 2,
            ]);
    }
}
