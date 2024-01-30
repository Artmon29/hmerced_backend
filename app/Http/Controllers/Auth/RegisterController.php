<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $user = $this->createUser($request->all());

        $user->assignRole('admin');

        return $this->sendResponse($user);
    }
}
