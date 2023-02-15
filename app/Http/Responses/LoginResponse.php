<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Inertia\Inertia;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {

        if ($request->user()->role == 'admin') {
            return redirect()->to('/');
        } else if ($request->user()->role == 'user') {
            return redirect()->to('/user/dashboard');
        } else {
            return Inertia::location('/login');
            // return redirect()->refresh()->to('/');
        }
        // $home = auth()->user()->isAdmin() ? '/admin' : '/dashboard';

        // return redirect()->intended($home);
    }
}
