<?php

namespace App\Controller;

use App\Model\ReceiptEnrollment;

class ReceiptController extends Controller {

	private $receiptEnrollment;

	public function receiptEnrollmentPdf($request, $response, $args) {
		$this->receiptEnrollment = new ReceiptEnrollment;

		$this->receiptEnrollment->getMyEnrollmentReceipt();
	}
}
