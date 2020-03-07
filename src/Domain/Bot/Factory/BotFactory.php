<?php

namespace App\Domain\Bot\Factory;

use App\Application\Validator\BotValidator;
use App\Domain\Bot\Entity\Bot;
use Carbon\Carbon;

class BotFactory
{
    /**
     * @param array $botArray
     *
     * @return Bot
     */
    public function createFromRequest(array $botArray): Bot
    {
        $validator = new BotValidator();
        $validatedBot = $validator->validateBotData($botArray);

        $user = new Bot();

        $user->setSeosprintId($validatedBot['seosprintId']);
        $user->setBotName($validatedBot['botName']);
        $user->setBalance($validatedBot['balance']);
        $user->setDateTime(Carbon::now());

        return $user;
    }
}