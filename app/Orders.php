<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $dates = ['updated_at'];
    protected $guarded = ['id'];
}
