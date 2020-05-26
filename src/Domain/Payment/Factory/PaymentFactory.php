<?php

namespace App\Domain\Payment\Factory;

use App\Application\Helpers\Validator\PaymentValidator;
use App\Domain\Payment\Entity\Payment;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class PaymentFactory
{
    /**
     * @param Request $request
     *
     * @return Payment
     * @throws \Exception
     */
    public function createFromRequest(Request $request): Payment
    {
        $validator = new PaymentValidator();
        $validatedPayment = $validator->validatePaymentData($request);

        $payment = new Payment();

        $payment->setPayeerWallet($validatedPayment['payeer_wallet']);
        $payment->setAmount($validatedPayment['amount']);
        $payment->setUpdatedAt(Carbon::now());

        return $payment;
    }
}