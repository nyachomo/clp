<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'firstname' => ['string', 'max:255'],
            'secondname' =>['string', 'max:255'],
            'lastname' => ['string', 'max:255'],
           'phonenumber' => ['required', 'string', 'regex:/^07\d{8}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['string', 'max:255'],
            'role' => ['string', 'max:255'],
            'parent_phone' => ['max:255'],
            'has_paid_reg_fee' => ['string', 'max:255'],
            'school_id' => ['max:255'],
            'course_id' => ['string', 'max:255'],
            'clas_id'=>['string','max:255'],
            'clas_category'=>['string','max:255'],
            'prefered_course'=>['string','max:255'],
            'password' => ['required', 'string','confirmed', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            //'firstname' => $data['firstname'],
            'firstname' => Str::title($data['firstname']),
            //'secondname' => $data['secondname'],
            'lastname' => $data['lastname'],
            'phonenumber' => $data['phonenumber'],
            'parent_phone' => $data['parent_phone'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'role' => $data['role'],
            'has_paid_reg_fee' => $data['has_paid_reg_fee'],
            'school_id' => $data['school_id'] ?? null,
            'course_id' => $data['course_id'] ?? null,
            'clas_category' => $data['clas_category'] ?? '',
            'prefered_course' => $data['prefered_course'] ?? '',
            'clas_id'=>$data['clas_id'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
    }
}
