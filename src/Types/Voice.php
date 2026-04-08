<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;

/**
 * Class Voice
 * Represents a voice note.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, consistent over time and across bots (not for downloading).
 */
class Voice extends BaseType
{
}