<?php

namespace PhpCompiler\Telegram\Tools;

use PhpCompiler\Telegram\Updates;

class Utils
{
    public static function fetchUpdateTypeName(array $update): string
    {
        return match (true) {
            isset($update['message'])              => 'message',
            isset($update['edited_message'])       => 'edited_message',
            isset($update['channel_post'])         => 'channel_post',
            isset($update['edited_channel_post'])  => 'edited_channel_post',
            isset($update['inline_query'])         => 'inline_query',
            isset($update['chosen_inline_result']) => 'chosen_inline_result',
            isset($update['callback_query'])       => 'callback_query',
            isset($update['shipping_query'])       => 'shipping_query',
            isset($update['pre_checkout_query'])   => 'pre_checkout_query',
            isset($update['poll'])                 => 'poll',
            isset($update['poll_answer'])          => 'poll_answer',
            isset($update['my_chat_member'])       => 'my_chat_member',
            isset($update['chat_member'])          => 'chat_member',
            isset($update['chat_join_request'])    => 'chat_join_request',
            default                                => throw new \InvalidArgumentException('INVALID_UPDATE'),
        };
    }

    public static function fetchUpdateTypeId(array $update): int
    {
        return match (true) {
            isset($update['message'])              => Updates::MESSAGE,
            isset($update['edited_message'])       => Updates::EDITED_MESSAGE,
            isset($update['channel_post'])         => Updates::CHANNEL_POST,
            isset($update['edited_channel_post'])  => Updates::EDITED_CHANNEL_POST,
            isset($update['inline_query'])         => Updates::INLINE_QUERY,
            isset($update['chosen_inline_result']) => Updates::CHOSEN_INLINE_RESULT,
            isset($update['callback_query'])       => Updates::CALLBACK_QUERY,
            isset($update['shipping_query'])       => Updates::SHIPPING_QUERY,
            isset($update['pre_checkout_query'])   => Updates::PRE_CHECKOUT_QUERY,
            isset($update['poll'])                 => Updates::POLL,
            isset($update['poll_answer'])          => Updates::POLL_ANSWER,
            isset($update['my_chat_member'])       => Updates::MY_CHAT_MEMBER,
            isset($update['chat_member'])          => Updates::CHAT_MEMBER,
            isset($update['chat_join_request'])    => Updates::CHAT_JOIN_REQUEST,
            default                                => throw new \InvalidArgumentException('INVALID_UPDATE'),
        };
    }
}