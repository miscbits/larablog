<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use JWTAuth;
use JWTException;

class ShowUser extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
        // the token is valid and we have found the user via the sub claim
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
