<?php

use PhpCompiler\Telegram\Exception\InvalidArgumentException;
use PhpCompiler\Telegram\Exception\InvalidUpdateException;
use PhpCompiler\Telegram\Request;

require_once __DIR__ . '/vendor/autoload.php';


try {
    $Telegram = new Request(
        Token : '5668503417:AAFlJRRB9ATDu9Cl0-wvqOqoKwDuv_Z5v5k',
        Logger: '/var/www/meysam.site/Telegram/Error.log'
    );
} catch (InvalidArgumentException $e) {
    exit();
}
$Telegram->closeConnection('Hello World');

try {
    $update = $Telegram->getUpdates();
} catch (InvalidUpdateException $e) {
}
$Text      = $Telegram->Text();
$firstName = $Telegram->FirstName();
$UserID    = $Telegram->FromID();
$ChatType  = $Telegram->ChatType();


if ($ChatType == 'private') {
    $response = $Telegram->sendMessage(
        chat_id     : $UserID,
        text        : '<code>' . json_encode($update, 448) . '</code>',
        parse_mode  : 'HTML'
    );
}