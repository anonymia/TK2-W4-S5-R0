<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('user')->get();

        return view('user.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|boolean',
            'password' => ['required', Password::defaults()],
            'repeat_password' => 'required|same:password',
            'email' => 'required|email'
        ]);

        try {
            DB::table('user')->insert(
                array(
                    'name' => $request->get('name'),
                    'place_of_birth' => $request->get('place_of_birth'),
                    'date_of_birth' => $request->get('date_of_birth'),
                    'gender' => $request->get('gender'),
                    'password' => Hash::make($request->get('password')),
                    'email' => $request->get('email')
                )
            );
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                case 1062: // Integrity constraint violation: 1062 Duplicate entry 'Nama'
                    throw ValidationException::withMessages(['name' => 'The name already exists.']);
                    break;
                
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('user');
    }

    public function get(Request $request, $id)
    {
        $user = DB::table('user')->where('id', $id)->first();

        return view('user.get', ['user' => $user]);
    }

    public function put(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|boolean',
            'password' => ['nullable', Password::defaults()],
            'repeat_password' => 'nullable|same:password',
            'email' => 'required|email'
        ]);

        $body = array(
            'name' => $request->get('name'),
            'place_of_birth' => $request->get('place_of_birth'),
            'date_of_birth' => $request->get('date_of_birth'),
            'gender' => $request->get('gender'),
            'email' => $request->get('email')
        );

        if (!empty($request->get('password'))) {
            $body['password'] = Hash::make($request->get('password'));
        }

        try {
            DB::table('user')->where('id', $id)->update($body);
        }
        catch (QueryException $e) {
            switch ($e->errorInfo[1]) {
                case 1062: // Integrity constraint violation: 1062 Duplicate entry 'Nama'
                    throw ValidationException::withMessages(['name' => 'The name already exists.']);
                    break;
                
                default:
                    Log::channel('stderr')->error($e->getMessage());
                    break;
            }
        }

        return redirect()->route('user');
    }

    public function delete(Request $request, $id)
    {
        DB::table('user')->delete($id);

        return redirect()->route('user');
    }
}
