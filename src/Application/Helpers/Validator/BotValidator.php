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
            'balance'
        ];

//        $botData = $request->getContent();


//        var_dump($request->getContent());die();
        var_dump($request->getConte);die();

        foreach ($keys as $key) {
            if (!array_key_exists($key, $botData)) {
                $botData[$key] = null;
            }
        }

        return $botData;
    }
}