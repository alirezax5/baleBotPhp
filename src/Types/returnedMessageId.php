<?php


namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;
use baleBotPhp\Types\MessageId;

/**
 * Class returned
 * @package baleBotPhp\Types
 * @property bool $ok status
 * @property int $error_code
 * @property string $description
 * @property MessageId $result
 */
class returnedMessageId extends BaseType
{

}