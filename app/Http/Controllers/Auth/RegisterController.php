<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Monedero;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', $validator->errors()]);
        }
        $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'rol_id' => $request->get('rol'),
                'password' => bcrypt($request->get('password')),
            ]);

        $monedero = new Monedero;
        $monedero->stock = 0;
        $monedero->user_id = $user->id;
        $monedero->save();

        $credentials = request(['email', 'password']);
        $token = auth('api')->attempt($credentials);
        
        return response()->json([
            'status' => 'success', 
            'user' => auth('api')->user(),
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
