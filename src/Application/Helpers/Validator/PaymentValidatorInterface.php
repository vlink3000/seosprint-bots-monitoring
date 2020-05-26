<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

interface PaymentValidatorInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function validatePaymentData(Request $request): array;
}