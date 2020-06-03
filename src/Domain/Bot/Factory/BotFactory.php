<?php

namespace App\Domain\Bot\Factory;

use App\Application\Helpers\Validator\BotValidator;
use App\Domain\Bot\Entity\Task;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class BotFactory
{
    /**
     * @param Request $request
     *
     * @return Task
     */
    public function createFromRequest(Request $request): Task
    {
        $validator = new BotValidator();
        $validatedBot = $validator->validateBotData($request);

        $bot = new Task();

        $bot->setSeosprintId($validatedBot['seosprintId']);
        $bot->setBotName($validatedBot['botName']);
        $bot->setBalance($validatedBot['balance']);
        $bot->setLevel($validatedBot['level']);
        $bot->setLastRequestAt(Carbon::now());

        return $bot;
    }
}