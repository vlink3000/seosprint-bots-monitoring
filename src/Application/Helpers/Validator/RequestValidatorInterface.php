<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

interface RequestValidatorInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function validateRequestData(Request $request): array;
}