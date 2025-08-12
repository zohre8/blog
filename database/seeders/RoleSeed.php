<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            [
                'name'=>'admin',
                'guard_name'=>'web'
            ],
            [
                'name'=>'author',
                'guard_name'=>'web'
            ],
            [
                'name'=>'user',
                'guard_name'=>'web'
            ],
        ];

        foreach ($roles as $role){
            Role::updateOrCreate(['name' => $role['name']], $role);
        }

    }
}
