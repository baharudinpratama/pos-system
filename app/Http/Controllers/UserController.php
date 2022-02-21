<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addRole()
    {
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'cashier']);

        // $user = auth()->user();
        // $user->assignRole('cashier');

        // return $user;
    }
}
