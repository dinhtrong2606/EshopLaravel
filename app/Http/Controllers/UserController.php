<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $admin = User::with('roles', 'permissions')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.user.index_user')->with(compact('admin'));
    }

    public function create()
    {
        return view('admin.user.create_user');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $user->syncRoles('Manage brand');
        return Redirect()->back()->with('status', 'Thêm User thành công!');
    }

    public function roles_user($id)
    {
        $user = User::find($id);
        $roles = Role::orderBy('id', 'DESC')->get();
        $all_roles = $user->roles->first();
        return view('admin.user.roles_user')->with(compact('roles', 'user', 'all_roles'));
    }

    public function assign_roles(Request $request)
    {
        $data = $request->all();
        $user_id = $data['user_id'];
        $user = User::find($user_id);
        $user->syncRoles($data['roles_user']);

        return Redirect()->back()->with('success', 'Phân quyền thành công!');
    }

    public function permission_user($id)
    {
        $user = User::find($id);
        $name_roles = $user->roles->first()->name;
        $permission = Permission::orderBy('id', 'DESC')->get();
        $permission_id = $user->permissions->first();
        $hasPermission = $user->getPermissionsViaRoles();
        return view('admin.user.permission_user')->with(compact('name_roles', 'permission', 'user', 'permission_id', 'hasPermission'));
    }

    public function assign_permission(Request $request)
    {
        $data = $request->all();
        $user_id = $data['user_id'];
        $user = User::find($user_id);
        $roles_id = $user->roles->first()->id;
        $roles = Role::find($roles_id);
        if ($request->permissions) {
            $roles->syncPermissions($data['permissions']);
        }

        return Redirect()->back()->with('success', 'Phân vai trò thành công!');
    }

    public function delete_permission($id)
    {
        $user = User::find($id);
        $hasPermission = $user->getPermissionsViaRoles();
        $role_id = $user->roles->first()->id;
        $roles = Role::find($role_id);
        foreach ($hasPermission as $val) {
            $roles->revokePermissionTo($val->name);
        }
        // $roles->revokeAllPermissions();
        return Redirect()->back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return Redirect()->back()->with('success', 'Xóa user thành công thành công!');
    }

    // public function impersonate(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     if ($user) {
    //         $request->session()->put('impersonate', $user->id);
    //     }

    //     return redirect('/home');
    // }
}