<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateArticle extends Request
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
        $article=Article::find($this->route('article'));
        return $user->canEdit($article->user);
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
