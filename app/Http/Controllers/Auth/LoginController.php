<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }


    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        //$credentials = $userSocial->getEmail();

        if($user){
            User::actualizar($user, $userSocial);
        }else{
            $user = User::create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'avatar' => $userSocial->avatar,
            ]);
        }
        return $this->authAndRedirect($user);
    }


    public function login() {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['status' => 'error','error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'status' => 'success',
            'user' => auth('api')->user(),
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);
    }


    public function authAndRedirect($user)
    {
        $token = auth('api')->login($user);
        dd($token);
    }


    public function logout(Request $request) 
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('Authorization');
        // Invalidate the token
        try {
            auth('api')->invalidate($token);
            return response()->json([
                'status' => 'success', 
                'message'=> "User successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
              'status' => 'error', 
              'message' => 'Failed to logout, please try again.'
            ], 500);
        }
    }

}
