<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Movil\movilApiRequest;
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


    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function loginProvider(movilApiRequest $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if($user){
            User::actualizar($user, $request);
        }else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = $request->avatar;
            $user->save();
        }
        return $this->authAndRedirect($user);
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        //$credentials = $userSocial->getEmail();

        if($user){
            User::actualizar($user, $userSocial);
        }else{
            $user = new User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->avatar = $userSocial->avatar;
            $user->save();
        }
        return $this->authAndRedirect($user);
    }

    public function authAndRedirect($user)
    {
        $token = auth('api')->login($user);
        return response()->json([
            'status' => 'success',
            'user' => auth('api')->user(),
            'token' => $token,
            'expires' => auth('api')->factory()->getTTL() * 60,
        ]);
    }


    public function logout(Request $request) 
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('token');
        //dd($token);
        // Invalidate the token
        try {
            //auth('api')->logout($token);
            auth('api')->invalidate($token);
            //dd(auth('api')->logout(true));
            return response()->json([
                'user' => auth('api')->user(),
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
