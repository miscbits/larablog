<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use JWTAuth;
use JWTException;
use App\User;

class AuthenticateController extends Controller
{
	public function authenticate(Request $request) {
		$credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        User::where('email', $request->only('email'))->first()->update(['deleted', 0]);
        return response()->json(compact('token'));
    }

}
