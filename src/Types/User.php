<?php

namespace baleBotPhp\Types;

/**
 * Class User
 * This object represents a Telegram user or bot.
 *
 * @property int $id Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
 * @property bool $is_bot True, if this user is a bot.
 * @property string $first_name User's or bot's first name.
 * @property string|null $last_name Optional. User's or bot's last name.
 * @property string|null $username Optional. User's or bot's username.
 * @property string|null $language_code Optional. IETF language tag of the user's language.
 */
class User extends BaseType
{
}
