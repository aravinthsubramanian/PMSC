<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        "PERMISSION_CREATE",
        "PERMISSION_READ",
        "PERMISSION_UPDATE",
        "PERMISSION_DELETE",
        "ROLE_CREATE",
        "ROLE_READ",
        "ROLE_UPDATE",
        "ROLE_DELETE",
        "ADMIN_CREATE",
        "ADMIN_READ",
        "ADMIN_UPDATE",
        "ADMIN_DELETE",
        "USER_CREATE",
        "USER_READ",
        "USER_UPDATE",
        "USER_DELETE",
        "CATEGORY_CREATE",
        "CATEGORY_READ",
        "CATEGORY_UPDATE",
        "CATEGORY_DELETE",
        "SUBCATEGORY_CREATE",
        "SUBCATEGORY_READ",
        "SUBCATEGORY_UPDATE",
        "SUBCATEGORY_DELETE",
        "PRODUCT_CREATE",
        "PRODUCT_READ",
        "PRODUCT_UPDATE",
        "PRODUCT_DELETE",
     ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['guard_name' => 'admin','name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = Admin::create([
           'ad_name' => 'Ambi Aravinth',
           'email' => 'aravinth.subramanian@dreamstechnologies.com',
           'mobile' => '9597694709',
           'password' => Hash::make('password'),
           'status' => 'enable',
        ]);

        $role = Role::create(['guard_name' => 'admin','name' => 'Super Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
