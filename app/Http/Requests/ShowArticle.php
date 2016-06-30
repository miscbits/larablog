<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User, App\Article, Carbon\Carbon;

class ShowArticle extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = Article::find($this->route('article'));

        if ($this->viewable)
            return true;
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $user = new User;
            }
        } catch (Exception $e) {
            $user = new User;
        }
        return $article->user->is($user) || $user->isAnAdmin();
   
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
