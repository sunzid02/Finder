<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


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
     * @var Request
     */
    private $request;

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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string',
            'profileImage'=>'required|image|mimes:jpeg,png,jpg|max:100',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data )
    {
        // getting location
//        $position = \Location::get('103.133.140.9');
        $position = \Location::get(\Request::getClientIp());
        $latitude = ($position != false) ? $position->latitude : 0.00 ;
        $longitude = ($position != false) ? $position->longitude : 0.00 ;


        ////image store
        $profileImage = $data['profileImage'];
        $extension = $profileImage->getClientOriginalExtension();

        Storage::disk('public')->put($profileImage->getFilename().'.'.$extension,  File::get($profileImage));

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'profile_image' => $profileImage->getFilename().'.'.$extension,
            'gender' => $data['gender'],
            'dob' => $data['dob'],
        ]);
        
        
    }

}
