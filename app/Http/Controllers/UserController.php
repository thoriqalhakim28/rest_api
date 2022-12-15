<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = DB::table('users')
        ->select(
            'username',
            'fullname',
            'email',
        )
        ->orderBy('username', 'asc')
        ->get();
        return response()->json($users, 200);
    }

}
