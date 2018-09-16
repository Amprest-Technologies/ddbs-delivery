<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|min:9|max:12',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Get the DB driver.
        switch ($data['location']) {
            case 'kileleshwa':
                $driver = 'mysql';
                break;

            case 'buruburu':
                $driver = 'pgsql';
                break;

            default:
                $driver = 'sqlsrv';
                break;
        }

        // Set the user ID.
        $user_id = Helpers::generateID('user', [
            // DB Drivers to use.
            'mysql', 'pgsql', 'sqlsrv'
        ]);

        $user = new User;
        $user->setConnection($driver);
        return $user->create([
            'id' => $user_id,
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'location' => $data['location'],
            'phone_number' => '+254'. substr($data['phone_number'], -9),
            'password' => Hash::make($data['password']),
        ]);
    }
}
