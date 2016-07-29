<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User, App\Article, Carbon\Carbon, JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ShowArticle extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $article = $this->route('article');

        if ($article->viewable){
            return true;
        }
        
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return false;
            }
        }
        catch (\Exception $e) {
            return false;
        }
        return $article->user->id == $user->id || $user->isAnAdmin();
   
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
