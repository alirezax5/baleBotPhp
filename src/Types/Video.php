<?php

namespace baleBotPhp\Types;

use baleBotPhp\{Types\BaseType};

/**
 * Class Video
 * Represents a video file.
 *
 * @property string $file_id Identifier for this file, which can be used to download or reuse the file.
 * @property string $file_unique_id Unique identifier for this file, consistent over time and across bots (not for downloading).
 * @property int $width Video width as defined by the sender.
 * @property int $height Video height as defined by the sender.
 * @property int $duration Duration of the video in seconds as defined by the sender.
 * @property string|null $file_name Optional. Original filename as defined by the sender.
 * @property string|null $mime_type Optional. MIME type of the file as defined by the sender.
 * @property int|null $file_size Optional. File size in bytes.
 */
class Video extends BaseType
{
}
