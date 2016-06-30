<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateArticle extends Request
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
            'body' => 'required',
            'title' => 'required|max:50',
        ];
    }
}
