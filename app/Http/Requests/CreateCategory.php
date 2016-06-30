<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCategory extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            return (JWTAuth::parseToken()->authenticate()->isAnAdmin());
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
