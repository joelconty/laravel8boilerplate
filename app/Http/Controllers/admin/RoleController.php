<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Auth;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\html;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use \App\Http\Requests;


class RoleController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:admin');
        $this->rules = array( 'name' => ['required', 'unique:roles', 'max:255', 'min:4'] );
    }

    public function index(Request $request){

        $allpermissions = Permission::all()->pluck('name')->toArray();
        $roles = Role::all();
        $rolePermissions = array();
        foreach ( $roles as $role ){
            $permissions = $role->permissions()->get()->pluck('name')->toArray();
            $rolePermissions[$role->id] = $permissions;
        }

        return view('admin.pages.roles.index')
            ->with('roles', $roles)
            ->with('rolePermissions', $rolePermissions)
            ->with('allpermissions', $allpermissions);
	}

	public function edit($id){

		$role = Role::where('id', '=', $id)->first();
		return view('admin.pages.roles.edit')
                ->with('role', $role);
	}

	public function update(Request $request ){

		$id = $request->input('id');
        $role = Role::where('id', '=', $id)->first();

        $request->validate($this->rules);

        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully' );
	}

	public function create(){
		return view('admin.pages.roles.create');
	}

    public function delete($id){
        $role = Role::where('id', '=', $id)->first();
        return view('admin.pages.roles.delete')
            ->with('role', $role);
    }

	public function store(Request $request){

        $request->validate($this->rules);

        $newrole = new Role();
        $newrole->name = $request->input('name');
        $newrole->guard_name = 'web';
        $newrole->save();
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role added successfully') ;
	}

	public function destroy(Request $request){
		$roleid = $request->input('id');
        Role::destroy($roleid);

        return redirect()->route('admin.roles.index')
	        ->with('success', 'Role deleted successfully.');
	}

}
