<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

class PaymentValidator implements PaymentValidatorInterface
{
    /***
     * @param Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function validatePaymentData(Request $request): array
    {
        $keys = [
            'payeer_wallet',
            'amount'
        ];

        $payment = $this->toArray($request);

        foreach ($keys as $key) {
            if (!array_key_exists($key, $payment)) {
                throw new \Exception('Incorrect key: '.$payment[$key], 422);
            }
        }

        return $payment;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function toArray (Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}