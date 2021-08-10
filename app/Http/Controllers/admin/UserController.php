<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:admin']);
        $this->user_id = null;
        $this->username = null;
    }

    public function index()
    {
        $users = User::all();
        $allpermissions = Permission::all()->pluck('name')->toArray();
        $allroles = Role::all()->pluck('name');
        $all_users_with_all_their_roles = User::with('roles')->get();
        $userRoles = array();
        $userPermissions = array();
        foreach ( $all_users_with_all_their_roles as $u ){
            $rolesArr = $u->roles->pluck('name')->toArray();
            $userRoles[$u->id] = $rolesArr;
            $perms = $u->getAllPermissions()->pluck('name')->toArray();
            $userPermissions[$u->id] = $perms;
        }

        return view('admin.pages.users.index')
            ->with('users', $users)
            ->with('allroles', $allroles)
            ->with('allpermissions', $allpermissions)
            ->with('userRoles', $userRoles)
            ->with('userPermissions', $userPermissions);
    }

	public function edit($id)
	{
	    $this->user_id = $id;
		$user = User::where('id', '=', $id)->first();
		$this->username = $user->username;
		return view('admin.pages.users.edit')
            ->with('user', $user);
	}

	public function update(Request $request)
	{
        $id = $request->input('id');
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->username = $user->username;
		$option = '';
		if ( $request->has('option')){
		    $option = $request->input('option');
        }

		if ( $option == 'userinfo' ){
		    return $this->update_user_info($request);
        } elseif ( $option == 'userpassword' ){
		    return $this->update_user_password($request);
        } else {
            return redirect()->route('admin.users.index')
                ->with('error', 'Invalid option' );
        }
	}

    public function update_user_info(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->username = $user->username;
        $rules = $this->rules('userinfo');

        $request->validate($rules);

        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->save();

        return redirect()
            ->route('admin.users.index')
                ->with('success', 'User updated successfully' );
    }

    public function update_user_password(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->username = $user->username;
        $rules = $this->rules('userpassword');

        $request->validate($rules);

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Password updated successfully for user ' . $user->username );
    }

	public function create()
	{
		return view('admin.pages.users.create');
	}

	public function delete($id)
	{
		$user = User::where('id', '=', $id)->first();
		return view('admin.pages.users.delete')->with('user', $user);
	}

	public function store(Request $request)
	{
		$rules = $this->rules('newuser');

        $request->validate($rules);

        User::create([
            'username' => $request->input('username'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
	}

	public function destroy(Request $request)
	{
		$userid = $request->input('id');
		User::destroy($userid);

		return redirect()->route('admin.users.index')
			->with('success', 'User deleted successfully');
	}


    public function rules($option)
    {
        if ( $option == 'userinfo' ) {
            $rules = array(
                'firstname' => 'bail|required|alpha|max:50',
                'lastname' => 'bail|required|alpha|max:50',
            );
            if (empty($this->user_id)) {
                $rules['email'] = 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i';
                $rules['username'] = 'required|unique:users|min:3|max:50';
            } else {
                $rules['email'] = 'required|unique:users,email,' . $this->user_id . '|regex:/(.+)@(.+)\.(.+)/i';
                $rules['username'] = 'required|unique:users,username,' . $this->user_id . '|min:3|max:50';
            }
        } elseif ( $option == 'newuser' ){
            $rules = array(
                'username' => 'required|unique:users|min:3|max:50',
                'firstname' => 'bail|required|alpha|max:50',
                'lastname' => 'bail|required|alpha|max:50',
                'email' => 'required|unique:users,email|regex:/(.+)@(.+)\.(.+)/i'
            );
        } elseif ( $option == 'userpassword' ){
            $rules = array(
                'password' => 'required|min:6|max:255|confirmed',
            );
        }
        return $rules;
    }
}
