<?php

namespace App\Http\Controllers\auth;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        Session::forget('user');
        return redirect('/');
    }
}
