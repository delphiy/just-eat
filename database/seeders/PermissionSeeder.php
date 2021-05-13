<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(
            [
                'name' => 'restaurants',
            ]);

        Permission::create(
            [
                'name' => 'products',
            ]);

        Permission::create(
            [
                'name' => 'dashboard',
            ]);
    }
}
