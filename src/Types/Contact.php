<?php

namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;

/**
 * Class Contact
 * Represents a phone contact.
 *
 * @property string $phone_number Contact's phone number.
 * @property string $first_name Contact's first name.
 * @property string|null $last_name Optional. Contact's last name.
 * @property int|null $user_id Optional. Contact's user identifier in Telegram.
 */
class Contact extends BaseType
{
}
