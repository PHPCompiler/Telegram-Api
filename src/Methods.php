<?php

namespace PhpCompiler\Telegram;

use PhpCompiler\Telegram\Tools\Response;

class Methods extends Updates
{

    /**
     * @return Response
     */
    public function getWebhookInfo(): Response
    {
        return $this->apiRequest('getWebhookInfo');
    }

    /**
     * @return Response
     */
    public function getMe(): Response
    {
        return $this->apiRequest('getMe');
    }

    /**
     * @return Response
     */
    public function logOut(): Response
    {
        return $this->apiRequest('logOut');
    }

    /**
     * @return Response
     */
    public function close(): Response
    {
        return $this->apiRequest('close');
    }

    /**
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param array|null $allowed_updates
     * @return Response
     */
/*    public function getUpdates(
        ?int   $offset = NULL,
        ?int   $limit = NULL,
        ?int   $timeout = NULL,
        ?array $allowed_updates = NULL,
    ): Response {
        $data = array(
            'offset'          => $offset,
            'limit'           => $limit,
            'timeout'         => $timeout,
            'allowed_updates' => $allowed_updates ? json_encode($allowed_updates, 320): NULL,
        );

        return $this->apiRequest('getUpdates', $data);
    }*/

    /**
     * @param string $url
     * @param mixed|NULL $certificate
     * @param string|null $ip_address
     * @param int|null $max_connections
     * @param array|null $allowed_updates
     * @param bool|null $drop_pending_updates
     * @param string|null $secret_token
     * @return Response
     */
    public function setWebhook(
        string  $url,
        mixed   $certificate = NULL,
        ?string $ip_address = NULL,
        ?int    $max_connections = NULL,
        ?array  $allowed_updates = NULL,
        ?bool   $drop_pending_updates = NULL,
        ?string $secret_token = NULL,
    ): Response {
        $data = array(
            'url'                  => $url,
            'certificate'          => $certificate,
            'ip_address'           => $ip_address,
            'max_connections'      => $max_connections,
            'allowed_updates'      => $allowed_updates ? json_encode($allowed_updates, 320): NULL,
            'drop_pending_updates' => $drop_pending_updates,
            'secret_token'         => $secret_token,
        );

        return $this->apiRequest('setWebhook', $data);
    }

    /**
     * @param bool|null $drop_pending_updates
     * @return Response
     */
    public function deleteWebhook(
        ?bool $drop_pending_updates = NULL,
    ): Response {
        $data = array(
            'drop_pending_updates' => $drop_pending_updates,
        );

        return $this->apiRequest('deleteWebhook', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $text
     * @param string|null $parse_mode
     * @param array|null $entities
     * @param bool|null $disable_web_page_preview
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendMessage(
        int|string $chat_id,
        string     $text,
        ?string    $parse_mode = NULL,
        ?array     $entities = NULL,
        ?bool      $disable_web_page_preview = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'text'                        => $text,
            'parse_mode'                  => $parse_mode,
            'entities'                    => $entities ? json_encode($entities, 320): NULL,
            'disable_web_page_preview'    => $disable_web_page_preview,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $message_id
     * @return Response
     */
    public function forwardMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $message_id = NULL,
    ): Response {
        $data = array(
            'chat_id'              => $chat_id,
            'from_chat_id'         => $from_chat_id,
            'message_id'           => $message_id,
            'disable_notification' => $disable_notification,
            'protect_content'      => $protect_content
        );

        return $this->apiRequest('forwardMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int|string $from_chat_id
     * @param int $message_id
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function copyMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int        $message_id,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'from_chat_id'                => $from_chat_id,
            'message_id'                  => $message_id,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('copyMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $photo
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendPhoto(
        int|string $chat_id,
        mixed      $photo,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'photo'                       => $photo,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendPhoto', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $audio
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param int|null $duration
     * @param string|null $performer
     * @param string|null $title
     * @param mixed|NULL $thumb
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendAudio(
        int|string $chat_id,
        mixed      $audio,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?int       $duration = NULL,
        ?string    $performer = NULL,
        ?string    $title = NULL,
        mixed      $thumb = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'audio'                       => $audio,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'duration'                    => $duration,
            'performer'                   => $performer,
            'title'                       => $title,
            'thumb'                       => $thumb,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendAudio', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $document
     * @param mixed|NULL $thumb
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param bool|null $disable_content_type_detection
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendDocument(
        int|string $chat_id,
        mixed      $document,
        mixed      $thumb = NULL,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?bool      $disable_content_type_detection = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                        => $chat_id,
            'document'                       => $document,
            'thumb'                          => $thumb,
            'caption'                        => $caption,
            'parse_mode'                     => $parse_mode,
            'caption_entities'               => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'disable_content_type_detection' => $disable_content_type_detection,
            'disable_notification'           => $disable_notification,
            'protect_content'                => $protect_content,
            'reply_to_message_id'            => $reply_to_message_id,
            'allow_sending_without_reply'    => $allow_sending_without_reply,
            'reply_markup'                   => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendDocument', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $video
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param mixed|NULL $thumb
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param bool|null $supports_streaming
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendVideo(
        int|string $chat_id,
        mixed      $video,
        ?int       $duration = NULL,
        ?int       $width = NULL,
        ?int       $height = NULL,
        mixed      $thumb = NULL,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?bool      $supports_streaming = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'video'                       => $video,
            'duration'                    => $duration,
            'width'                       => $width,
            'height'                      => $height,
            'thumb'                       => $thumb,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'supports_streaming'          => $supports_streaming,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendVideo', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $animation
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param mixed|NULL $thumb
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendAnimation(
        int|string $chat_id,
        mixed      $animation,
        ?int       $duration = NULL,
        ?int       $width = NULL,
        ?int       $height = NULL,
        mixed      $thumb = NULL,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'animation'                   => $animation,
            'duration'                    => $duration,
            'width'                       => $width,
            'height'                      => $height,
            'thumb'                       => $thumb,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendAnimation', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $voice
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param int|null $duration
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendVoice(
        int|string $chat_id,
        mixed      $voice,
        ?string    $caption = NULL,
        ?string    $parse_mode = NULL,
        ?array     $caption_entities = NULL,
        ?int       $duration = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'voice'                       => $voice,
            'caption'                     => $caption,
            'parse_mode'                  => $parse_mode,
            'caption_entities'            => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'duration'                    => $duration,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendVoice', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $video_note
     * @param int|null $duration
     * @param int|null $length
     * @param mixed|NULL $thumb
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendVideoNote(
        int|string $chat_id,
        mixed      $video_note,
        ?int       $duration = NULL,
        ?int       $length = NULL,
        mixed      $thumb = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'video_note'                  => $video_note,
            'duration'                    => $duration,
            'length'                      => $length,
            'thumb'                       => $thumb,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendVideoNote', $data);
    }

    /**
     * @param int|string $chat_id
     * @param array $media
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @return Response
     */
    public function sendMediaGroup(
        int|string $chat_id,
        array      $media,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'media'                       => $media ? json_encode($media, 320): NULL,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
        );

        return $this->apiRequest('sendMediaGroup', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $latitude
     * @param mixed $longitude
     * @param mixed|NULL $horizontal_accuracy
     * @param int|null $live_period
     * @param int|null $heading
     * @param int|null $proximity_alert_radius
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendLocation(
        int|string $chat_id,
        mixed      $latitude,
        mixed      $longitude,
        mixed      $horizontal_accuracy = NULL,
        ?int       $live_period = NULL,
        ?int       $heading = NULL,
        ?int       $proximity_alert_radius = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'latitude'                    => $latitude,
            'longitude'                   => $longitude,
            'horizontal_accuracy'         => $horizontal_accuracy,
            'live_period'                 => $live_period,
            'heading'                     => $heading,
            'proximity_alert_radius'      => $proximity_alert_radius,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendLocation', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param mixed|NULL $latitude
     * @param mixed|NULL $longitude
     * @param mixed|NULL $horizontal_accuracy
     * @param int|null $heading
     * @param int|null $proximity_alert_radius
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function editMessageLiveLocation(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        mixed           $latitude = NULL,
        mixed           $longitude = NULL,
        mixed           $horizontal_accuracy = NULL,
        ?int            $heading = NULL,
        ?int            $proximity_alert_radius = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                => $chat_id,
            'message_id'             => $message_id,
            'inline_message_id'      => $inline_message_id,
            'latitude'               => $latitude,
            'longitude'              => $longitude,
            'horizontal_accuracy'    => $horizontal_accuracy,
            'heading'                => $heading,
            'proximity_alert_radius' => $proximity_alert_radius,
            'reply_markup'           => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('editMessageLiveLocation', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function stopMessageLiveLocation(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'           => $chat_id,
            'message_id'        => $message_id,
            'inline_message_id' => $inline_message_id,
            'reply_markup'      => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('stopMessageLiveLocation', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $latitude
     * @param mixed $longitude
     * @param string $title
     * @param string $address
     * @param string|null $foursquare_id
     * @param string|null $foursquare_type
     * @param string|null $google_place_id
     * @param string|null $google_place_type
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendVenue(
        int|string $chat_id,
        mixed      $latitude,
        mixed      $longitude,
        string     $title,
        string     $address,
        ?string    $foursquare_id = NULL,
        ?string    $foursquare_type = NULL,
        ?string    $google_place_id = NULL,
        ?string    $google_place_type = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'latitude'                    => $latitude,
            'longitude'                   => $longitude,
            'title'                       => $title,
            'address'                     => $address,
            'foursquare_id'               => $foursquare_id,
            'foursquare_type'             => $foursquare_type,
            'google_place_id'             => $google_place_id,
            'google_place_type'           => $google_place_type,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendVenue', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $phone_number
     * @param string $first_name
     * @param string|null $last_name
     * @param string|null $vcard
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendContact(
        int|string $chat_id,
        string     $phone_number,
        string     $first_name,
        ?string    $last_name = NULL,
        ?string    $vcard = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'phone_number'                => $phone_number,
            'first_name'                  => $first_name,
            'last_name'                   => $last_name,
            'vcard'                       => $vcard,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendContact', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $question
     * @param array $options
     * @param bool|null $is_anonymous
     * @param string|null $type
     * @param bool|null $allows_multiple_answers
     * @param int|null $correct_option_id
     * @param string|null $explanation
     * @param string|null $explanation_parse_mode
     * @param array|null $explanation_entities
     * @param int|null $open_period
     * @param int|null $close_date
     * @param bool|null $is_closed
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendPoll(
        int|string $chat_id,
        string     $question,
        array      $options,
        ?bool      $is_anonymous = NULL,
        ?string    $type = NULL,
        ?bool      $allows_multiple_answers = NULL,
        ?int       $correct_option_id = NULL,
        ?string    $explanation = NULL,
        ?string    $explanation_parse_mode = NULL,
        ?array     $explanation_entities = NULL,
        ?int       $open_period = NULL,
        ?int       $close_date = NULL,
        ?bool      $is_closed = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'question'                    => $question,
            'options'                     => $options ? json_encode($options, 320): NULL,
            'is_anonymous'                => $is_anonymous,
            'type'                        => $type,
            'allows_multiple_answers'     => $allows_multiple_answers,
            'correct_option_id'           => $correct_option_id,
            'explanation'                 => $explanation,
            'explanation_parse_mode'      => $explanation_parse_mode,
            'explanation_entities'        => $explanation_entities ? json_encode($explanation_entities, 320): NULL,
            'open_period'                 => $open_period,
            'close_date'                  => $close_date,
            'is_closed'                   => $is_closed,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendPoll', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string|null $emoji
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendDice(
        int|string $chat_id,
        ?string    $emoji = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'emoji'                       => $emoji,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendDice', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $action
     * @return Response
     */
    public function sendChatAction(
        int|string $chat_id,
        string     $action,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'action'  => $action,
        );

        return $this->apiRequest('sendChatAction', $data);
    }

    /**
     * @param int $user_id
     * @param int|null $offset
     * @param int|null $limit
     * @return Response
     */
    public function getUserProfilePhotos(
        int  $user_id,
        ?int $offset = NULL,
        ?int $limit = NULL,
    ): Response {
        $data = array(
            'user_id' => $user_id,
            'offset'  => $offset,
            'limit'   => $limit,
        );

        return $this->apiRequest('getUserProfilePhotos', $data);
    }

    /**
     * @param string $file_id
     * @return Response
     */
    public function getFile(
        string $file_id,
    ): Response {
        $data = array(
            'file_id' => $file_id,
        );

        return $this->apiRequest('getFile', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @param int|null $until_date
     * @param bool|null $revoke_messages
     * @return Response
     */
    public function banChatMember(
        int|string $chat_id,
        int        $user_id,
        ?int       $until_date = NULL,
        ?bool      $revoke_messages = NULL,
    ): Response {
        $data = array(
            'chat_id'         => $chat_id,
            'user_id'         => $user_id,
            'until_date'      => $until_date,
            'revoke_messages' => $revoke_messages,
        );

        return $this->apiRequest('banChatMember', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @param bool|null $only_if_banned
     * @return Response
     */
    public function unbanChatMember(
        int|string $chat_id,
        int        $user_id,
        ?bool      $only_if_banned = NULL,
    ): Response {
        $data = array(
            'chat_id'        => $chat_id,
            'user_id'        => $user_id,
            'only_if_banned' => $only_if_banned,
        );

        return $this->apiRequest('unbanChatMember', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @param mixed $permissions
     * @param int|null $until_date
     * @return Response
     */
    public function restrictChatMember(
        int|string $chat_id,
        int        $user_id,
        mixed      $permissions,
        ?int       $until_date = NULL,
    ): Response {
        $data = array(
            'chat_id'     => $chat_id,
            'user_id'     => $user_id,
            'permissions' => $permissions ? json_encode($permissions, 320): NULL,
            'until_date'  => $until_date,
        );

        return $this->apiRequest('restrictChatMember', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @param bool|null $is_anonymous
     * @param bool|null $can_manage_chat
     * @param bool|null $can_post_messages
     * @param bool|null $can_edit_messages
     * @param bool|null $can_delete_messages
     * @param bool|null $can_manage_video_chats
     * @param bool|null $can_restrict_members
     * @param bool|null $can_promote_members
     * @param bool|null $can_change_info
     * @param bool|null $can_invite_users
     * @param bool|null $can_pin_messages
     * @return Response
     */
    public function promoteChatMember(
        int|string $chat_id,
        int        $user_id,
        ?bool      $is_anonymous = NULL,
        ?bool      $can_manage_chat = NULL,
        ?bool      $can_post_messages = NULL,
        ?bool      $can_edit_messages = NULL,
        ?bool      $can_delete_messages = NULL,
        ?bool      $can_manage_video_chats = NULL,
        ?bool      $can_restrict_members = NULL,
        ?bool      $can_promote_members = NULL,
        ?bool      $can_change_info = NULL,
        ?bool      $can_invite_users = NULL,
        ?bool      $can_pin_messages = NULL,
    ): Response {
        $data = array(
            'chat_id'                => $chat_id,
            'user_id'                => $user_id,
            'is_anonymous'           => $is_anonymous,
            'can_manage_chat'        => $can_manage_chat,
            'can_post_messages'      => $can_post_messages,
            'can_edit_messages'      => $can_edit_messages,
            'can_delete_messages'    => $can_delete_messages,
            'can_manage_video_chats' => $can_manage_video_chats,
            'can_restrict_members'   => $can_restrict_members,
            'can_promote_members'    => $can_promote_members,
            'can_change_info'        => $can_change_info,
            'can_invite_users'       => $can_invite_users,
            'can_pin_messages'       => $can_pin_messages,
        );

        return $this->apiRequest('promoteChatMember', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @param string $custom_title
     * @return Response
     */
    public function setChatAdministratorCustomTitle(
        int|string $chat_id,
        int        $user_id,
        string     $custom_title,
    ): Response {
        $data = array(
            'chat_id'      => $chat_id,
            'user_id'      => $user_id,
            'custom_title' => $custom_title,
        );

        return $this->apiRequest('setChatAdministratorCustomTitle', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return Response
     */
    public function banChatSenderChat(
        int|string $chat_id,
        int        $sender_chat_id,
    ): Response {
        $data = array(
            'chat_id'        => $chat_id,
            'sender_chat_id' => $sender_chat_id,
        );

        return $this->apiRequest('banChatSenderChat', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $sender_chat_id
     * @return Response
     */
    public function unbanChatSenderChat(
        int|string $chat_id,
        int        $sender_chat_id,
    ): Response {
        $data = array(
            'chat_id'        => $chat_id,
            'sender_chat_id' => $sender_chat_id,
        );

        return $this->apiRequest('unbanChatSenderChat', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $permissions
     * @return Response
     */
    public function setChatPermissions(
        int|string $chat_id,
        mixed      $permissions,
    ): Response {
        $data = array(
            'chat_id'     => $chat_id,
            'permissions' => $permissions ? json_encode($permissions, 320): NULL,
        );

        return $this->apiRequest('setChatPermissions', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function exportChatInviteLink(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('exportChatInviteLink', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string|null $name
     * @param int|null $expire_date
     * @param int|null $member_limit
     * @param bool|null $creates_join_request
     * @return Response
     */
    public function createChatInviteLink(
        int|string $chat_id,
        ?string    $name = NULL,
        ?int       $expire_date = NULL,
        ?int       $member_limit = NULL,
        ?bool      $creates_join_request = NULL,
    ): Response {
        $data = array(
            'chat_id'              => $chat_id,
            'name'                 => $name,
            'expire_date'          => $expire_date,
            'member_limit'         => $member_limit,
            'creates_join_request' => $creates_join_request,
        );

        return $this->apiRequest('createChatInviteLink', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $invite_link
     * @param string|null $name
     * @param int|null $expire_date
     * @param int|null $member_limit
     * @param bool|null $creates_join_request
     * @return Response
     */
    public function editChatInviteLink(
        int|string $chat_id,
        string     $invite_link,
        ?string    $name = NULL,
        ?int       $expire_date = NULL,
        ?int       $member_limit = NULL,
        ?bool      $creates_join_request = NULL,
    ): Response {
        $data = array(
            'chat_id'              => $chat_id,
            'invite_link'          => $invite_link,
            'name'                 => $name,
            'expire_date'          => $expire_date,
            'member_limit'         => $member_limit,
            'creates_join_request' => $creates_join_request,
        );

        return $this->apiRequest('editChatInviteLink', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $invite_link
     * @return Response
     */
    public function revokeChatInviteLink(
        int|string $chat_id,
        string     $invite_link,
    ): Response {
        $data = array(
            'chat_id'     => $chat_id,
            'invite_link' => $invite_link,
        );

        return $this->apiRequest('revokeChatInviteLink', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @return Response
     */
    public function approveChatJoinRequest(
        int|string $chat_id,
        int        $user_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        );

        return $this->apiRequest('approveChatJoinRequest', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @return Response
     */
    public function declineChatJoinRequest(
        int|string $chat_id,
        int        $user_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        );

        return $this->apiRequest('declineChatJoinRequest', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $photo
     * @return Response
     */
    public function setChatPhoto(
        int|string $chat_id,
        mixed      $photo,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'photo'   => $photo,
        );

        return $this->apiRequest('setChatPhoto', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function deleteChatPhoto(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('deleteChatPhoto', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $title
     * @return Response
     */
    public function setChatTitle(
        int|string $chat_id,
        string     $title,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'title'   => $title,
        );

        return $this->apiRequest('setChatTitle', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string|null $description
     * @return Response
     */
    public function setChatDescription(
        int|string $chat_id,
        ?string    $description = NULL,
    ): Response {
        $data = array(
            'chat_id'     => $chat_id,
            'description' => $description,
        );

        return $this->apiRequest('setChatDescription', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $message_id
     * @param bool|null $disable_notification
     * @return Response
     */
    public function pinChatMessage(
        int|string $chat_id,
        int        $message_id,
        ?bool      $disable_notification = NULL,
    ): Response {
        $data = array(
            'chat_id'              => $chat_id,
            'message_id'           => $message_id,
            'disable_notification' => $disable_notification,
        );

        return $this->apiRequest('pinChatMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int|null $message_id
     * @return Response
     */
    public function unpinChatMessage(
        int|string $chat_id,
        ?int       $message_id = NULL,
    ): Response {
        $data = array(
            'chat_id'    => $chat_id,
            'message_id' => $message_id,
        );

        return $this->apiRequest('unpinChatMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function unpinAllChatMessages(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('unpinAllChatMessages', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function leaveChat(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('leaveChat', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function getChat(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('getChat', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function getChatAdministrators(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('getChatAdministrators', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function getChatMemberCount(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('getChatMemberCount', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $user_id
     * @return Response
     */
    public function getChatMember(
        int|string $chat_id,
        int        $user_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        );

        return $this->apiRequest('getChatMember', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $sticker_set_name
     * @return Response
     */
    public function setChatStickerSet(
        int|string $chat_id,
        string     $sticker_set_name,
    ): Response {
        $data = array(
            'chat_id'          => $chat_id,
            'sticker_set_name' => $sticker_set_name,
        );

        return $this->apiRequest('setChatStickerSet', $data);
    }

    /**
     * @param int|string $chat_id
     * @return Response
     */
    public function deleteChatStickerSet(
        int|string $chat_id,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('deleteChatStickerSet', $data);
    }

    /**
     * @param string $callback_query_id
     * @param string|null $text
     * @param bool|null $show_alert
     * @param string|null $url
     * @param int|null $cache_time
     * @return Response
     */
    public function answerCallbackQuery(
        string  $callback_query_id,
        ?string $text = NULL,
        ?bool   $show_alert = NULL,
        ?string $url = NULL,
        ?int    $cache_time = NULL,
    ): Response {
        $data = array(
            'callback_query_id' => $callback_query_id,
            'text'              => $text,
            'show_alert'        => $show_alert,
            'url'               => $url,
            'cache_time'        => $cache_time,
        );

        return $this->apiRequest('answerCallbackQuery', $data);
    }

    /**
     * @param array $commands
     * @param mixed|NULL $scope
     * @param string|null $language_code
     * @return Response
     */
    public function setMyCommands(
        array   $commands,
        mixed   $scope = NULL,
        ?string $language_code = NULL,
    ): Response {
        $data = array(
            'commands'      => $commands ? json_encode($commands, 320): NULL,
            'scope'         => $scope ? json_encode($scope, 320): NULL,
            'language_code' => $language_code,
        );

        return $this->apiRequest('setMyCommands', $data);
    }

    /**
     * @param mixed|NULL $scope
     * @param string|null $language_code
     * @return Response
     */
    public function deleteMyCommands(
        mixed   $scope = NULL,
        ?string $language_code = NULL,
    ): Response {
        $data = array(
            'scope'         => $scope ? json_encode($scope, 320): NULL,
            'language_code' => $language_code,
        );

        return $this->apiRequest('deleteMyCommands', $data);
    }

    /**
     * @param mixed|NULL $scope
     * @param string|null $language_code
     * @return Response
     */
    public function getMyCommands(
        mixed   $scope = NULL,
        ?string $language_code = NULL,
    ): Response {
        $data = array(
            'scope'         => $scope ? json_encode($scope, 320): NULL,
            'language_code' => $language_code,
        );

        return $this->apiRequest('getMyCommands', $data);
    }

    /**
     * @param int|null $chat_id
     * @param mixed|NULL $menu_button
     * @return Response
     */
    public function setChatMenuButton(
        ?int  $chat_id = NULL,
        mixed $menu_button = NULL,
    ): Response {
        $data = array(
            'chat_id'     => $chat_id,
            'menu_button' => $menu_button ? json_encode($menu_button, 320): NULL,
        );

        return $this->apiRequest('setChatMenuButton', $data);
    }

    /**
     * @param int|null $chat_id
     * @return Response
     */
    public function getChatMenuButton(
        ?int $chat_id = NULL,
    ): Response {
        $data = array(
            'chat_id' => $chat_id,
        );

        return $this->apiRequest('getChatMenuButton', $data);
    }

    /**
     * @param mixed|NULL $rights
     * @param bool|null $for_channels
     * @return Response
     */
    public function setMyDefaultAdministratorRights(
        mixed $rights = NULL,
        ?bool $for_channels = NULL,
    ): Response {
        $data = array(
            'rights'       => $rights ? json_encode($rights, 320): NULL,
            'for_channels' => $for_channels,
        );

        return $this->apiRequest('setMyDefaultAdministratorRights', $data);
    }

    /**
     * @param bool|null $for_channels
     * @return Response
     */
    public function getMyDefaultAdministratorRights(
        ?bool $for_channels = NULL,
    ): Response {
        $data = array(
            'for_channels' => $for_channels,
        );

        return $this->apiRequest('getMyDefaultAdministratorRights', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param string|null $text
     * @param string|null $parse_mode
     * @param array|null $entities
     * @param bool|null $disable_web_page_preview
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function editMessageText(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        ?string         $text = NULL,
        ?string         $parse_mode = NULL,
        ?array          $entities = NULL,
        ?bool           $disable_web_page_preview = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                  => $chat_id,
            'message_id'               => $message_id,
            'inline_message_id'        => $inline_message_id,
            'text'                     => $text,
            'parse_mode'               => $parse_mode,
            'entities'                 => $entities ? json_encode($entities, 320): NULL,
            'disable_web_page_preview' => $disable_web_page_preview,
            'reply_markup'             => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('editMessageText', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param string|null $caption
     * @param string|null $parse_mode
     * @param array|null $caption_entities
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function editMessageCaption(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        ?string         $caption = NULL,
        ?string         $parse_mode = NULL,
        ?array          $caption_entities = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'           => $chat_id,
            'message_id'        => $message_id,
            'inline_message_id' => $inline_message_id,
            'caption'           => $caption,
            'parse_mode'        => $parse_mode,
            'caption_entities'  => $caption_entities ? json_encode($caption_entities, 320): NULL,
            'reply_markup'      => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('editMessageCaption', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param mixed|NULL $media
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function editMessageMedia(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        mixed           $media = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'           => $chat_id,
            'message_id'        => $message_id,
            'inline_message_id' => $inline_message_id,
            'media'             => $media ? json_encode($media, 320): NULL,
            'reply_markup'      => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('editMessageMedia', $data);
    }

    /**
     * @param int|string|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function editMessageReplyMarkup(
        int|string|null $chat_id = NULL,
        ?int            $message_id = NULL,
        ?string         $inline_message_id = NULL,
        mixed           $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'           => $chat_id,
            'message_id'        => $message_id,
            'inline_message_id' => $inline_message_id,
            'reply_markup'      => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('editMessageReplyMarkup', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $message_id
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function stopPoll(
        int|string $chat_id,
        int        $message_id,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'      => $chat_id,
            'message_id'   => $message_id,
            'reply_markup' => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('stopPoll', $data);
    }

    /**
     * @param int|string $chat_id
     * @param int $message_id
     * @return Response
     */
    public function deleteMessage(
        int|string $chat_id,
        int        $message_id,
    ): Response {
        $data = array(
            'chat_id'    => $chat_id,
            'message_id' => $message_id,
        );

        return $this->apiRequest('deleteMessage', $data);
    }

    /**
     * @param int|string $chat_id
     * @param mixed $sticker
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendSticker(
        int|string $chat_id,
        mixed      $sticker,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'sticker'                     => $sticker,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendSticker', $data);
    }

    /**
     * @param string $name
     * @return Response
     */
    public function getStickerSet(
        string $name,
    ): Response {
        $data = array(
            'name' => $name,
        );

        return $this->apiRequest('getStickerSet', $data);
    }

    /**
     * @param array $custom_emoji_ids
     * @return Response
     */
    public function getCustomEmojiStickers(
        array $custom_emoji_ids,
    ): Response {
        $data = array(
            'custom_emoji_ids' => $custom_emoji_ids ? json_encode($custom_emoji_ids, 320): NULL,
        );

        return $this->apiRequest('getCustomEmojiStickers', $data);
    }

    /**
     * @param int $user_id
     * @param mixed $png_sticker
     * @return Response
     */
    public function uploadStickerFile(
        int   $user_id,
        mixed $png_sticker,
    ): Response {
        $data = array(
            'user_id'     => $user_id,
            'png_sticker' => $png_sticker,
        );

        return $this->apiRequest('uploadStickerFile', $data);
    }

    /**
     * @param int $user_id
     * @param string $name
     * @param string $title
     * @param mixed|NULL $png_sticker
     * @param mixed|NULL $tgs_sticker
     * @param mixed|NULL $webm_sticker
     * @param string|null $sticker_type
     * @param string|null $emojis
     * @param mixed|NULL $mask_position
     * @return Response
     */
    public function createNewStickerSet(
        int     $user_id,
        string  $name,
        string  $title,
        mixed   $png_sticker = NULL,
        mixed   $tgs_sticker = NULL,
        mixed   $webm_sticker = NULL,
        ?string $sticker_type = NULL,
        ?string $emojis = NULL,
        mixed   $mask_position = NULL,
    ): Response {
        $data = array(
            'user_id'       => $user_id,
            'name'          => $name,
            'title'         => $title,
            'png_sticker'   => $png_sticker,
            'tgs_sticker'   => $tgs_sticker,
            'webm_sticker'  => $webm_sticker,
            'sticker_type'  => $sticker_type,
            'emojis'        => $emojis,
            'mask_position' => $mask_position ? json_encode($mask_position, 320): NULL,
        );

        return $this->apiRequest('createNewStickerSet', $data);
    }

    /**
     * @param int $user_id
     * @param string $name
     * @param mixed|NULL $png_sticker
     * @param mixed|NULL $tgs_sticker
     * @param mixed|NULL $webm_sticker
     * @param string|null $emojis
     * @param mixed|NULL $mask_position
     * @return Response
     */
    public function addStickerToSet(
        int     $user_id,
        string  $name,
        mixed   $png_sticker = NULL,
        mixed   $tgs_sticker = NULL,
        mixed   $webm_sticker = NULL,
        ?string $emojis = NULL,
        mixed   $mask_position = NULL,
    ): Response {
        $data = array(
            'user_id'       => $user_id,
            'name'          => $name,
            'png_sticker'   => $png_sticker,
            'tgs_sticker'   => $tgs_sticker,
            'webm_sticker'  => $webm_sticker,
            'emojis'        => $emojis,
            'mask_position' => $mask_position ? json_encode($mask_position, 320): NULL,
        );

        return $this->apiRequest('addStickerToSet', $data);
    }

    /**
     * @param string $sticker
     * @param int $position
     * @return Response
     */
    public function setStickerPositionInSet(
        string $sticker,
        int    $position,
    ): Response {
        $data = array(
            'sticker'  => $sticker,
            'position' => $position,
        );

        return $this->apiRequest('setStickerPositionInSet', $data);
    }

    /**
     * @param string $sticker
     * @return Response
     */
    public function deleteStickerFromSet(
        string $sticker,
    ): Response {
        $data = array(
            'sticker' => $sticker,
        );

        return $this->apiRequest('deleteStickerFromSet', $data);
    }

    /**
     * @param string $name
     * @param int $user_id
     * @param mixed|NULL $thumb
     * @return Response
     */
    public function setStickerSetThumb(
        string $name,
        int    $user_id,
        mixed  $thumb = NULL,
    ): Response {
        $data = array(
            'name'    => $name,
            'user_id' => $user_id,
            'thumb'   => $thumb,
        );

        return $this->apiRequest('setStickerSetThumb', $data);
    }

    /**
     * @param string $inline_query_id
     * @param array $results
     * @param int|null $cache_time
     * @param bool|null $is_personal
     * @param string|null $next_offset
     * @param string|null $switch_pm_text
     * @param string|null $switch_pm_parameter
     * @return Response
     */
    public function answerInlineQuery(
        string  $inline_query_id,
        array   $results,
        ?int    $cache_time = NULL,
        ?bool   $is_personal = NULL,
        ?string $next_offset = NULL,
        ?string $switch_pm_text = NULL,
        ?string $switch_pm_parameter = NULL,
    ): Response {
        $data = array(
            'inline_query_id'     => $inline_query_id,
            'results'             => $results ? json_encode($results, 320): NULL,
            'cache_time'          => $cache_time,
            'is_personal'         => $is_personal,
            'next_offset'         => $next_offset,
            'switch_pm_text'      => $switch_pm_text,
            'switch_pm_parameter' => $switch_pm_parameter,
        );

        return $this->apiRequest('answerInlineQuery', $data);
    }

    /**
     * @param string $web_app_query_id
     * @param mixed $result
     * @return Response
     */
    public function answerWebAppQuery(
        string $web_app_query_id,
        mixed  $result,
    ): Response {
        $data = array(
            'web_app_query_id' => $web_app_query_id,
            'result'           => $result ? json_encode($result, 320): NULL,
        );

        return $this->apiRequest('answerWebAppQuery', $data);
    }

    /**
     * @param int|string $chat_id
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $provider_token
     * @param string $currency
     * @param array $prices
     * @param int|null $max_tip_amount
     * @param array|null $suggested_tip_amounts
     * @param string|null $start_parameter
     * @param string|null $provider_data
     * @param string|null $photo_url
     * @param int|null $photo_size
     * @param int|null $photo_width
     * @param int|null $photo_height
     * @param bool|null $need_name
     * @param bool|null $need_phone_number
     * @param bool|null $need_email
     * @param bool|null $need_shipping_address
     * @param bool|null $send_phone_number_to_provider
     * @param bool|null $send_email_to_provider
     * @param bool|null $is_flexible
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendInvoice(
        int|string $chat_id,
        string     $title,
        string     $description,
        string     $payload,
        string     $provider_token,
        string     $currency,
        array      $prices,
        ?int       $max_tip_amount = NULL,
        ?array     $suggested_tip_amounts = NULL,
        ?string    $start_parameter = NULL,
        ?string    $provider_data = NULL,
        ?string    $photo_url = NULL,
        ?int       $photo_size = NULL,
        ?int       $photo_width = NULL,
        ?int       $photo_height = NULL,
        ?bool      $need_name = NULL,
        ?bool      $need_phone_number = NULL,
        ?bool      $need_email = NULL,
        ?bool      $need_shipping_address = NULL,
        ?bool      $send_phone_number_to_provider = NULL,
        ?bool      $send_email_to_provider = NULL,
        ?bool      $is_flexible = NULL,
        ?bool      $disable_notification = NULL,
        ?bool      $protect_content = NULL,
        ?int       $reply_to_message_id = NULL,
        ?bool      $allow_sending_without_reply = NULL,
        mixed      $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                       => $chat_id,
            'title'                         => $title,
            'description'                   => $description,
            'payload'                       => $payload,
            'provider_token'                => $provider_token,
            'currency'                      => $currency,
            'prices'                        => $prices ? json_encode($prices, 320): NULL,
            'max_tip_amount'                => $max_tip_amount,
            'suggested_tip_amounts'         => $suggested_tip_amounts ? json_encode($suggested_tip_amounts, 320): NULL,
            'start_parameter'               => $start_parameter,
            'provider_data'                 => $provider_data ? json_encode($provider_data, 320): NULL,
            'photo_url'                     => $photo_url,
            'photo_size'                    => $photo_size,
            'photo_width'                   => $photo_width,
            'photo_height'                  => $photo_height,
            'need_name'                     => $need_name,
            'need_phone_number'             => $need_phone_number,
            'need_email'                    => $need_email,
            'need_shipping_address'         => $need_shipping_address,
            'send_phone_number_to_provider' => $send_phone_number_to_provider,
            'send_email_to_provider'        => $send_email_to_provider,
            'is_flexible'                   => $is_flexible,
            'disable_notification'          => $disable_notification,
            'protect_content'               => $protect_content,
            'reply_to_message_id'           => $reply_to_message_id,
            'allow_sending_without_reply'   => $allow_sending_without_reply,
            'reply_markup'                  => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendInvoice', $data);
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $provider_token
     * @param string $currency
     * @param array $prices
     * @param int|null $max_tip_amount
     * @param array|null $suggested_tip_amounts
     * @param string|null $provider_data
     * @param string|null $photo_url
     * @param int|null $photo_size
     * @param int|null $photo_width
     * @param int|null $photo_height
     * @param bool|null $need_name
     * @param bool|null $need_phone_number
     * @param bool|null $need_email
     * @param bool|null $need_shipping_address
     * @param bool|null $send_phone_number_to_provider
     * @param bool|null $send_email_to_provider
     * @param bool|null $is_flexible
     * @return Response
     */
    public function createInvoiceLink(
        string  $title,
        string  $description,
        string  $payload,
        string  $provider_token,
        string  $currency,
        array   $prices,
        ?int    $max_tip_amount = NULL,
        ?array  $suggested_tip_amounts = NULL,
        ?string $provider_data = NULL,
        ?string $photo_url = NULL,
        ?int    $photo_size = NULL,
        ?int    $photo_width = NULL,
        ?int    $photo_height = NULL,
        ?bool   $need_name = NULL,
        ?bool   $need_phone_number = NULL,
        ?bool   $need_email = NULL,
        ?bool   $need_shipping_address = NULL,
        ?bool   $send_phone_number_to_provider = NULL,
        ?bool   $send_email_to_provider = NULL,
        ?bool   $is_flexible = NULL,
    ): Response {
        $data = array(
            'title'                         => $title,
            'description'                   => $description,
            'payload'                       => $payload,
            'provider_token'                => $provider_token,
            'currency'                      => $currency,
            'prices'                        => $prices ? json_encode($prices, 320): NULL,
            'max_tip_amount'                => $max_tip_amount,
            'suggested_tip_amounts'         => $suggested_tip_amounts ? json_encode($suggested_tip_amounts, 320): NULL,
            'provider_data'                 => $provider_data ? json_encode($provider_data, 320): NULL,
            'photo_url'                     => $photo_url,
            'photo_size'                    => $photo_size,
            'photo_width'                   => $photo_width,
            'photo_height'                  => $photo_height,
            'need_name'                     => $need_name,
            'need_phone_number'             => $need_phone_number,
            'need_email'                    => $need_email,
            'need_shipping_address'         => $need_shipping_address,
            'send_phone_number_to_provider' => $send_phone_number_to_provider,
            'send_email_to_provider'        => $send_email_to_provider,
            'is_flexible'                   => $is_flexible,
        );

        return $this->apiRequest('createInvoiceLink', $data);
    }

    /**
     * @param string $shipping_query_id
     * @param bool $ok
     * @param array|null $shipping_options
     * @param string|null $error_message
     * @return Response
     */
    public function answerShippingQuery(
        string  $shipping_query_id,
        bool    $ok,
        ?array  $shipping_options = NULL,
        ?string $error_message = NULL,
    ): Response {
        $data = array(
            'shipping_query_id' => $shipping_query_id,
            'ok'                => $ok,
            'shipping_options'  => $shipping_options ? json_encode($shipping_options, 320): NULL,
            'error_message'     => $error_message,
        );

        return $this->apiRequest('answerShippingQuery', $data);
    }

    /**
     * @param string $pre_checkout_query_id
     * @param bool $ok
     * @param string|null $error_message
     * @return Response
     */
    public function answerPreCheckoutQuery(
        string  $pre_checkout_query_id,
        bool    $ok,
        ?string $error_message = NULL,
    ): Response {
        $data = array(
            'pre_checkout_query_id' => $pre_checkout_query_id,
            'ok'                    => $ok,
            'error_message'         => $error_message,
        );

        return $this->apiRequest('answerPreCheckoutQuery', $data);
    }

    /**
     * @param int $user_id
     * @param array $errors
     * @return Response
     */
    public function setPassportDataErrors(
        int   $user_id,
        array $errors,
    ): Response {
        $data = array(
            'user_id' => $user_id,
            'errors'  => $errors ? json_encode($errors, 320): NULL,
        );

        return $this->apiRequest('setPassportDataErrors', $data);
    }

    /**
     * @param int $chat_id
     * @param string $game_short_name
     * @param bool|null $disable_notification
     * @param bool|null $protect_content
     * @param int|null $reply_to_message_id
     * @param bool|null $allow_sending_without_reply
     * @param mixed|NULL $reply_markup
     * @return Response
     */
    public function sendGame(
        int    $chat_id,
        string $game_short_name,
        ?bool  $disable_notification = NULL,
        ?bool  $protect_content = NULL,
        ?int   $reply_to_message_id = NULL,
        ?bool  $allow_sending_without_reply = NULL,
        mixed  $reply_markup = NULL,
    ): Response {
        $data = array(
            'chat_id'                     => $chat_id,
            'game_short_name'             => $game_short_name,
            'disable_notification'        => $disable_notification,
            'protect_content'             => $protect_content,
            'reply_to_message_id'         => $reply_to_message_id,
            'allow_sending_without_reply' => $allow_sending_without_reply,
            'reply_markup'                => $reply_markup ? json_encode($reply_markup, 320): NULL,
        );

        return $this->apiRequest('sendGame', $data);
    }

    /**
     * @param int $user_id
     * @param int $score
     * @param bool|null $force
     * @param bool|null $disable_edit_message
     * @param int|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @return Response
     */
    public function setGameScore(
        int     $user_id,
        int     $score,
        ?bool   $force = NULL,
        ?bool   $disable_edit_message = NULL,
        ?int    $chat_id = NULL,
        ?int    $message_id = NULL,
        ?string $inline_message_id = NULL,
    ): Response {
        $data = array(
            'user_id'              => $user_id,
            'score'                => $score,
            'force'                => $force,
            'disable_edit_message' => $disable_edit_message,
            'chat_id'              => $chat_id,
            'message_id'           => $message_id,
            'inline_message_id'    => $inline_message_id,
        );

        return $this->apiRequest('setGameScore', $data);
    }

    /**
     * @param int $user_id
     * @param int|null $chat_id
     * @param int|null $message_id
     * @param string|null $inline_message_id
     * @return Response
     */
    public function getGameHighScores(
        int     $user_id,
        ?int    $chat_id = NULL,
        ?int    $message_id = NULL,
        ?string $inline_message_id = NULL,
    ): Response {
        $data = array(
            'user_id'           => $user_id,
            'chat_id'           => $chat_id,
            'message_id'        => $message_id,
            'inline_message_id' => $inline_message_id,
        );

        return $this->apiRequest('getGameHighScores', $data);
    }

    /**
     * @param $fromId
     * @param array $channels
     * @param array $roles
     * @return array|false
     */
    public function getNotJoined(
        $fromId,
        array $channels = [],
        array $roles = ['administrator', 'creator', 'member', 'restricted']
    ): array|false
    {
        if(empty($channels))
            return false;

        foreach ($channels as $channel){
            $status = $this->getChatMember(
                $channel['channel'],
                $fromId
            )->getResult()['status'] ?? NULL;
            if (!in_array($status, $roles)){
                $return[] = $channel;
            }
        }
        return empty($return) ? false : $return;
    }

}