<?php

namespace Database\Seeders;

use App\Enum\Permissions;
use App\Enum\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => Roles::Admin->value]);
        $commenterRole = Role::create(['name' => Roles::Commenter->value]);
        $userRole = Role::create(['name' => Roles::User->value]);

        // Permissions
        $manageUserPermission = Permission::create(['name' => Permissions::ManageUsers->value]);
        $manageCommentsPermission = Permission::create(['name' => Permissions::ManageComments->value]);
        $manageFeaturesPermission = Permission::create(['name' => Permissions::ManageFeatures->value]);
        $upvotePermission = Permission::create(['name' => Permissions::UpvoteDownvote->value]);

        // Syncing permissions
        $userRole->syncPermissions([$upvotePermission]);
        $commenterRole->syncPermissions([$upvotePermission, $manageCommentsPermission]);
        $adminRole->syncPermissions([
            $manageUserPermission,
            $manageCommentsPermission,
            $manageFeaturesPermission,
            $upvotePermission
        ]);

        User::factory()->create([
            'name' => 'Basic User',
            'email' => 'user@example.com',
        ])->assignRole(Roles::User);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole(Roles::Admin);

        User::factory()->create([
            'name' => 'Commenter User',
            'email' => 'commenter@example.com',
        ])->assignRole(Roles::Commenter);
    }
}
