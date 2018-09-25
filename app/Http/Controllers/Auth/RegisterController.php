<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\SysTable;
use App\Http\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
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
    protected $redirectTo = '/login';

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
            'town' => 'required|string|max:255',
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
        switch ($data['role']) {
            case 'customer':
                $table = 'users_1';
                break;

            default:
                $table = 'users_2';
                break;
        }

        // Set the user ID.
        $user_id = Helpers::generateID('user');

        $user = DB::connection($this->driver_locations[$data['location']])->table($table)->insert([
            'id' => $user_id,
            'name' => $data['name'],
            'role' => $data['role'],
            'email' => $data['email'],
            'email_verified_at' => date('Y-m-d H:i:s'),
            'location' => ucwords($data['location']),
            'town' => ucwords($data['town']),
            'phone_number' => '+254'. substr($data['phone_number'], -9),
            'password' => md5($data['password']),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        SysTable::updateorCreate([
            'model' => 'User'
        ],[
            'latest_driver' => $this->driver_locations[$data['location']],
            'latest_table_name' => 'users_1',
            'latest_id' => $user_id,
        ]);
        return DB::connection($this->driver_locations[$data['location']])
                    ->table($table)
                    ->find($user_id);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());
        $request->session()->flash('success', 'Welcome to the delivery app. Login to continue.');
        return redirect()->intended($this->redirectPath());
    }
}
