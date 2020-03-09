<?php

namespace App\Application\Validator;

use Symfony\Component\HttpFoundation\Request;

class BotValidator implements BotValidatorInterface
{
    /***
     * @param Request $request
     *
     * @return array
     */
    public function validateBotData(Request $request): array
    {
        $keys = [
            'seosprintId',
            'botName',
            'balance',
            'clicked'
        ];

        $botData = $this->toArray($request);

        foreach ($keys as $key) {
            if (!array_key_exists($key, $botData)) {
                $botData[$key] = null;
            }
        }

        return $botData;
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