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

        $bot = new Bot();

        $bot->setSeosprintId($validatedBot['seosprintId']);
        $bot->setBotName($validatedBot['botName']);
        $bot->setLevel($validatedBot['level']);
        $bot->setBalance($validatedBot['balance']);
        $bot->setDailyBalance($validatedBot['clickAmount']);
        $bot->setClicked($validatedBot['clicked']);
        $bot->setDateTime(Carbon::now());

        return $bot;
    }
}