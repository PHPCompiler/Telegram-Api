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
     * @return string
     */
    public function firstName(): string
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
                'chat_join_request' => $this->{$type}['from']['first_name'] ?? '',
                'poll_answer'       => $this->{$type}['user']['first_name'] ?? '',
                default             => []
            },
            ENT_NOQUOTES
        );
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        $type = $this->updateType;
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
        })['last_name'] ?? '', ENT_NOQUOTES) ?? '';
    }

    /**
     * @return mixed
     */
    public function userName(): mixed
    {
        $type = $this->updateType;
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
    public function chatId(): int
    {
        $type = $this->updateType;
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
     * @return int
     */
    public function fromId(): int
    {
        $type = $this->updateType;
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
            default             => [],
        };
        return $response['type'] ?? $response['chat_type'] ?? null;
    }

    /**
     * @return int
     */
    public function messageId(): int
    {
        $type = $this->updateType;
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
    public function text(): string
    {
        $type = $this->updateType;
        return htmlspecialchars((match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type},
            'callback_query'      => $this->{$type}['message'],
            default               => []
        })['text'] ?? '');
    }

    /**
     * @return int
     */
    public function replyToMessageId(): int
    {
        $type = $this->updateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message'] ?? '',
            'callback_query'      => $this->{$type}['message']['reply_to_message'] ?? '',
            default               => []
        })['message_id'] ?? 0;
    }

    /**
     * @return int
     */
    public function replyToMessageFromUserId(): int
    {
        $type = $this->updateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message']['forward_from'] ?? '',
            'callback_query'      => $this->{$type}['message']['reply_to_message']['forward_from'] ?? '',
            default               => []
        })['id'] ?? 0;
    }

    /**
     * @return string
     */
    public function inlineQuery(): string
    {
        $type = $this->updateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type},
            default                 => []
        })['query'] ?? '';
    }

    /**
     * @return int
     */
    public function inlineQueryId(): int
    {
        $type = $this->updateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type},
            default                 => []
        })['id'] ?? 0;
    }

    /**
     * @return int
     */
    public function inlineQueryFromId(): int
    {
        $type = $this->updateType;
        return (match ($type) {
            'inline_query',
            'chosen_inline_result'  => $this->{$type}['from'],
            default                 => []
        })['id'] ?? 0;
    }

    /**
     * @return string
     */
    public function replyToMessageText(): string
    {
        $type = $this->updateType;
        return (match ($type) {
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post' => $this->{$type}['reply_to_message'] ?? '',
            'callback_query'      => $this->{$type}['message']['reply_to_message'] ?? '',
            default               => []
        })['text'] ?? '';
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
        return (match ($type) {
            'callback_query'      => $this->{$type},
            default               => []
        })['id'] ?? '';
    }

    /**
     * @return mixed
     */
    public function callBackData(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'callback_query'      => $this->{$type},
            default               => []
        })['data'] ?? NULL;
    }

    /**
     * @return mixed
     */
    public function callBackMessage(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'callback_query'      => $this->{$type},
            default               => []
        })['message'] ?? '';
    }

    /**
     * @return mixed
     */
    public function callBackChatID(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'callback_query'      => $this->{$type}['message']['chat'],
            default               => []
        })['id'] ?? '';
    }

    /**
     * @return mixed
     */
    public function title(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'chat_member'         => $this->{$type}['chat'],
            default               => []
        })['title'] ?? NULL;
    }

    /**
     * @return mixed
     */
    public function chatMember(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'chat_member'         => $this->{$type},
            default               => []
        })['chat_member'] ?? NULL;
    }

    /**
     * @return mixed
     */
    public function newChatMember(): mixed
    {
        $type = $this->updateType;
        return (match ($type) {
            'chat_member'         => $this->{$type},
            default               => []
        })['new_chat_member'] ?? NULL;
    }

    /**
     * @return mixed
     */
    public function webAppData(): mixed
    {
        $type = $this->updateType;
        return htmlspecialchars((match ($type) {
            'message'   => $this->{$type}['web_app_data'] ?? '',
            default     => []
        })['data'] ?? '', ENT_NOQUOTES);
    }

    /**
     * @return mixed
     */
    public function webAppDataButton(): mixed
    {
        $type = $this->updateType;
        return htmlspecialchars((match ($type) {
            'message'   => $this->{$type}['web_app_data'] ?? '',
            default     => []
        })['button_text'] ?? '', ENT_NOQUOTES);
    }
}