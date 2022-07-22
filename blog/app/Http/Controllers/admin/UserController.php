<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Facade\Ignition\Middleware\AddLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\at;

class UserController extends Controller
{
    //
    public function index()
    {

        // $userList = User::Pagina();
        $userList = User::paginate(4);

        return view('admin.user.list', compact('userList'));
    }

    public function add()
    {
        $roleList = Role::all();
        return view('admin.user.add', compact('roleList'));
    }

    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'confirmPassword' => 'same:password',
                'role_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Please choose your role');
                    }
                }],
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'email.unique' => 'Email is existed',
                'password.required' => 'Password is required',
                'confirmPassword.same' => 'Confirm password is incorrect',
            ]
        );
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();
        return redirect()->route('admin.user.index')->with('message', 'Register Successfull');

    }
    public function edit($id)
    {
        $user = User::find($id);
        $roleList = Role::all();
        return view('admin.user.edit', compact('roleList','user'));
    }

    public function postEdit(Request $request, $id){
        $user = User::find($id);
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',Rule::unique('users')->ignore($user->id),
                'role_id' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Please choose your role');
                    }
                }],
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email is invalid',
                'email.unique' => 'Email is existed',
               
            ]);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->save();
            return redirect()->route('admin.user.index')->with('message', 'Edit Successfull');
    }

    public function delete($id){
        $user = User::find($id);
        if(Auth::user()->id != $user->id){
            User::destroy($user->id);
            return redirect()->route('admin.user.index')->with('message', 'Delete Successfull');
        }
        else{
            return redirect()->route('admin.user.index')->with('message', 'Cannot Delete User');
        }
    }
}
