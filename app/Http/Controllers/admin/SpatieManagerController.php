<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SpatieManagerController extends Controller
{
    public function updateRolePermissions($rolename, $permissionname, $value)
    {
        $role = Role::findByName($rolename);
        $permission = Permission::findByName($permissionname);
        if ( $value == 'on' ){
            $role->givePermissionTo($permission);
            $msg = "Permission '{$permissionname}' successfully activated for  role '{$rolename}'.";
        } else {
            $role->revokePermissionTo($permission);
            $msg = "Permission '{$permissionname}' successfully revoked for role '{$rolename}'.";
        }
        return back()
            ->with("success", $msg);
    }

    public function updateUserRoles($userid, $rolename, $value)
    {
        $role = Role::findByName($rolename);
        $user = User::find($userid);
        if ( $value == 'on' ){
            $user->assignRole($role);
            $msg = "Role '{$rolename}' successfully assigned to user '{$user->username}'.";
        } else {
            $user->removeRole($role);
            $msg = "Role '{$rolename}' successfully revoked from user '{$user->username}'.";
        }
        return back()
            ->with("success", $msg);
    }

    public function updateUserPermissions($userid, $permissionname, $value)
    {
        $user = User::find($userid);
        $permission = Permission::findByName($permissionname);
        $notificationType = 'success';
        if ( $value == 'on' ){
            $user->givePermissionTo($permission);
            $msg = "Permission '{$permissionname}' successfully assigned to user '{$user->username}'.";
        } else {

            // Direct permissions
            $directPermissions = $user->getDirectPermissions()->pluck('name')->toArray();
            // Permissions inherited from the user's roles
            $permissionsViaRoles = $user->getPermissionsViaRoles()->pluck('name')->toArray();
            $inDirect = false;
            $inViaRole = false;
            if ( in_array($permissionname, $directPermissions)){
                $inDirect = true;
            }
            if ( in_array($permissionname, $permissionsViaRoles)){
                $inViaRole = true;
            }

            if ( $inDirect && $inViaRole ){
                $user->revokePermissionTo($permission);
                $msg = "Direct permission '{$permissionname}' successfully revoked from user '{$user->username}'. However, the user still has access via role.";
                $notificationType = 'warning';
            } elseif ( $inDirect && (! $inViaRole)){
                $user->revokePermissionTo($permission);
                $msg = "Direct permission '{$permissionname}' successfully revoked from user '{$user->username}'.";
            } elseif ( (!$inDirect) &&  $inViaRole ){
                $msg = "Permission '{$permissionname}' could not be revoked from user '{$user->username}' due to a permission via role.";
                $notificationType = 'error';
            }

        }
        return back()
            ->with($notificationType, $msg);
    }
}
