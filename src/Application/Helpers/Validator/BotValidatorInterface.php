<?php

namespace App\Application\Validator;

use Symfony\Component\HttpFoundation\Request;

interface BotValidatorInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function validateBotData(Request $request): array;
}