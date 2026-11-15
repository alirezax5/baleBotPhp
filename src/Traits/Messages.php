<?php

declare(strict_types=1);

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{
    returnedArrayOfMessageId, returnedMessage, returnedMessageId, returnedPoll,returned
};

trait Messages
{

    // ====================== Sending Messages ======================

    /**
     * @return returnedMessage
     */

    /**
     * @return returnedMessage
     */
    public function sendMessage(int|string $chat_id, string $text, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'text') + $options;
        return returnedMessage::create($this->call('sendMessage', $data));
    }

    /**
     * @return returnedMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessage::create($this->call('forwardMessage', $data));
    }

    /**
     * @return returnedMessageId
     */
    public function copyMessage($chat_id, $from_chat_id, int $message_id, array $options = []): returnedMessageId
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessageId::create($this->call('copyMessage', $data));
    }

    public function deleteMessage($chat_id, $message_id): returned
    {
        return returned::create($this->call('deleteMessage', compact('chat_id', 'message_id')));
    }

    public function sendChatAction($chat_id, $action, array $options = [])
    {
        $data = compact('chat_id', 'action') + $options;

        return returned::create($this->call('sendChatAction', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendPhoto($chat_id, $photo, array $options = [])
    {
        $data = compact('chat_id', 'photo') + $options;

        return returnedMessage::create($this->call('sendPhoto', $data));
    }

    public function sendAudio($chat_id, $audio, array $options = [])
    {
        $data = compact('chat_id', 'audio') + $options;

        return returnedMessage::create($this->call('sendAudio', $data));
    }

    public function sendDocument($chat_id, $document, array $options = [])
    {
        $data = compact('chat_id', 'document') + $options;

        return returnedMessage::create($this->call('sendDocument', $data));
    }

    public function sendVideo($chat_id, $video, array $options = [])
    {
        $data = compact('chat_id', 'video') + $options;

        return returnedMessage::create($this->call('sendVideo', $data));
    }

    public function sendAnimation($chat_id, $animation, array $options = [])
    {
        $data = compact('chat_id', 'animation') + $options;

        return returnedMessage::create($this->call('sendAnimation', $data));
    }

    public function sendVoice($chat_id, $voice, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'voice') + $options;

        return returnedMessage::create($this->call('sendVoice', $data));
    }

    /**
     * @return returnedMessage
     */
    public function sendMediaGroup($chat_id, array $media, array $options = [])
    {
        $data = compact('chat_id', 'media') + $options;

        return returnedMessage::create($this->call('sendMediaGroup', $data));
    }

    public function sendLocation($chat_id, float $latitude, float $longitude, array $options = [])
    {
        $data = compact('chat_id', 'latitude', 'longitude') + $options;

        return returnedMessage::create($this->call('sendLocation', $data));
    }

    public function sendContact($chat_id, string $phone_number, string $first_name, array $options = [])
    {
        $data = compact('chat_id', 'phone_number', 'first_name') + $options;

        return returnedMessage::create($this->call('sendContact', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageText($chat_id, $message_id, $text, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'text') + $options;

        return returnedMessage::create($this->call('editMessageText', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageCaption($chat_id, $message_id, $caption, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'caption') + $options;

        return returnedMessage::create($this->call('editMessageCaption', $data));
    }

    /**
     * @return returnedMessage
     */
    public function editMessageReplyMarkup($chat_id = null, $message_id = null, $reply_markup = null, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'message_id', 'reply_markup') + $options;

        return returnedMessage::create($this->call('editMessageReplyMarkup', $data));
    }

}
