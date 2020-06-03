<?php

namespace App\Application\Helpers\Validator;

use Symfony\Component\HttpFoundation\Request;

interface TaskValidatorInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function validateTaskData(Request $request): array;
}