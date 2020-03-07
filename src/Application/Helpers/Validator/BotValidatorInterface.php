<?php

namespace App\Application\Validator;

interface BotValidatorInterface
{
    /**
     * @param array $botData
     *
     * @return array
     */
    public function validateBotData(array $botData): array;
}