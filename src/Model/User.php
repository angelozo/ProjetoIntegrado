<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Lib\Auth\Crypt;

class User extends Model {

	protected $table = 'usuario';
	protected $fillable = ['name','email','telefone', 'password', 'cidade', 'estado', 'tipoInstituicao', 'nomeInstituicao', 'cpf'];

	public function setPasswordAttribute($value) {
		$this->attributes['password'] = Crypt::setHash($value);

        return $this->attributes['password'];
	}

	public function events() {
        return $this->belongsToMany('App\Model\Event', 'inscricao', 'usuario', 'evento');
    }

    public function presences() {
        return $this->hasMany('App\Model\Checkin');
    }

    public function isEnrolledTo($event) {
    	return (count($this->events) >= 1);
    }

    public function isBusyAtTimeOfEvent($eventToEnroll) {
    	$eventToEnrollStartDate = new \DateTime($eventToEnroll->startData);
    	$eventToEnrollEndDate = new \DateTime($eventToEnroll->endData);

    	if(!$this->isEnrolledToAnyEvent()) {
    		return false;
    	}

    	foreach ($this->events as $event) {
    		$eventStartDate = new \DateTime($event->startData);
    		$eventEndDate = new \DateTime($event->endData);

    		if($eventEndDate > $eventToEnrollStartDate && $eventStartDate < $eventToEnrollEndDate) {
    			return true;
    		}
    	}

    	return false;
    }

    public function isEnrolledToAnyEvent() {
    	return (count($this->events) > 0);
    }
}