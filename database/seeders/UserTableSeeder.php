<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allPermissions = array(
            array(
                'name' => 'Edit Profile',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Change Password',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage User',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Create User',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Edit User',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Delete User',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage Manual Order',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage Order',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Edit Order',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Print Order',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage Map',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Edit Map',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage Customer',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Edit Customer',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Create Customer',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Manage Accessories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Create Accessories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Edit Accessories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'name' => 'Delete Accessories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        );

        Permission::insert($allPermissions);

        $shop_owner_permissions = array(
            ["name" => "Edit Profile"],
            ["name" => "Change Password"],
            ["name" => "Manage User"],
            ["name" => "Create User"],
            ["name" => "Edit User"],
            ["name" => "Delete User"],
            ["name" => "Manage Manual Order"],
            ["name" => "Manage Order"],
            ["name" => "Edit Order"],
            ["name" => "Print Order"],
            ["name" => "Manage Map"],
            ["name" => "Edit Map"],
            ["name" => 'Manage Customer'],
            ["name" => "Edit Customer"],
            ["name" => "Create Customer"],
            ["name" => "Manage Accessories"],
            ["name" => "Create Accessories"],
            ["name" => "Edit Accessories"],
            ["name" => "Delete Accessories"],
        );

        $shop_owner = new User();
        $shop_owner->name = 'shop owner';
        $shop_owner->email = 'admin@example.com';
        $shop_owner->password = 1234;
        $shop_owner->parent_id = 0;
        $shop_owner->is_active = true;
        $shop_owner->user_status = true;
        $shop_owner->save();

        $shop_owner_role             = new Role();
        $shop_owner_role->name       = 'Admin';
        $shop_owner_role->created_by = $shop_owner->id;
        $shop_owner_role->save();

        $shop_owner_role->givePermissionTo($shop_owner_permissions);
        $shop_owner->assignRole($shop_owner_role);

        $operator_role                = new Role();
        $operator_role->name          = 'Operator';
        $operator_role->created_by    = $shop_owner_role->id;
        $operator_role->save();

        $client_role                = new Role();
        $client_role->name          = 'Client';
        $client_role->created_by    = $shop_owner_role->id;
        $client_role->save();
    }
}
