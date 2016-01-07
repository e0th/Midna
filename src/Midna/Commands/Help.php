<?php

namespace Midna\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class Help extends Command
{
    protected $name = "help";
    protected $description = "Commands list";

    public function handle( $arguments )
    {
        $this -> replyWithMessage( [ 'text' => 'This is my commands list: ' ] );
        $this -> replyWithChatAction( [ 'action' => Actions::TYPING ] );

        $response = '';
        $commands = $this -> getTelegram() -> getCommands();
        foreach( $commands as $name => $command )
        {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }

        $this -> replyWithMessage( [ 'text' => $response ] );
    }
}