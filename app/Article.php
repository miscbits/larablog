<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    public function scopeActive($query) {
    	return $query->where('publish', 1)->where('published_at', '<', Carbon\Carbon::now())->where('deleted', '!=', 1)
    }

	protected $fillable = [
		'title', 'body', 'publish', 'published_at',
	];
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function categories() {
		return $this->belongsToMany('App\Category');
	}

	public function viewable() {
		return !($this->deleted) && $this->published_at <= Carbon::now();
	}

}
