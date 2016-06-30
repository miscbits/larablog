<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAnAdmin() {
        return $this->admin == 1;
    }

    public function canEdit($userID) {
        $user = User::find($userID);
        $thisIsTheSameUser = ($userID == $this->id);
        $thisUserIsAnAdminAndTheOtherUserIsNot = (!($user->isAnAdmin()) && $this->isAnAdmin());
        return ($thisIsTheSameUser 
            || $thisUserIsAnAdminAndTheOtherUserIsNot);
    }

    public function articles() {
        return $this->hasMany('App\Article');
    }
    
}
