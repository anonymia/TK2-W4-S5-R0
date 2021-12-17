<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'boolean'],
            'role' => ['required', 'string', 'in:admin,user']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $body = array(
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'role' => $request->role
        );

        try {
            DB::table('users')->where('email', $request->email)->update($body);
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('user');
    }

    public function get(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return view('user.get', ['user' => $user]);
    }

    public function put(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'boolean'],
            'role' => ['required', 'string', 'in:admin,user']
        ]);

        $body = array(
            'name' => $request->name,
            'email' => $request->email,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'role' => $request->role
        );

        if (!empty($request->password)) {
            $body['password'] = Hash::make($request->password);
        }

        try {
            DB::table('users')->where('id', $id)->update($body);
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('user');
    }

    public function delete(Request $request, $id)
    {
        DB::table('users')->delete($id);

        return redirect()->route('user');
    }
}
