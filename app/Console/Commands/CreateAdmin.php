<?php

namespace App\Console\Commands;

use Hash;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user, admin role and a basic set of permisions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{

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

            $this->info('Your system needs to create a new user to be the administrator.');
            $this->info('Please the next 3 questions about the administrator credentials:');
            $name = $this->ask('Please enter the administrator username.');
            $email = $this->ask('Please enter the administrator email.');
            $password = $this->secret('Please enter the administrator password.');


            $user = User::factory()->create([
                'firstname' => 'admin',
                'lastname' => 'admin',
                'username' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            $user->assignRole($adminRole);

            $this->info('Your administrator user has been created successfully and given the admin role. You can start using your system now.');

        } catch ( \Exception $e){
            $this->error("Something went wrong!");
            $this->error( $e->getMessage() );
        }
    }
}
