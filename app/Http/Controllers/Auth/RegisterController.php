<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Deliver;
use App\Store;

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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        if ($data['type']=="Customer") {

            $Customer = Customer::create([
                'name' => $data['name'],
                'address' => $data['address'],
            ]);
            $typeId = $Customer->id;

        }
        else if ($data['type']=="Store") {

            $Store = Store::create([
                'name' => $data['storeName'],
                'address' => $data['address'],
            ]);
            $typeId = $Store->id;

        }
        else if ($data['type']=="Deliver") {

            $Deliver = Deliver::create([
                'name' => $data['name'],
                'status' => "Offline",
            ]);
            $typeId = $Deliver->id;

        }

        $userCreate = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'phone' => $data['phone'],
            'type_id' => $typeId,
            'password' => Hash::make($data['password']),
        ]);
        
        return $userCreate;
    }
}
