<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userOrders extends Model
{
    protected $dates = ['deleted_at'];

	protected $guarded = ['id'];
}
