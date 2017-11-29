<?php

namespace App\Model;

class ReceiptPresenceHtml {

	private $html;
	private $header;
	private $footer;
	private $userData;

	private $presencesTableHeader;
	private $presencesTableFooter;
	private $presencesTableRow;
	private $presenceTableColBase;

	private $presenceTable;

	public function __construct() {
		$this->setBaseHtml();
	}

	private function setBaseHtml() {
		$this->header = "<!DOCTYPE html><html><head><title>Lista de presenças</title></head><body><div style='padding: 30px; position: absolute;top: 0;left: 0;width: 100%;height: 100%;box-sizing: border-box;'><h1 style='text-align: center;'>Lista de presenças</h1>";

		$this->presenceTableColBase = "<td style='border: 1px solid #000000; padding: 5px 10px'>{data}</td>";

		$this->userData = "<ul style='list-style: none; font-size: 16px; letter-spacing: 1px;line-height: 25px;padding: 0;margin: 0;'><li>Nome:{nome}</li><li>CPF:{cpf}</li><li>Hora de geração do comprovante:{hora}</li></ul>";

		$this->presencesTableHeader = "<table style='position: relative;top: 30px;margin: 0 auto;border: 1px solid #000000;border-collapse: collapse; width: 100%'><tr><th style='border: 1px solid #000000; padding: 5px 10px'>Minhas presenças em eventos</th><th style='border: 1px solid #000000; padding: 5px 10px'>Data</th><th style='border: 1px solid #000000; padding: 5px 10px'>Entrada</th><th style='border: 1px solid #000000; padding: 5px 10px'>Saída</th></tr>";

		$this->presencesTableFooter = "</table>";

		$this->footer = "</div></body></html>";
	}

	public function setUserData($user) {
		$now = new \DateTime();

		$this->userData = str_replace('{nome}', $user->name, $this->userData);
		$this->userData = str_replace('{cpf}', $user->cpf, $this->userData);
		$this->userData = str_replace('{hora}', $now->format('d/m/Y H:i:s'), $this->userData);
	}

	public function setPresenceData($presences) {
		if(count($presences) > 0) {
			foreach ($presences as $presence) {
				$this->addRow($presence);
			}
		} else {
			$this->addEmptyAlertRow();
		}
	}

	private function addRow($presence) {
		$row = '<tr>';

		$checkin = new \DateTime($presence->checkin);
		$checkout = new \DateTime($presence->checkout);
		$eventData = new \DateTime($presence->event->startData);

		$nameCol = str_replace('{data}', $presence->event->nome, $this->presenceTableColBase);
		$row .= $nameCol;

		$eventDateCol = str_replace('{data}', $eventData->format('d/m/Y'), $this->presenceTableColBase);
		$row .= $eventDateCol;

		$checkInCol = str_replace('{data}', $checkin->format('H:i'), $this->presenceTableColBase);
		$row .= $checkInCol;

		$checkoutCol = str_replace('{data}', $checkout->format('H:i'), $this->presenceTableColBase);
		$row .= $checkoutCol;

		$row .= '</tr>';

		$this->presencesTableRow .= $row;
	}

	public function addEmptyAlertRow() {
		$row = '<tr>';
		$row .= 'Você não teve nenhuma presença em eventos.';
		$row .= '</tr>';

		$this->presencesTableRow .= $row;
	}

	public function getHtml() {
		$this->buildHtml();

		return $this->html;
	}

	private function buildHtml() {
		$this->html = '';

		$this->html .= $this->header;
		$this->html .= $this->userData;
		$this->html .= $this->presencesTableHeader;
		$this->html .= $this->presencesTableRow;
		$this->html .= $this->presencesTableFooter;
		$this->html .= $this->footer;

		return $this->html;
	}

}
