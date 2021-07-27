<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Roles $role)
    {
        $role->create([
            'function'=>'admin',
        ]);

        $role->create([
            'function'=>'manager',
        ]);

        $role->create([
            'function'=>'seller',
        ]);
    }
}
