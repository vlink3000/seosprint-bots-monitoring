<?php

namespace App\Domain\Bot\Factory;

use App\Application\Validator\BotValidator;
use App\Domain\Bot\Entity\Bot;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class BotFactory
{
    /**
     * @param Request $request
     *
     * @return Bot
     */
    public function createFromRequest(Request $request): Bot
    {
        $validator = new BotValidator();
        $validatedBot = $validator->validateBotData($request);

        $user = new Bot();

        var_dump($validatedBot);die();

        $user->setSeosprintId($validatedBot['seosprintId']);
        $user->setBotName($validatedBot['botName']);
        $user->setBalance($validatedBot['balance']);
        $user->setDateTime(Carbon::now());

        return $user;
    }
}