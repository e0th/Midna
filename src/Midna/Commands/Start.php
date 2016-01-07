<?php

namespace Midna\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class Start extends Command
{
    protected $name = "start";
    protected $description = "starting command";

    public function handle( $arguments )
    {
        $this -> replyWithChatAction( [ 'action' => Actions::TYPING ] );

        $response = 'Hello! I\'m Midna, type /help for a list of commands';
        $this -> replyWithMessage( [ 'text' => $response ]);
    }
}