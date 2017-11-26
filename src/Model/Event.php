<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Lib\Auth\Authentication;

class Event extends Model {

	protected $table = 'evento';
	protected $fillable = ['nome','startData','endData', 'local', 'disponivelParaAlunos', 'disponivelParaExterno', 'palestrante', 'descricao', 'limiteUsuarios', 'inscricao'];

	public function spectators() {
        return $this->belongsToMany('App\Model\User', 'evento_usuario', 'evento', 'usuario');
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

    public function areYouEnrolledWithThisEvent() {
        $yourID = Authentication::getUserId();

        return ($this->spectators->where('id', '=', $yourID)->count() > 0);
    }

    public function areYouBusyAtTimeOfThisEvent() {
        $yourID = Authentication::getUserId();

        $user = User::where('id', $yourID)->first();

        return $user->isBusyAtTimeOfEvent($this);
    }
}
