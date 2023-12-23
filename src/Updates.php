<?php

namespace PhpCompiler\Telegram;

use Monolog\{Handler\StreamHandler, Level, Logger};
use PhpCompiler\{Telegram\Exception\InvalidUpdateException, Telegram\Tools\Customiz, Telegram\Tools\Utils};

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
        self::CHAT_JOIN_REQUEST
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
        'chat_join_request'
    ];

    /**
     * @var mixed|array
     */
    public mixed $updates = [];
    /**
     * @var mixed
     */
    public mixed $updateType;

    /**
     * @param bool $option
     * @return mixed
     * @throws InvalidUpdateException
     */
    public function getUpdates(bool $option = true): mixed
    {
        $updates              = json_decode(file_get_contents('php://input'), $option);
        if (empty($updates)) exit('I can\'t trust you!');
        $updateType           = Utils::fetchUpdateTypeName($updates);
        if (!in_array($updateType, self::AVAILABLE_TYPES_NAME)) {
            if (!empty(Request::$Logger)) {
                $Logger = new Logger('UPDATE_IS_INVILD');
                $Logger->pushHandler(new StreamHandler(Request::$Logger, Level::Warning));
                $Logger->log(Level::Warning, 'The desired index is not available in the list of handled updates.');
            }
            throw new InvalidUpdateException('UPDATE_IS_INVILD');
        }
        $this->updateType     = $updateType;
        $this->{$updateType}  = $updates[$updateType];
        $this->updates        = $updates;
        return $updates;
    }

    /**
     * @return string|null
     */
    public function firstName(): string|null
    {
        $type = $this->updateType;
        return htmlspecialchars(
            match ($type) {
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
                'chat_join_request' => $this->{$type}['from']['first_name'] ?? NULL,
                'poll_answer'       => $this->{$type}['user']['first_name'] ?? NULL,
                default             => NULL
            },
            ENT_NOQUOTES
        );
    }

    /**
     * @return string|null
     */
    public function lastName(): string|null
    {
        $type = $this->updateType;
        return htmlspecialchars(
            match ($type) {
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
                'chat_join_request' => $this->{$type}['from']['last_name'] ?? NULL,
                'poll_answer'       => $this->{$type}['user']['last_name'] ?? NULL,
                default             => NULL
        },
            ENT_NOQUOTES
        );
    }

    /**
     * @return mixed
     */
    public function userName(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
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
            'chat_join_request' => $this->{$type}['from']['username'] ?? NULL,
            'poll_answer'       => $this->{$type}['user']['username'] ?? NULL,
            default             => NULL
        };
    }

    /**
     * @return int|null
     */
    public function chatId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'my_chat_member',
            'chat_member',
            'chat_join_request' => $this->{$type}['chat']['id'] ?? NULL,
            'callback_query'    => $this->{$type}['message']['chat']['id'] ?? NULL,
            default             => NULL
        };
    }

    /**
     * @return int|null
     */
    public function fromId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
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
            'chat_join_request' => $this->{$type}['from']['id'] ?? NULL,
            'poll_answer'       => $this->{$type}['user']['id'] ?? NULL,
            default             => NULL
        };
    }

    /**
     * @return string|null
     */
    public function chatType(): string|null
    {
        $type     = $this->updateType;
        $response = match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'callback_query',
            'my_chat_member',
            'chat_member',
            'chat_join_request' => $this->{$type}['chat'] ?? '',
            'inline_query'      => $this->{$type},
            default             => NULL
        };
        return $response['type'] ?? $response['chat_type'] ?? null;
    }

    /**
     * @return int|null
     */
    public function messageId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post'  => $this->{$type}['message_id'],
            'callback_query'       => $this->{$type}['message']['message_id'] ?? NULL,
            default                => NULL
        };
    }

    /**
     * @return string|null
     */
    public function text(): string|null
    {
        $type = $this->updateType;
        return htmlspecialchars(
            match ($type) {
                'message',
                'edited_message',
                'channel_post',
                'edited_channel_post' => $this->{$type}['text'] ?? NULL,
                'callback_query'      => $this->{$type}['message']['text'] ?? NULL,
                default               => NULL
            },
            ENT_NOQUOTES
        );
    }

    /**
     * @return int|null
     */
    public function replyToMessageId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message']['message_id'] ?? NULL,
            'callback_query'      => $this->{$type}['message']['reply_to_message']['message_id'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return int|null
     */
    public function replyToMessageFromUserId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message']['forward_from']['id'] ?? NULL,
            'callback_query'      => $this->{$type}['message']['reply_to_message']['forward_from']['id'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return string|null
     */
    public function inlineQuery(): string|null
    {
        $type = $this->updateType;
        return match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type}['query'] ?? NULL,
            default                 => NULL
        };
    }

    /**
     * @return int|null
     */
    public function inlineQueryId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type}['id'] ?? NULL,
            default                 => NULL
        };
    }

    /**
     * @return int|null
     */
    public function inlineQueryFromId(): int|null
    {
        $type = $this->updateType;
        return match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type}['from']['id'] ?? NULL,
            default                 => NULL
        };
    }

    /**
     * @return string|null
     */
    public function replyToMessageText(): string|null
    {
        $type = $this->updateType;
        return match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message']['text'] ?? NULL,
            'callback_query'      => $this->{$type}['message']['reply_to_message']['text'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function callBackQuery(): mixed
    {
        $type = $this->updateType;
        return $this->{$type}['callback_query'];
    }

    /**
     * @return mixed
     */
    public function callBackQueryID(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'callback_query'      => $this->{$type}['id'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function callBackData(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'callback_query'      => $this->{$type}['data'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function callBackMessage(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'callback_query'      => $this->{$type}['message'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function callBackChatID(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'callback_query'      => $this->{$type}['message']['chat']['id'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function title(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'chat_member'         => $this->{$type}['chat']['title'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function chatMember(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'chat_member'         => $this->{$type}['chat_member'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function newChatMember(): mixed
    {
        $type = $this->updateType;
        return match ($type) {
            'chat_member'         => $this->{$type}['new_chat_member'] ?? NULL,
            default               => NULL
        };
    }

    /**
     * @return mixed
     */
    public function webAppData(): mixed
    {
        $type = $this->updateType;
        return htmlspecialchars(
            match ($type) {
                'message'   => $this->{$type}['web_app_data']['data'] ?? NULL,
                default     => []
            },
            ENT_NOQUOTES
        );
    }

    /**
     * @return mixed
     */
    public function webAppDataButton(): mixed
    {
        $type = $this->updateType;
        return htmlspecialchars(
            match ($type) {
                'message'   => $this->{$type}['web_app_data']['button_text'] ?? NULL,
                default     => []
            },
            ENT_NOQUOTES
        );
    }
}