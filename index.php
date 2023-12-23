<?php

use PhpCompiler\Telegram\Exception\InvalidArgumentException;
use PhpCompiler\Telegram\Exception\InvalidUpdateException;
use PhpCompiler\Telegram\Request;

require_once __DIR__ . '/vendor/autoload.php';


try {
    $Telegram = new Request(
        Token : '6177871422:AAFEeAypDvcLZGsp5tg5PlPz_BdpTjvKErs', //Robot Access Token
        Logger: '/home/meshetabanvps/Log/Error' //Log creation path
    );
} catch (InvalidArgumentException $e) {
    exit();
}

$Telegram->closeConnection('Hello World');

try {
    $update = $Telegram->getUpdates();
} catch (InvalidUpdateException $e) {
    exit();
}

$Text                     = $Telegram->Text();
$Title                    = $Telegram->Title();
$firstName                = $Telegram->FirstName();
$lastName                 = $Telegram->LastName();
$userName                 = $Telegram->UserName();
$UserID                   = $Telegram->FromID();
$ChatID                   = $Telegram->ChatId();
$ChatType                 = $Telegram->ChatType();
$MessageId                = $Telegram->MessageId();
$ChatMember               = $Telegram->ChatMember();
$NewChatMember            = $Telegram->NewChatMember();
$Callback_Data            = $Telegram->Callback_Data();
$CallbackQueryID          = $Telegram->CallbackQueryID();
$ReplyToMessageId         = $Telegram->ReplyToMessageId();
$ReplyToMessageFromUserId = $Telegram->ReplyToMessageFromUserId();
$InlineQuery              = $Telegram->InlineQuery();
$InlineQueryId            = $Telegram->InlineQueryId();
$InlineQueryFromId        = $Telegram->InlineQueryFromId();
$ReplyToMessageText       = $Telegram->ReplyToMessageText();
$WebAppData               = $Telegram->WebAppData();
$WebAppDataButton         = $Telegram->WebAppDataButton();


if ($ChatType == 'private') {
    $response = $Telegram->sendMessage(
        chat_id     : $UserID,
        text        : '<code>' . json_encode($update, 448) . '</code>',
        parse_mode  : 'HTML'
    );
}