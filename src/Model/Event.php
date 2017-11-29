<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Lib\Auth\Authentication;

class Event extends Model {

	protected $table = 'evento';
	protected $fillable = ['nome','startData','endData', 'local', 'disponivelParaAlunos', 'disponivelParaExterno', 'palestrante', 'descricao', 'limiteUsuarios', 'inscricao'];

	public function spectators() {
        return $this->belongsToMany('App\Model\User', 'inscricao', 'evento', 'usuario');
    }

    public function presences() {
        return $this->hasMany('App\Model\CheckinCheckout');
    }

    public function isInscribable() {
    	return ($this->inscricao == 1);
    }

    public function haveSlots() {
    	return ($this->getRemainingSlots() > 0);
    }

    public function getRemainingSlots() {
        return $this->limiteUsuarios - $this->spectators->count();
    }

    public function alredyHappened() {
        $now = new \DateTime();
        $endData = new \DateTime($this->endData);

        return ($now > $endData);
    }

    public function areYouEnrolledWithThisEvent() {
        $yourID = Authentication::getUserId();

        return ($this->spectators->where('id', '=', $yourID)->count() > 0);
    }

    public function areYouBusyAtTimeOfThisEvent() {
        $yourID = Authentication::getUserId();

        $user = User::where('id', $yourID)->first();

        return $user->isBusyAtTimeOfEvent($this);
    }

    public function getFormattedDate() {
        $date = new \DateTime($this->startData);

        return $date->format('d/m/Y');
    }

    public function getStartHour() {
        $date = new \DateTime($this->startData);

        return $date->format('H:i');
    }

    public function getEndHour() {
        $date = new \DateTime($this->endData);

        return $date->format('H:i');
    }
}
