<?php

namespace App\Model;

use Dompdf\Dompdf;
use Lib\Auth\Authentication;

class ReceiptEnrollment {

	private $dompdf;
	private $events;
	private $user;
	private $pdfHtml;

	public function __construct() {
		$this->setPdf();
	}

	private function setPdf() {
		$this->dompdf = new Dompdf();

		$this->dompdf->set_option('defaultFont', 'Courier');
	}

	private function setPdfHtml() {
		$this->getPdfHtml($this->events, $this->user);

		$this->dompdf->loadHtml($this->pdfHtml);
	}

	public function getMyEnrollmentReceipt() {
		$this->getMyEvents();
		$this->setPdfHtml();
		$this->getPdf();
	}

	private function getPdf() {
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream();
	}

	private function getMyEvents() {
		$this->getMyUser();

		$this->events = $this->user->events;

		return $this->events;
	}

	private function getMyUser() {
		$id = Authentication::getUserId();

		$this->user = User::find($id);

		return $this->user;
	}

	private function getPdfHtml($events, $user) {
		$receiptEnrollmentHtml = new ReceiptEnrollmentHtml();
		$receiptEnrollmentHtml->setUserData($user);
		$receiptEnrollmentHtml->setEventData($events);

		$this->pdfHtml = $receiptEnrollmentHtml->getHtml();

		return $this->pdfHtml;
	}

}
