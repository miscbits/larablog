<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $fillable = [
		'title', 'body', 'publish', 'published_at',
	];
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function categories() {
		return $this->belongsToMany('App\Category');
	}
}
