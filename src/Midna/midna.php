<?php

namespace Midna;

use RedBeanPHP\R;
use Telegram\Bot\Api;

require_once __DIR__ . '/../../vendor/autoload.php';

define('MIDNA_TOKEN', 'xxxxxxxxx:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
define('MIDNA_HOOK', 'https://example.com/path/to/this/file.php');
define('MIDNA_CERT', '/path/to/your/ssl/certificate.pem');

$telegram = new Api( MIDNA_TOKEN );
R::setup('sqlite:' . __DIR__ . '/../../database/database.db');

$telegram -> addCommand( new Commands\Start() );
$telegram -> addCommand( new Commands\Help() );
$telegram -> commandsHandler( true );

if( php_sapi_name() == 'cli' )
{
    if ( $argv[1] == 'start')
    {
        print "Starting Midna" . PHP_EOL;

        $bean = R::dispense('messages');
        $bean -> message_id = 0;
        $bean -> message_date = 0;
        R::store( $bean );

        $telegram -> setWebhook( ['url' => MIDNA_HOOK, 'certificate' => MIDNA_CERT ] );
    }
    else if( $argv[1] == 'stop' )
    {
        print "Stopping Midna" . PHP_EOL;
        $telegram -> removeWebhook();
    }

    exit;
}

R::close();