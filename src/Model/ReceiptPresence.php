<?php

namespace App\Model;

use Dompdf\Dompdf;
use Lib\Auth\Authentication;

class ReceiptPresence {

	private $dompdf;
	private $presences;
	private $user;
	private $pdfHtml;
	private $toleranceMinutes;

	public function __construct() {
		$this->setPdf();
		$this->toleranceMinutes = 20;
	}

	private function setPdf() {
		$this->dompdf = new Dompdf();

		$this->dompdf->set_option('defaultFont', 'Courier');
	}

	private function setPdfHtml() {
		$this->getPdfHtml($this->presences, $this->user);

		$this->dompdf->loadHtml($this->pdfHtml);
	}

	public function getMyPresenceReceipt() {
		$this->getMyValidPresences();
		$this->setPdfHtml();
		$this->getPdf();
	}

	private function getPdf() {
		$this->dompdf->setPaper('A4', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream();
	}

	private function getMyValidPresences() {
		$this->getMyUser();

		foreach($this->user->presences as $presence) {
			$checkin = new \DateTime($presence->checkin);
			$checkout = new \DateTime($presence->checkout);

			$checkinLimit = new \DateTime($presence->event->startData);
			$checkinLimit->add(new \DateInterval('PT' . $this->toleranceMinutes . 'M'));

			$checkoutLimit = new \DateTime($presence->event->endData);
			$checkoutLimit->sub(new \DateInterval('PT' . $this->toleranceMinutes . 'M'));

			if($checkin < $checkinLimit && $checkout > $checkoutLimit) {
				$this->presences[] = $presence;
			}
		}

		return $this->presences;
	}

	private function getMyUser() {
		$id = Authentication::getUserId();

		$this->user = User::find($id);

		return $this->user;
	}

	private function getPdfHtml($presences, $user) {
		$receiptPresenceHtml = new ReceiptPresenceHtml();
		$receiptPresenceHtml->setUserData($user);
		$receiptPresenceHtml->setPresenceData($presences);

		$this->pdfHtml = $receiptPresenceHtml->getHtml();

		return $this->pdfHtml;
	}

}
