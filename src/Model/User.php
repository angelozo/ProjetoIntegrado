<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Lib\Auth\Crypt;

class User extends Model {

	protected $table = 'usuario';
	protected $fillable = ['name','email','telefone', 'password', 'cidade', 'estado', 'tipoInstituicao', 'nomeInstituicao', 'cpf'];

	public function setPasswordAttribute($value) {
		$this->attributes['password'] = Crypt::setHash($value);
	}

	public function events() {
        return $this->belongsToMany('App\Model\Event', 'evento_usuario', 'usuario', 'evento');
    }

    public function isEnrolledTo($event) {
    	return (count($this->events) >= 1);
    }

    public function isBusyAtTimeOfEvent($eventToEnroll) {
    	$eventToEnrollStartDate = new \DateTime($eventToEnroll->startDate);
    	$eventToEnrollEndDate = new \DateTime($eventToEnroll->endDate);

    	if(!$this->isEnrolledToAnyEvent()) {
    		return false;
    	}

    	foreach ($this->events as $event) {
    		$eventStartDate = new \DateTime($event->startDate);
    		$eventEndDate = new \DateTime($event->endDate);

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