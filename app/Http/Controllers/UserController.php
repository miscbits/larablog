<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Requests\CreateUser;
use App\Http\Requests\ShowUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\DestroyUser;
use Auth;
use App\User;

class UserController extends Controller
{
	public function create(CreateUser $request) {
		$userDeatils = $request->all();
		$userDeatils['confirmation_code'] = str_random(30);
		$user = User::create($userDeatils);
        Mail::send('mail.welcome', $confirmation_code, function($message) {
            $message->to(Request::get('email'), Requests::get('username'))->subject('Verify your email address');
        });
		return "success";
	}
	public function read(ShowUser $request) {
		return Auth::User();
	}
	public function show(UpdateUser $request, User $user) {
		return $user;
	}
	public function update(UpdateUser $request, User $user) {
		$user->update($request->all());
	}
	public function destory(UpdateUser $request, User $user) {
		$user->update(['deleted' => 1]);
	}

	public function confirm($confirmation_code) {
		if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return "success";
	}

}
