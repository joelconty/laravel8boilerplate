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


class PermissionController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:admin');
        $this->rules = array( 'name' => ['required', 'unique:permissions', 'max:255'] );
    }

    public function index(Request $request){
        $permissions = DB::table('permissions')->select('id', 'name')->get();
		return view('admin.pages.permissions.index')
            ->with('permissions', $permissions);
	}

	public function edit($id){
        $permission = DB::table('permissions')
            ->select('id', 'name')
            ->where('id', '=', $id)
            ->first();
		return view('admin.pages.permissions.edit')
                ->with('permission', $permission);
	}

	public function update(Request $request ){

		$id = $request->input('id');

        $permission = Permission::find($id);

        $request->validate($this->rules);

        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully' );
	}

	public function create(){
		return view('admin.pages.permissions.create');
	}

    public function delete($id){
        $permission = Permission::where('id', '=', $id)->first();
        return view('admin.pages.permissions.delete')
            ->with('permission', $permission);
    }

	public function store(Request $request){

        $request->validate($this->rules);

        $permission = Permission::create(['name' => $request->input('name')]);
        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission added successfully') ;

	}

	public function destroy(Request $request){
		$permissionid = $request->input('id');
        Permission::destroy($permissionid);

        return redirect()->route('admin.permissions.index')
	        ->with('success', 'Permission deleted successfully.');
	}

}
