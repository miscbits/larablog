<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use JWTException;

use App\Http\Requests;

class UserController extends Controller
{
	public function show(Request $request) {
	    try {
	        if (! $user = JWTAuth::parseToken()->authenticate()) {
	            return response()->json(['user_not_found'], 404);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	        return response()->json(['token_expired'], $e->getStatusCode());
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	        return response()->json(['token_invalid'], $e->getStatusCode());
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	        return response()->json(['token_absent'], $e->getStatusCode());
	    }
	    // the token is valid and we have found the user via the sub claim
	    return response()->json(compact('user'));
	}
}
