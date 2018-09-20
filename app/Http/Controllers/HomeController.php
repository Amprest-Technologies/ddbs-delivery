<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the users.
        $payload = $this->getAllUsers($this->drivers, 1, ['id', 'name']);
        return view('home', ['payload' => $payload]);
    }

    /**
     * Get all the users unless filtered
     */
    public function getAllUsers($drivers, $table, $filters = ['*'])
    {
        // Create a user collection
        $users = collect([]);
        // Get all users from all drivers
        foreach ($drivers as $driver) {
            $users = $users->merge(
                DB::connection($driver)->table('users_'. $table)
                    ->select($filters)->get()
            );
        }
        // Return all users
        return $users;
    }
}
