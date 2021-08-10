<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\html;
use App\Http\Requests;
use Auth;
use App\Models\User;


class DashboardController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(){
        $userscount = DB::table('users')->count();
        $rolescount = DB::table('roles')->count();
        $permissionscount = DB::table('permissions')->count();

        return view('admin.pages.dashboard.index')
            ->with('userscount', $userscount)
            ->with('rolescount', $rolescount)
            ->with('permissionscount', $permissionscount);

	}

}
