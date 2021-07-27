<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
        $user->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'id_roles'=>1,
            'password'=>Hash::make('admin@123'),
        ]);

        $user->create([
            'name'=>'gerente',
            'email'=>'gerente@gerente.com',
            'id_roles'=>2,
            'password'=>Hash::make('gerente@123'),
        ]);

        $user->create([
            'name'=>'vendedor',
            'email'=>'vendedor@vendedor.com',
            'id_roles'=>3,
            'password'=>Hash::make('vendedor@123'),
        ]);
    }
}
