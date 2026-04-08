<?php


namespace baleBotPhp\Traits;


use baleBotPhp\Types\{returned,
    returnedMessage,
    returnedFile,
    returnedMessageId,
    returnedInt,
    returnedChatMember,
    returnedChatInviteLink,
    returnedString,
    returnedTransaction};

trait method
{

    /**
     * @return returnedMessage
     */
    public function getUpdates($offset = 0, int $limit = 10, $timeout = null)
    {
        return returnedMessage::create($this->bot('getUpdates', compact('offset', 'limit')));
    }
    /**
     * @return returned
     */
    public function setWebhook($url)
    {
        return returned::create($this->bot('setWebhook', compact('url')));
    }
    /**
     * @return returnedString
     */
    public function WebhookInfo($url)
    {
        return returnedString::create($this->bot('WebhookInfo', compact('url')));
    }

    /**
     * @return returned
     */
    public function deleteWebhook()
    {
        return returned::create($this->bot('deleteWebhook'));
    }

    /**
     * @return returnedWebhookInfo
     */
    public function getWebhookInfo()
    {
        return returnedWebhookInfo::create($this->bot('getWebhookInfo'));
    }

    /**
     * @return returnedUser
     */
    public function getMe()
    {
        return returnedUser::create($this->bot('getMe'));
    }

    /**
     * @return returnedMessage
     */
    public function sendMessage($chat_id, string $text, $reply_markup = null, ?int $reply_to_message_id = null)
    {
        return returnedMessage::create($this->bot('sendMessage', compact(
            'chat_id', 'text', 'reply_markup', 'reply_to_message_id',
        )));
    }

    /**
     * @return returnedMessage
     */
    public function forwardMessage($chat_id, $from_chat_id, int $message_id)
    {
        return returnedMessage::create($this->bot('forwardMessage', compact(
            'chat_id', 'from_chat_id', 'message_id'
        )));
    }

    /**
     * @return returnedMessageId
     */
    public function copyMessage($chat_id, $from_chat_id, int $message_id, $caption = null, $parse_mode = 'html', $reply_markup = null, bool $disable_notification = false, bool $protect_content = false, $reply_to_message_id = null, $allow_sending_without_reply = true)
    {
        return returnedMessageId::create($this->bot('copyMessage', compact('chat_id', 'from_chat_id', 'disable_notification', 'protect_content', 'message_id', 'reply_markup', 'caption', 'parse_mode', 'reply_to_message_id', 'allow_sending_without_reply')));
    }

    /**
     * @return returnedMessage
     */
    public function sendPhoto($chat_id, $photo, ?string $caption = null, $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendPhoto', compact(
            'chat_id', 'photo', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendAudio($chat_id, $audio, ?string $caption = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendAudio', compact(
            'chat_id', 'audio', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendDocument($chat_id, $document, ?string $caption = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendDocument', compact(
            'chat_id', 'document', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }


    /**
     * @return returnedMessage
     */
    public function sendVideo($chat_id, $video, ?string $caption = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVideo', compact(
            'chat_id', 'video', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendAnimation($chat_id, $animation, ?string $caption = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendAnimation', compact(
            'chat_id', 'animation', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendVoice($chat_id, $voice, ?string $caption = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendVoice', compact(
            'chat_id', 'voice', 'caption', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendMediaGroup($chat_id, $media, ?int $reply_to_message_id = null)
    {
        return returnedMessage::create($this->bot('sendMediaGroup', compact(
            'chat_id', 'media', 'reply_to_message_id'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendLocation($chat_id, float $latitude, float $longitude, ?float $horizontal_accuracy = null, ?int $reply_to_message_id = null, $reply_markup = null)
    {
        return returnedMessage::create($this->bot('sendLocation', compact(
            'chat_id', 'latitude', 'longitude', 'horizontal_accuracy', 'reply_to_message_id', 'reply_markup'
        )));
    }

    /**
     * @return returnedMessage
     */
    public function sendContact($chat_id, string $phone_number, string $first_name, ?string $last_name = null, ?int $reply_to_message_id = null, ?array $reply_markup = null)
    {
        return $this->bot('sendContact', compact('chat_id', 'phone_number', 'first_name', 'last_name', 'reply_to_message_id', 'reply_markup'));
    }

    public function sendChatAction($chat_id, $action): returned
    {
        return returned::create($this->bot('sendChatAction', compact('chat_id', 'action')));
    }


    public function getFile(string $file_id): returnedFile
    {
        return returnedFile::create($this->bot('getFile', compact('file_id')));
    }

    public function answerCallbackQuery($callback_query_id, string $text, bool $show_alert = false): returned
    {
        return returned::create($this->bot('answerCallbackQuery', compact('callback_query_id', 'text', 'show_alert')));
    }

    public function askReview(int $user_id, int $delay_seconds): returned
    {
        return returned::create($this->bot('askReview', compact('user_id', 'delay_seconds)')));
    }

    public function banChatMember($chat_id, $user_id): returned
    {
        return returned::create($this->bot('banChatMember', compact('chat_id', 'user_id')));
    }

    public function unbanChatMember($chat_id, $user_id, $only_if_banned = false): returned
    {
        return returned::create($this->bot('unbanChatMember', compact('chat_id', 'user_id', 'only_if_banned')));
    }

    public function promoteChatMember($chat_id, $user_id, $can_change_info = null, $can_post_messages = null, $can_edit_messages = null, $can_delete_messages = null, $can_manage_video_chats = null, $can_invite_users = null, $can_restrict_members = null): returned
    {
        return returned::create($this->bot('promoteChatMember', compact('chat_id', 'user_id', 'can_change_info', 'can_post_messages', 'can_edit_messages', 'can_delete_messages', 'can_manage_video_chats', 'can_invite_users', 'can_restrict_members')));
    }

    public function setChatPhoto($chat_id, $photo): returned
    {
        return returned::create($this->bot('setChatPhoto', compact('chat_id', 'photo')));
    }

    public function LeaveChat($chat_id): returned
    {
        return returned::create($this->bot('LeaveChat', compact('chat_id')));
    }

    public function getChat($chat_id): returnedChat
    {
        return returnedChat::create($this->bot('getChat', compact('chat_id')));
    }

    public function getChatAdministrators($chat_id): returnedChatMember
    {
        return returnedChatMember::create($this->bot('getChatAdministrators', compact('chat_id')));
    }

    public function getChatMembersCount($chat_id): returnedInt
    {
        return returnedInt::create($this->bot('getChatMembersCount', compact('chat_id')));
    }

    public function getChatMember($chat_id, int $user_id): returnedChatMember
    {
        return returnedChatMember::create($this->bot('getChatMember', compact('chat_id', 'user_id')));
    }

    public function pinChatMessage($chat_id, int $message_id): returned
    {
        return returned::create($this->bot('pinChatMessage', compact('chat_id', 'message_id')));
    }

    public function unPinChatMessage($chat_id, int $message_id): returned
    {
        return returned::create($this->bot('unPinChatMessage', compact('chat_id', 'message_id')));
    }

    public function unpinAllChatMessages($chat_id): returned
    {
        return returned::create($this->bot('unpinAllChatMessages', compact('chat_id')));
    }

    public function setChatTitle($chat_id, $title): returned
    {
        return returned::create($this->bot('setChatTitle', compact('chat_id', 'title')));
    }

    public function setChatDescription($chat_id, string $description): returned
    {
        return returned::create($this->bot('setChatDescription', compact('chat_id', 'description')));
    }

    public function deleteChatPhoto($chat_id): returned
    {
        return returned::create($this->bot('deleteChatPhoto', compact('chat_id')));
    }

    public function createChatInviteLink($chat_id): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('createChatInviteLink', compact('chat_id')));
    }

    public function revokeChatInviteLink($chat_id, $invite_link): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->bot('revokeChatInviteLink', compact('chat_id', 'invite_link')));
    }

    public function exportChatInviteLink($chat_id): returnedString
    {
        return returnedString::create($this->bot('exportChatInviteLink', compact('chat_id')));
    }

    public function editMessageText($chat_id, $message_id, $text, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageText', compact('chat_id', 'message_id', 'text', 'reply_markup')));
    }

    public function editMessageCaption($chat_id = null, $message_id = null, $caption = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageCaption', compact('chat_id', 'message_id', 'caption', 'reply_markup')));
    }

    public function editMessageReplyMarkup($chat_id = null, $message_id = null, $reply_markup = null): returnedMessage
    {
        return returnedMessage::create($this->bot('editMessageReplyMarkup', compact('chat_id', 'message_id', 'reply_markup')));
    }

    public function deleteMessage($chat_id, $message_id): returned
    {
        return returned::create($this->bot('deleteMessage', compact('chat_id', 'message_id')));
    }

    public function uploadStickerFile($user_id, $sticker): returnedFile
    {
        return returnedFile::create($this->bot('uploadStickerFile', compact('user_id', 'sticker')));
    }

    public function createNewStickerSet($user_id, $name, $title, $sticker): returned
    {
        return returned::create($this->bot('createNewStickerSet', compact('user_id', 'name', 'title', 'sticker')));
    }

    public function addStickerToSet($user_id, $name, $sticker): returned
    {
        return returned::create($this->bot('addStickerToSet', compact('user_id', 'name', 'sticker')));
    }

    public function sendInvoice($chat_id, $title, $description, $payload, $prices, $provider_token = '', $photo_url = null, $reply_to_message_id = null): returnedMessage
    {
        return returnedMessage::create($this->bot('sendInvoice', compact(
            'chat_id', 'title', 'description', 'payload', 'prices',
            'provider_token', 'photo_url', 'reply_to_message_id'
        )));
    }

    public function createInvoiceLink($title, $description, $payload, $prices, $provider_token = ''): returnedString
    {
        return returnedString::create($this->bot('createInvoiceLink', compact(
            'title', 'description', 'payload', 'prices',
            'provider_token'
        )));
    }

    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok, $error_message = ''): returned
    {
        return returned::create($this->bot('answerPreCheckoutQuery', compact(
            'pre_checkout_query_id', 'ok', 'error_message'
        )));
    }
    public function inquireTransaction($transaction_id): returnedTransaction
    {
        return returnedTransaction::create($this->bot('inquireTransaction', compact(
             'transaction_id'
        )));
    }

}