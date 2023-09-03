<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->permissionsSeeder();

        $user = User::create([
            'name'              => "Your Name",
            'email'             => "admin@example.com",
            'password'          => '$2y$10$P3yVZN5E1t5KCBaFllqPnOADkktE19CvCAG97I1u7kR5U48s4PTkG',   // 123123
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        $user->assignRole('Admin');

        $token = preg_replace('/(\d+)\|/i', '', $user->createToken('wp_token')->plainTextToken);

        $settings = [
            [
                'name' => 'api_token',
                'value'=> $token,
            ],
            [
                'name' => 'minutes',
                'value'=> 10,
            ],
            [
                'name' => 'logo',
                'value'=> null,
            ]
        ];

        Setting::insert($settings);
    }

    private function permissionsSeeder()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'folder_access',
            'folder_create',
            'folder_edit',
            'folder_delete',

            'file_access',
            'file_upload',
            'file_remote_upload',
            'file_edit',
            'file_delete',
            'file_share',
            'file_statistics',
            
            'user_access',
            'user_create',
            'user_edit',
            'user_delete',

            'role_access',
            'role_create',
            'role_edit',

            'setting_access',
            'setting_edit',
        ];

        foreach ($permissions as $permission)   {
            Permission::create([
                'name' => $permission
            ]);
        }

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
    }
}
