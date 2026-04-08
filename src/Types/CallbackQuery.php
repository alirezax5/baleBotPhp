<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;
use baleBotPhp\Types\User;

/**
 * Class CallbackQuery
 * Represents an incoming callback query from an inline keyboard button.
 * The query can originate from either a bot message or an inline message.
 * Exactly one of data or game_short_name will be present.
 *
 * @property string $id Unique identifier for this query
 * @property User $from Sender of the query
 * @property Message $message Optional. Message sent by the bot with the callback button
 * @property string $data Optional. Data associated with the callback button
 */
class CallbackQuery extends BaseType
{
}
