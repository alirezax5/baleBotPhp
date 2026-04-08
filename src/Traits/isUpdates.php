<?php


namespace baleBotPhp\Traits;


trait isUpdates
{

    public function isMessage(): bool
    {
        return $this->checkUpdateExists('message');
    }

    public function isEditedMessage(): bool
    {
        return $this->checkUpdateExists('edited_message');
    }


    public function isCallbackQuery(): bool
    {
        return $this->checkUpdateExists('callback_query');
    }

    public function isPreCheckoutQuery(): bool
    {
        return $this->checkUpdateExists('pre_checkout_query');
    }

    public function ispPurchasedPaidMedia(): bool
    {
        return $this->checkUpdateExists('purchased_paid_media');
    }

    public function isChatJoinRequest(): bool
    {
        return $this->checkUpdateExists('chat_join_request');
    }

    public function isMyChatMember(): bool
    {
        return $this->checkUpdateExists('my_chat_member');
    }

    public function isChatMember(): bool
    {
        return $this->checkUpdateExists('chat_member');
    }
}

