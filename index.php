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

$Text                     = $Telegram->text();
$Title                    = $Telegram->title();
$firstName                = $Telegram->firstName();
$lastName                 = $Telegram->lastName();
$userName                 = $Telegram->userName();
$UserID                   = $Telegram->fromID();
$ChatID                   = $Telegram->chatId();
$ChatType                 = $Telegram->chatType();
$MessageId                = $Telegram->messageId();
$ChatMember               = $Telegram->chatMember();
$NewChatMember            = $Telegram->newChatMember();
$Callback_Data            = $Telegram->callBackData();
$CallbackQueryID          = $Telegram->callBackQueryID();
$ReplyToMessageId         = $Telegram->replyToMessageId();
$ReplyToMessageFromUserId = $Telegram->replyToMessageFromUserId();
$InlineQuery              = $Telegram->inlineQuery();
$InlineQueryId            = $Telegram->inlineQueryId();
$InlineQueryFromId        = $Telegram->inlineQueryFromId();
$ReplyToMessageText       = $Telegram->replyToMessageText();
$WebAppData               = $Telegram->webAppData();
$WebAppDataButton         = $Telegram->webAppDataButton();


if ($ChatType == 'private') {
    $response = $Telegram->sendMessage(
        chat_id     : $UserID,
        text        : '<code>' . json_encode($update, 448) . '</code>',
        parse_mode  : 'HTML'
    );
}