<?php

declare(strict_types=1);

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{
    SentGuestMessage, returnedArrayOfChatMember, returnedArrayOfSticker, returnedChat, returnedChatInviteLink, returnedChatMember, returnedForumTopic, returnedInt, returnedMessage, returnedSentGuestMessage, returnedString, returnedUserChatBoosts,returned
};

trait ChatAdministration
{

    /**
     * @return returned
     */

    /**
     * @return returned
     */
    public function answerCallbackQuery($callback_query_id, ?string $text = null, array $options = []): returned
    {

        $data = compact('callback_query_id') + $options;
        if ($text !== null) {
            $data['text'] = $text;
        }

        return returned::create($this->call('answerCallbackQuery', $data));
    }

    public function banChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('banChatMember', $data));
    }

    public function unbanChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('unbanChatMember', $data));
    }

    public function promoteChatMember($chat_id, $user_id, array $options = [])
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returned::create($this->call('promoteChatMember', $data));
    }

    public function setChatPhoto($chat_id, $photo, array $options = [])
    {

        $data = compact('chat_id', 'photo') + $options;

        return returned::create($this->call('setChatPhoto', $data));
    }

    public function deleteChatPhoto($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('deleteChatPhoto', $data));
    }

    public function setChatTitle($chat_id, $title, array $options = [])
    {

        $data = compact('chat_id', 'title') + $options;

        return returned::create($this->call('setChatTitle', $data));
    }

    public function setChatDescription($chat_id, $description, array $options = [])
    {

        $data = compact('chat_id', 'description') + $options;

        return returned::create($this->call('setChatDescription', $data));
    }

    public function pinChatMessage($chat_id, int $message_id, array $options = [])
    {

        $data = compact('chat_id', 'message_id') + $options;

        return returned::create($this->call('pinChatMessage', $data));
    }

    public function unpinChatMessage($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unpinChatMessage', $data));
    }

    public function unpinAllChatMessages($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('unpinAllChatMessages', $data));
    }

    public function leaveChat($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returned::create($this->call('leaveChat', $data));
    }

    public function getChat($chat_id): returnedChat
    {
        return returnedChat::create($this->call('getChat', compact('chat_id')));
    }

    /**
     * @return returnedArrayOfChatMember
     */
    public function getChatAdministrators($chat_id, array $options = []): returnedArrayOfChatMember
    {

        $data = compact('chat_id') + $options;

        return returnedArrayOfChatMember::create($this->call('getChatAdministrators', $data));
    }

    /**
     * @return returnedInt
     */
    public function getChatMemberCount($chat_id, array $options = []): returnedInt
    {

        $data = compact('chat_id') + $options;

        return returnedInt::create($this->call('getChatMemberCount', $data));
    }

    /**
     * @return returnedInt
     */
    public function getChatMembersCount($chat_id, array $options = []): returnedInt
    {

        return $this->getChatMemberCount($chat_id, $options);
    }

    /**
     * Get information about a member of a chat.
     * @return returnedChatMember
     */
    public function getChatMember($chat_id, $user_id, array $options = []): returnedChatMember
    {
        $data = compact('chat_id', 'user_id') + $options;

        return returnedChatMember::create($this->call('getChatMember', $data));
    }

    /**
     * @return returnedString
     */
    public function exportChatInviteLink($chat_id): returnedString
    {
        return returnedString::create($this->call('exportChatInviteLink', compact('chat_id')));
    }

    public function createChatInviteLink($chat_id, array $options = [])
    {

        $data = compact('chat_id') + $options;

        return returnedChatInviteLink::create($this->call('createChatInviteLink', $data));
    }

    public function revokeChatInviteLink($chat_id, $invite_link, array $options = [])
    {

        $data = compact('chat_id', 'invite_link') + $options;

        return returnedChatInviteLink::create($this->call('revokeChatInviteLink', $data));
    }

}
