<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	/**
	* mass assignable columns
	*/
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
