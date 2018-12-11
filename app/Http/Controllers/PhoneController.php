<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Authy\AuthyApi;

class PhoneController extends Controller
{
    public function __construct()
    {
    	$this->middleware('jwt.auth');
    	$this->authyApi = new AuthyAPi(env('AUTHY_API_KEY'));
    	$this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    public function requestSms(Request $request)
    {
    	//dd($request);
    	$user = auth('api')->user();
    	$user->phone_number = $request->phone_number;
    	$user->country_code  = '+'.$request->country_code;
    	$user->save();

    	if($user->verified){
    		$this->responseSuccess();
    	}

    	$authyUser = $this->authyApi->registerUser(
			$user->emial,
			$user->phone_number,
			$user->country_code
		);
    	//dd(json_encode($authyUser->ok()));
		if($authyUser->ok()){
			$user->authy_id = $authyUser->id();
			$user->save();

			$this->authyApi->requestSms($user->authy_id);
			return $this->responseSuccess();

		}else{
			return $this->responseErrors($authyUser);
		}


    }

    public function postConfirmPhone(Request $request)
    {
    	$token = $request->token;
    	$user = auth('api')->user();
    	
    	$verification = $this->authyApi->verifyToken($user->authy_id, $token);

    	if($verification->ok()){
    		$user->verified = true;
    		$user->save();
    		return $this->responseSuccess();
    	}else{
    		return $this->responseErrors($verification);
    	}
    }

    public function responseSuccess()
    {
    	return response()->json([
            'status' => 'success'
        ]);
    }

    public function responseErrors($errors)
    {
    	return response()->json([
            'errorAuthy' => $errors->errors(),
        ]);
    }
}
