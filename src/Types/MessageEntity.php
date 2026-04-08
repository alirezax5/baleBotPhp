<?php

namespace baleBotPhp\Types;

use baleBotPhp\Types\{BaseType, User};

/**
 * Class MessageEntity
 * Represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @property string $type Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag or #hashtag@chatusername), “cashtag” ($USD or $USD@chatusername), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “blockquote” (block quotation), “expandable_blockquote” (collapsed-by-default block quotation), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers).
 * @property int $offset Offset in UTF-16 code units to the start of the entity.
 * @property int $length Length of the entity in UTF-16 code units.
 */
class MessageEntity extends BaseType
{
}
