<?php

namespace App\Application\Validator;

class BotValidator implements BotValidatorInterface
{
    /***
     * @param array $botData
     *
     * @return array
     */
    public function validateBotData(array $botData): array
    {
        $keys = [
            'seosprintId',
            'userName',
            'balance'
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $botData)) {
                $botData[$key] = null;
            }
        }

        return $botData;
    }
}