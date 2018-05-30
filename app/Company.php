<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'company';


	public function users()
	{
    	return $this->hasMany(user::class);
    }
}
