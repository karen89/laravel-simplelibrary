<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Book extends Model {
	
	// Determines which database table to use
   	protected $table = 'books';

	public function user() {
		return $this->belongsTo('App\User');
	}
}