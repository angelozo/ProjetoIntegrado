<?php

namespace App\Model;

class ReceiptEnrollmentHtml {

	private $html;
	private $header;
	private $footer;
	private $userData;

	private $eventTableHeader;
	private $eventTableFooter;
	private $eventTableRows;
	private $eventTableColBase;

	private $eventTable;

	public function __construct() {
		$this->setBaseHtml();
	}

	private function setBaseHtml() {
		$this->header = "<!DOCTYPE html><html><head><title>Comprovante de inscrição</title></head><body><div style='padding: 30px; position: absolute;top: 0;left: 0;width: 100%;height: 100%;box-sizing: border-box;'><h1 style='text-align: center;'>Comprovante de inscrição</h1>";

		$this->eventTableColBase = "<td style='border: 1px solid #000000; padding: 5px 10px'>{data}</td>";

		$this->userData = "<ul style='list-style: none; font-size: 16px; letter-spacing: 1px;line-height: 25px;padding: 0;margin: 0;'><li>Nome:{nome}</li><li>CPF:{cpf}</li><li>Hora de geração do comprovante:{hora}</li></ul>";

		$this->eventTableHeader = "<table style='position: relative;top: 30px;margin: 0 auto;border: 1px solid #000000;border-collapse: collapse; width: 100%'><tr><th style='border: 1px solid #000000; padding: 5px 10px'>Evento(s) em que estou inscrito</th><th style='border: 1px solid #000000; padding: 5px 10px'>Data</th><th style='border: 1px solid #000000; padding: 5px 10px'>Hora Início</th><th style='border: 1px solid #000000; padding: 5px 10px'>Local</th></tr>";

		$this->eventTableFooter = "</table>";

		$this->footer = "</div></body></html>";
	}

	public function setUserData($user) {
		$now = new \DateTime();

		$this->userData = str_replace('{nome}', $user->name, $this->userData);
		$this->userData = str_replace('{cpf}', $user->cpf, $this->userData);
		$this->userData = str_replace('{hora}', $now->format('d/m/Y H:i:s'), $this->userData);
	}

	public function setEventData($events) {
		if(count($events) > 0) {
			foreach ($events as $event) {
				$this->addRow($event);
			}
		} else {
			$this->addEmptyAlertRow();
		}
	}

	private function addRow($event) {
		$row = '<tr>';

		$startData = new \DateTime($event->startData);

		$nameCol = str_replace('{data}', $event->nome, $this->eventTableColBase);
		$row .= $nameCol;

		$dateCol = str_replace('{data}', $startData->format('d/m/Y'), $this->eventTableColBase);
		$row .= $dateCol;

		$hourCol = str_replace('{data}', $startData->format('H:i'), $this->eventTableColBase);
		$row .= $hourCol;

		$localCol = str_replace('{data}', $event->local, $this->eventTableColBase);
		$row .= $localCol;

		$row .= '</tr>';

		$this->eventTableRows .= $row;
	}

	public function addEmptyAlertRow() {
		$row = '<tr>';
		$row .= 'Não cadastrado em nenhum evento.';
		$row .= '</tr>';

		$this->eventTableRows .= $row;
	}

	public function getHtml() {
		$this->buildHtml();

		return $this->html;
	}

	private function buildHtml() {
		$this->html = '';

		$this->html .= $this->header;
		$this->html .= $this->userData;
		$this->html .= $this->eventTableHeader;
		$this->html .= $this->eventTableRows;
		$this->html .= $this->eventTableFooter;
		$this->html .= $this->footer;

		return $this->html;
	}

}
