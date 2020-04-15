<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

class RequestValidator implements RequestValidatorInterface
{
    /***
     * @param Request $request
     *
     * @return array
     */
    public function validateRequestData(Request $request): array
    {
        $keys = [
            'sender',
            'message',
        ];

        $requestData = $this->toArray($request);

        foreach ($keys as $key) {
            if (!array_key_exists($key, $requestData)) {
                $requestData[$key] = null;
            }
        }

        return $requestData;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function toArray(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }
}