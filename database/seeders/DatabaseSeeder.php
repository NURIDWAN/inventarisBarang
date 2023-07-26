<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Super Admin']);
        $permissions = ['Create User', 'Edit User','Update User', 'Delete User',
                        'Create Role', 'Edit Role','Update Role', 'Delete Role',
                        'Create Permission', 'Edit Permission', 'Update Permission', 'Delete Permission',
                        'Create Category', 'Edit Category','Update Category', 'Delete Category',
                        'Create SubCategory', 'Edit SubCategory','Update SubCategory', 'Delete SubCategory',
                        'Create Store', 'Edit Store','Update Store', 'Delete Store',
                        'Create Warehouse', 'Edit Warehouse','Update Warehouse', 'Delete Warehouse',
                        'Create Unit', 'Edit Unit','Update Unit', 'Delete Unit',
                        'Create Product', 'Edit Product','Update Product', 'Delete Product',
                        'Create Inventory', 'Edit Inventory','Update Inventory', 'Delete Inventory',
                    ];





        // Looping untuk membuat Permission
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role->syncPermissions($permissions);

        $user1 = User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'SuperAdmin@example.com',
        ]);
        $user1->assignRole($role);
    }
}
