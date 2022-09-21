<?php

namespace Tsco\Api\Telegram;

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Tsco\Api\Telegram\Exception\InvalidUpdateException;
use Tsco\Api\Telegram\Tools\Customiz;
use Tsco\Api\Telegram\Tools\Utils;

class Updates extends Customiz
{

    const UPDATE_TYPE_DEFAULT = 1;
    const UPDATE_TYPE_WEBHOOK = 2;

    const MESSAGE              = 1;
    const EDITED_MESSAGE       = 2;
    const CHANNEL_POST         = 3;
    const EDITED_CHANNEL_POST  = 4;
    const INLINE_QUERY         = 5;
    const CHOSEN_INLINE_RESULT = 6;
    const CALLBACK_QUERY       = 7;
    const SHIPPING_QUERY       = 8;
    const PRE_CHECKOUT_QUERY   = 9;
    const POLL                 = 10;
    const POLL_ANSWER          = 11;
    const MY_CHAT_MEMBER       = 12;
    const CHAT_MEMBER          = 13;
    const CHAT_JOIN_REQUEST    = 14;
    const AVAILABLE_TYPES      = [
        self::MESSAGE,
        self::EDITED_MESSAGE,
        self::CHANNEL_POST,
        self::EDITED_CHANNEL_POST,
        self::INLINE_QUERY,
        self::CHOSEN_INLINE_RESULT,
        self::CALLBACK_QUERY,
        self::SHIPPING_QUERY,
        self::PRE_CHECKOUT_QUERY,
        self::POLL,
        self::POLL_ANSWER,
        self::MY_CHAT_MEMBER,
        self::CHAT_MEMBER,
        self::CHAT_JOIN_REQUEST,
    ];

    const AVAILABLE_TYPES_NAME = [
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'inline_query',
        'chosen_inline_result',
        'callback_query',
        'shipping_query',
        'pre_checkout_query',
        'poll',
        'poll_answer',
        'my_chat_member',
        'chat_member',
        'chat_join_request',
    ];

    /**
     * @var mixed|array
     */
    public mixed $Updates = [];
    /**
     * @var mixed
     */
    public mixed $UpdateType;

    /**
     * @param bool $Option
     * @return mixed
     * @throws InvalidUpdateException
     */
    public function getUpdates(bool $Option = true): mixed
    {
        $Updates              = json_decode(file_get_contents('php://input'), $Option);
        $UpdateType           = Utils::fetchUpdateTypeName($Updates);
        if (!in_array($UpdateType, self::AVAILABLE_TYPES_NAME)) {
            if (!empty(Request::$Logger)) {
                $Logger = new Logger('UPDATE_IS_INVILD');
                $Logger->pushHandler(new StreamHandler(Request::$Logger, Level::Warning));
                $Logger->log(Level::Warning, 'The desired index is not available in the list of handled updates.');
            }
            throw new InvalidUpdateException('UPDATE_IS_INVILD');
        }
        $this->UpdateType     = $UpdateType;
        $this->{$UpdateType}  = $Updates[$UpdateType];
        $this->Updates        = $Updates;
        return $Updates;
    }

    /**
     * @return string
     */
    public function FirstName(): string
    {
        $type = $this->UpdateType;
        return htmlspecialchars((match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post', 
            'inline_query', 
            'chosen_inline_result', 
            'callback_query', 
            'pre_checkout_query', 
            'my_chat_member', 
            'chat_member', 
            'chat_join_request' => $this->{$type}['from'],
            'poll_answer'       => $this->{$type}['user'],
            default             => []
        })['first_name'], ENT_NOQUOTES) ?? '';
    }

    /**
     * @return string
     */
    public function LastName(): string
    {
        $type = $this->UpdateType;
        return htmlspecialchars((match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post', 
            'inline_query', 
            'chosen_inline_result', 
            'callback_query', 
            'pre_checkout_query', 
            'my_chat_member', 
            'chat_member', 
            'chat_join_request' => $this->{$type}['from'],
            'poll_answer'       => $this->{$type}['user'],
            default             => []
        })['last_name'], ENT_NOQUOTES) ?? '';
    }

    /**
     * @return mixed
     */
    public function UserName(): mixed
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post', 
            'inline_query', 
            'chosen_inline_result', 
            'callback_query', 
            'pre_checkout_query', 
            'my_chat_member', 
            'chat_member', 
            'chat_join_request' => $this->{$type}['from'],
            'poll_answer'       => $this->{$type}['user'],
            default             => []
        })['username'] ?? '';
    }

    /**
     * @return int
     */
    public function ChatId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post', 
            'my_chat_member', 
            'chat_member', 
            'chat_join_request' => $this->{$type}['chat'],
            'callback_query'    => $this->{$type}['message']['chat'],
            default             => [],
        })['id'] ?? 0;
    }


    /**
     * @return string|null
     */
    public function ChatType(): string|null
    {
        $type     = $this->UpdateType;
        $response = match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'callback_query',
            'my_chat_member',
            'chat_member',
            'chat_join_request' => $this->{$type}['chat'],
            'inline_query'      => $this->{$type},
            default             => [],
        };
        return $response['type'] ?? $response['chat_type'] ?? null;
    }
    
    /**
     * @return int
     */
    public function FromId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post', 
            'inline_query', 
            'chosen_inline_result', 
            'callback_query', 
            'pre_checkout_query', 
            'my_chat_member', 
            'chat_member', 
            'chat_join_request' => $this->{$type}['from'],
            'poll_answer'       => $this->{$type}['user'],
            default             => []
        })['id'] ?? 0;
    }
    
    /**
     * @return int
     */
    public function MessageId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post'  => $this->{$type},
            'callback_query'       => $this->{$type}['message'],
            default                => []
        })['message_id'] ?? 0;
    }

    /**
     * @return string
     */
    public function Text(): string
    {
        $type = $this->UpdateType;
        return htmlspecialchars((match ($type) {
            'message', 
            'edited_message', 
            'channel_post', 
            'edited_channel_post' => $this->{$type},
            'callback_query'      => $this->{$type}['message'],
            default               => []
        })['text']) ?? '';
    }

    /**
     * @return int
     */
    public function ReplyToMessageId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message'],
            'callback_query'      => $this->{$type}['message']['reply_to_message'],
            default               => []
        })['message_id'] ?? 0;
    }

    /**
     * @return int
     */
    public function ReplyToMessageFromUserId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message']['forward_from'],
            'callback_query'      => $this->{$type}['message']['reply_to_message']['forward_from'],
            default               => []
        })['id'] ?? 0;
    }

    /**
     * @return string
     */
    public function InlineQuery(): string
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type},
            default                 => []
        })['query'] ?? '';
    }

    /**
     * @return int
     */
    public function InlineQueryId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type},
            default                 => []
        })['id'] ?? 0;
    }

    /**
     * @return int
     */
    public function InlineQueryFromId(): int
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type}['from'],
            default                 => []
        })['id'] ?? 0;
    }

    /**
     * @return string
     */
    public function ReplyToMessageText(): string
    {
        $type = $this->UpdateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message'],
            'callback_query'      => $this->{$type}['message']['reply_to_message'],
            default               => []
        })['text'] ?? '';
    }

//    /**
//     * @return mixed
//     */
//    public function phone(): mixed
//    {
//        return $this->Updates['message']['contact'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function phoneho(): mixed
//    {
//        return $this->Updates['message']['contact']['user_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function LinkType(): mixed
//    {
//        return $this->Updates['message']['entities'][0]['type'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function LinkUrl(): mixed
//    {
//        return $this->Updates['message']['entities'][0]['url'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function phonenu(): mixed
//    {
//        return $this->Updates['message']['contact']['phone_number'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function documentid(): mixed
//    {
//        return $this->Updates['message']['document']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function stickerid(): mixed
//    {
//        return $this->Updates['message']['sticker']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function gifid(): mixed
//    {
//        return $this->Updates['message']['animation']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function audioid(): mixed
//    {
//        return $this->Updates['message']['audio']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function voiceid(): mixed
//    {
//        return $this->Updates['message']['voice']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function videoid(): mixed
//    {
//        return $this->Updates['message']['video']['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function photoid(): mixed
//    {
//        return $this->Updates['message']['photo'][0]['file_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Callback_Query(): mixed
//    {
//        return $this->Updates['callback_query'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function CallbackQueryID(): mixed
//    {
//        return $this->Updates['callback_query']['id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Callback_Data(): mixed
//    {
//        return $this->Updates['callback_query']['data'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Callback_Message(): mixed
//    {
//        return $this->Updates['callback_query']['message'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Callback_ChatID(): mixed
//    {
//        return $this->Updates['callback_query']['message']['chat']['id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Date(): mixed
//    {
//        return $this->Updates['message']['date'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function Location(): mixed
//    {
//        return $this->Updates['message']['location'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function UpdateID(): mixed
//    {
//        return $this->Updates['update_id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function ForwardFromID(): mixed
//    {
//        return $this->Updates['message']['forward_from']['id'];
//    }
//
//    /**
//     * @return mixed
//     */
//    public function ForwardFromChatID(): mixed
//    {
//        return $this->Updates['message']['forward_from_chat']['id'];
//    }
}