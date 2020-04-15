<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\NotifierRepositoryInterface;

class NotifierRepository implements NotifierRepositoryInterface
{
    private const TELEGRAM_BOT_TOKEN = '123';
    private const URL = 'https://api.telegram.org/bot';
    private const METHOD_SEND_MESSAGE = '/sendMessage?';

    /**
     * @param array $requestData
     *
     * @return void
     */
    public function triggerDispatch(array $requestData): void
    {
        $recipients = ['440378244', '634606767'];

        $message = "<b>" . $requestData['sender'] . ": " . "</b>" . $requestData['message'];

        foreach ($recipients as &$recipientId){
            $this->callTelegramBot(
                self::METHOD_SEND_MESSAGE,
                [
                    'chat_id' => $recipientId,
                    'text' => $message,
                    'parse_mode' => 'html'
                ]
            );
        }
    }

    /**
     * @param string $method
     * @param array $params
     *
     * @return void
     */
    private function callTelegramBot(string $method, array $params): void
    {
        file_get_contents(
    self::URL .
            self::TELEGRAM_BOT_TOKEN .
            $method .
            http_build_query($params)
        );
    }
}