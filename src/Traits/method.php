<?php

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{
    returned,
    returnedMessage,
    returnedFile,
    returnedMessageId,
    returnedInt,
    returnedChatMember,
    returnedChatInviteLink,
    returnedString,
    returnedTransaction,
    returnedWebhookInfo,
    returnedUser,
    returnedChat
};

trait method
{
    /**
     * آماده‌سازی داده‌ها برای ارسال به API
     */
    private function prepareBotData(array $data): array
    {
        // آماده‌سازی reply_markup
        if (isset($data['reply_markup']) && is_array($data['reply_markup'])) {
            $data['reply_markup'] = json_encode(
                $data['reply_markup'],
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );
        }

        // آماده‌سازی رسانه‌ها برای آپلود
        $data = $this->prepareMediaForUpload($data);

        return $data;
    }

    /**
     * تبدیل خودکار مسیر فایل‌های محلی به CURLFile
     */
    private function prepareMediaForUpload(array $data): array
    {
        $fileFields = [
            'photo', 'video', 'audio', 'voice', 'animation', 'document',
            'sticker', 'video_note', 'thumbnail', 'certificate'
        ];

        foreach ($fileFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = $this->prepareFileInput($data[$field]);
            }
        }

        // پشتیبانی از sendMediaGroup (media به صورت آرایه جیسون)
        if (isset($data['media']) && is_array($data['media'])) {
            $data['media'] = $this->prepareMediaGroup($data['media']);
        }

        // پشتیبانی از media در editMessageMedia و غیره
        if (isset($data['media']) && is_array($data['media']) && isset($data['media']['media'])) {
            $data['media']['media'] = $this->prepareFileInput($data['media']['media']);
        }

        return $data;
    }

    /**
     * آماده‌سازی تک فایل
     */
    private function prepareFileInput($input)
    {
        // اگر قبلاً CURLFile باشد
        if ($input instanceof \CURLFile) {
            return $input;
        }

        // اگر مسیر فایل محلی معتبر باشد
        if (is_string($input) && file_exists($input) && is_readable($input)) {
            return new \CURLFile($input);
        }

        // اگر URL یا file_id باشد، همان را برگردان
        if (is_string($input)) {
            return $input;
        }

        // در غیر این صورت همان را برگردان (ممکن است resource یا چیز دیگر باشد)
        return $input;
    }

    /**
     * آماده‌سازی آرایه media برای sendMediaGroup
     */
    private function prepareMediaGroup(array $mediaItems): string
    {
        foreach ($mediaItems as &$item) {
            if (is_array($item) && isset($item['media'])) {
                $item['media'] = $this->prepareFileInput($item['media']);
            }
        }

        return json_encode($mediaItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * متد پایه فراخوانی API
     */
    private function call(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $data = $this->prepareBotData($data);
        return $this->bot($method, $data, $isUpload);
    }

    // ====================== Updates & Webhook ======================

    public function getUpdates(int $offset = 0, int $limit = 10, ?int $timeout = null, ?array $allowed_updates = null): returnedMessage
    {
        return returnedMessage::create($this->call('getUpdates', compact('offset', 'limit', 'timeout', 'allowed_updates')));
    }

    public function setWebhook(string $url, array $options = []): returned
    {
        $data = ['url' => $url] + $options;
        return returned::create($this->call('setWebhook', $data));
    }

    public function deleteWebhook(): returned
    {
        return returned::create($this->call('deleteWebhook'));
    }

    public function getWebhookInfo(): returnedWebhookInfo
    {
        return returnedWebhookInfo::create($this->call('getWebhookInfo'));
    }

    public function getMe(): returnedUser
    {
        return returnedUser::create($this->call('getMe'));
    }

    // ====================== Sending Messages ======================

    public function sendMessage(int|string $chat_id, string $text, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'text') + $options;
        return returnedMessage::create($this->call('sendMessage', $data));
    }

    public function forwardMessage(int|string $chat_id, int|string $from_chat_id, int $message_id, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessage::create($this->call('forwardMessage', $data));
    }

    public function copyMessage(int|string $chat_id, int|string $from_chat_id, int $message_id, array $options = []): returnedMessageId
    {
        $data = compact('chat_id', 'from_chat_id', 'message_id') + $options;
        return returnedMessageId::create($this->call('copyMessage', $data));
    }

    public function sendPhoto(int|string $chat_id, $photo, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'photo', 'caption') + $options;
        return returnedMessage::create($this->call('sendPhoto', $data, true));
    }

    public function sendAudio(int|string $chat_id, $audio, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'audio', 'caption') + $options;
        return returnedMessage::create($this->call('sendAudio', $data, true));
    }

    public function sendDocument(int|string $chat_id, $document, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'document', 'caption') + $options;
        return returnedMessage::create($this->call('sendDocument', $data, true));
    }

    public function sendVideo(int|string $chat_id, $video, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'video', 'caption') + $options;
        return returnedMessage::create($this->call('sendVideo', $data, true));
    }

    public function sendAnimation(int|string $chat_id, $animation, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'animation', 'caption') + $options;
        return returnedMessage::create($this->call('sendAnimation', $data, true));
    }

    public function sendVoice(int|string $chat_id, $voice, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'voice', 'caption') + $options;
        return returnedMessage::create($this->call('sendVoice', $data, true));
    }

    public function sendMediaGroup(int|string $chat_id, array $media, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'media') + $options;
        return returnedMessage::create($this->call('sendMediaGroup', $data, true));
    }

    public function sendLocation(int|string $chat_id, float $latitude, float $longitude, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'latitude', 'longitude') + $options;
        return returnedMessage::create($this->call('sendLocation', $data));
    }

    public function sendContact(int|string $chat_id, string $phone_number, string $first_name, ?string $last_name = null, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'phone_number', 'first_name', 'last_name') + $options;
        return returnedMessage::create($this->call('sendContact', $data));
    }

    public function sendChatAction(int|string $chat_id, string $action): returned
    {
        return returned::create($this->call('sendChatAction', compact('chat_id', 'action')));
    }

    // ====================== Files ======================

    public function getFile(string $file_id): returnedFile
    {
        return returnedFile::create($this->call('getFile', compact('file_id')));
    }

    // ====================== Callback & Payments ======================

    public function answerCallbackQuery(string $callback_query_id, string $text = '', bool $show_alert = false, array $options = []): returned
    {
        $data = compact('callback_query_id', 'text', 'show_alert') + $options;
        return returned::create($this->call('answerCallbackQuery', $data));
    }

    public function askReview(int $user_id, int $delay_seconds): returned
    {
        return returned::create($this->call('askReview', compact('user_id', 'delay_seconds')));
    }

    // ====================== Chat Management ======================

    public function banChatMember(int|string $chat_id, int $user_id, array $options = []): returned
    {
        $data = compact('chat_id', 'user_id') + $options;
        return returned::create($this->call('banChatMember', $data));
    }

    public function unbanChatMember(int|string $chat_id, int $user_id, bool $only_if_banned = false, array $options = []): returned
    {
        $data = compact('chat_id', 'user_id', 'only_if_banned') + $options;
        return returned::create($this->call('unbanChatMember', $data));
    }

    public function promoteChatMember(int|string $chat_id, int $user_id, array $options = []): returned
    {
        $data = compact('chat_id', 'user_id') + $options;
        return returned::create($this->call('promoteChatMember', $data));
    }

    public function setChatPhoto(int|string $chat_id, $photo): returned
    {
        return returned::create($this->call('setChatPhoto', compact('chat_id', 'photo'), true));
    }

    public function leaveChat(int|string $chat_id): returned
    {
        return returned::create($this->call('leaveChat', compact('chat_id')));
    }

    public function getChat(int|string $chat_id): returnedChat
    {
        return returnedChat::create($this->call('getChat', compact('chat_id')));
    }

    public function getChatAdministrators(int|string $chat_id): returnedChatMember
    {
        return returnedChatMember::create($this->call('getChatAdministrators', compact('chat_id')));
    }

    public function getChatMemberCount(int|string $chat_id): returnedInt
    {
        return returnedInt::create($this->call('getChatMemberCount', compact('chat_id')));
    }

    public function getChatMember(int|string $chat_id, int $user_id): returnedChatMember
    {
        return returnedChatMember::create($this->call('getChatMember', compact('chat_id', 'user_id')));
    }

    public function pinChatMessage(int|string $chat_id, int $message_id, array $options = []): returned
    {
        $data = compact('chat_id', 'message_id') + $options;
        return returned::create($this->call('pinChatMessage', $data));
    }

    public function unpinChatMessage(int|string $chat_id, ?int $message_id = null, array $options = []): returned
    {
        $data = compact('chat_id', 'message_id') + $options;
        return returned::create($this->call('unpinChatMessage', $data));
    }

    public function unpinAllChatMessages(int|string $chat_id): returned
    {
        return returned::create($this->call('unpinAllChatMessages', compact('chat_id')));
    }

    public function setChatTitle(int|string $chat_id, string $title): returned
    {
        return returned::create($this->call('setChatTitle', compact('chat_id', 'title')));
    }

    public function setChatDescription(int|string $chat_id, string $description): returned
    {
        return returned::create($this->call('setChatDescription', compact('chat_id', 'description')));
    }

    public function deleteChatPhoto(int|string $chat_id): returned
    {
        return returned::create($this->call('deleteChatPhoto', compact('chat_id')));
    }

    // ====================== Invite Links & Editing ======================

    public function createChatInviteLink(int|string $chat_id, array $options = []): returnedChatInviteLink
    {
        $data = compact('chat_id') + $options;
        return returnedChatInviteLink::create($this->call('createChatInviteLink', $data));
    }

    public function revokeChatInviteLink(int|string $chat_id, string $invite_link): returnedChatInviteLink
    {
        return returnedChatInviteLink::create($this->call('revokeChatInviteLink', compact('chat_id', 'invite_link')));
    }

    public function exportChatInviteLink(int|string $chat_id): returnedString
    {
        return returnedString::create($this->call('exportChatInviteLink', compact('chat_id')));
    }

    public function editMessageText(int|string $chat_id, int $message_id, string $text, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'message_id', 'text') + $options;
        return returnedMessage::create($this->call('editMessageText', $data));
    }

    public function editMessageCaption( $chat_id = null, ?int $message_id = null, ?string $caption = null, array $options = []): returnedMessage
    {
        $data = array_filter(compact('chat_id', 'message_id', 'caption')) + $options;
        return returnedMessage::create($this->call('editMessageCaption', $data));
    }

    public function editMessageReplyMarkup( $chat_id = null, ?int $message_id = null, ?array $reply_markup = null): returnedMessage
    {
        $data = array_filter(compact('chat_id', 'message_id', 'reply_markup'));
        return returnedMessage::create($this->call('editMessageReplyMarkup', $data));
    }

    public function deleteMessage(int|string $chat_id, int $message_id): returned
    {
        return returned::create($this->call('deleteMessage', compact('chat_id', 'message_id')));
    }

    // ====================== Stickers ======================

    public function uploadStickerFile(int $user_id, $sticker): returnedFile
    {
        return returnedFile::create($this->call('uploadStickerFile', compact('user_id', 'sticker'), true));
    }

    // ====================== Payments ======================

    public function sendInvoice(int|string $chat_id, string $title, string $description, string $payload, array $prices, array $options = []): returnedMessage
    {
        $data = compact('chat_id', 'title', 'description', 'payload', 'prices') + $options;
        return returnedMessage::create($this->call('sendInvoice', $data));
    }

    public function createInvoiceLink(string $title, string $description, string $payload, array $prices, array $options = []): returnedString
    {
        $data = compact('title', 'description', 'payload', 'prices') + $options;
        return returnedString::create($this->call('createInvoiceLink', $data));
    }

    public function answerPreCheckoutQuery(string $pre_checkout_query_id, bool $ok, ?string $error_message = null): returned
    {
        return returned::create($this->call('answerPreCheckoutQuery', compact('pre_checkout_query_id', 'ok', 'error_message')));
    }

    public function inquireTransaction(string $transaction_id): returnedTransaction
    {
        return returnedTransaction::create($this->call('inquireTransaction', compact('transaction_id')));
    }
}