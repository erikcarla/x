<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ActivateRequest;
use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\User;
use Auth;

class ActivateController extends Controller
{
    public function index($token)
    {
        $guest = Guest::where('token', $token)->first();
        if(!is_null($guest)) {
            return view('auth.activation', [
                'token' => $token
            ]);
        }
        return redirect('/');
    }

    public function store(ActivateRequest $request)
    {
        $data = $request->all();

        if(!isset($data['token'])) {
            return redirect('/');
        }

        $guest = Guest::where('token', $data['token'])->first();
        if(!is_null($guest)) {
            $user = User::create([
                'name' => $guest->name,
                'email' => $guest->email,
                'password' => bcrypt($data['password']),
            ]);
            $guest->delete();
            Auth::guard()->login($user);
        }
        return redirect('/');
    }
}
