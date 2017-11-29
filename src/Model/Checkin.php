<?php

namespace App\Model;

use Lib\Auth\Authentication;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model {

	protected $table = 'checkin_checkout';

	public function user() {
		return $this->belongsTo('App\Model\User', 'user_id');
	}

	public function event() {
		return $this->belongsTo('App\Model\Event', 'event_id');
	}

}
