<?php

namespace App\Controller;

use App\Model\ReceiptEnrollment;
use App\Model\ReceiptPresence;

class ReceiptController extends Controller {

	private $receiptEnrollment;
	private $receiptPresence;

	public function receiptEnrollmentPdf($request, $response, $args) {
		$this->receiptEnrollment = new ReceiptEnrollment;

		$this->receiptEnrollment->getMyEnrollmentReceipt();
	}

	public function receiptPresencePdf($request, $response, $args) {
		$this->receiptPresence = new ReceiptPresence;

		$this->receiptPresence->getMyPresenceReceipt();
	}
}
