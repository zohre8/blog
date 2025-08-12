<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            'write_posts',
            'view_reports',
            'create_users',
            'create_category',
            'view_setting',
            'view_membership',
            'edit_active',
            'edit_post',
        ];

        foreach ($permissions as $permission){
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin=Role::where('name', 'admin')->first();
        $author=Role::where('name', 'author')->first();

        if ($admin) {
            $admin->syncPermissions($permissions);
        }

        if ($author) {
            $author->syncPermissions(['write_posts']);
        }
    }
}
