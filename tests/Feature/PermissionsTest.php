<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class PermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {

        parent::setUp();

        $adminPermission          = Permission::create(['name' => 'admin']);

        $permissionToCreateUsers   = Permission::create(['name' => 'createUsers']);
        $permissionToEditUsers     = Permission::create(['name' => 'editUsers']);
        $permissionToDeleteUsers   = Permission::create(['name' => 'deleteUsers']);
        $permissionToViewUsers     = Permission::create(['name' => 'viewUsers']);

        $permissionToCreateRoles  = Permission::create(['name' => 'createRoles']);
        $permissionToEditRoles     = Permission::create(['name' => 'editRoles']);
        $permissionToDeleteRoles   = Permission::create(['name' => 'deleteRoles']);
        $permissionToViewRoles     = Permission::create(['name' => 'viewRoles']);

        $permissionToCreatePermissions   = Permission::create(['name' => 'createPermissions']);
        $permissionToEditPermissions     = Permission::create(['name' => 'editPermissions']);
        $permissionToDeletePermissions   = Permission::create(['name' => 'deletePermissions']);
        $permissionToViewPermissions     = Permission::create(['name' => 'viewPermissions']);

        $adminRole = Role::create(['name' => 'admin']);


        $adminRole->givePermissionTo($adminPermission);
        $adminRole->givePermissionTo($permissionToCreateUsers);
        $adminRole->givePermissionTo($permissionToEditUsers);
        $adminRole->givePermissionTo($permissionToDeleteUsers);
        $adminRole->givePermissionTo($permissionToViewUsers);
        $adminRole->givePermissionTo($permissionToCreateRoles);
        $adminRole->givePermissionTo($permissionToEditRoles);
        $adminRole->givePermissionTo($permissionToDeleteRoles);
        $adminRole->givePermissionTo($permissionToViewRoles);
        $adminRole->givePermissionTo($permissionToCreatePermissions);
        $adminRole->givePermissionTo($permissionToEditPermissions);
        $adminRole->givePermissionTo($permissionToDeletePermissions);
        $adminRole->givePermissionTo($permissionToViewPermissions);



        $adminuser = User::create([
            'username' => 'admin',
            'firstname' => 'admin',
            'lastname' => 'smith',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword')
        ]);

        $mortaluser = User::create([
            'username' => 'john',
            'firstname' => 'john',
            'lastname' => 'doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password')
        ]);

        $adminuser->assignRole($adminRole);

    }



    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_and_permissions_were_created_during_setup_of_permissions_test()
    {

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'admin'
        ]);


        $this->assertCount(13, Permission::all());
    }

    public function test_a_mortal_user_can_not_use_admin_page()
    {
        $mortal_user = User::where('username', '=', 'john')->firstOrFail();

        $response = $this->actingAs($mortal_user)
            ->get('/admin/')
            ->assertStatus(403);

    }

    public function test_an_authorized_user_can_use_admin_page()
    {
        $admin_user = User::where('username', '=', 'admin')->firstOrFail();

        $response = $this->actingAs($admin_user)
            ->get('/admin/')
            ->assertStatus(200);

    }
}
