<?php

declare(strict_types=1);

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{
    returnedArrayOfSticker, returnedFile, returnedMessage, returnedStickerSet,returned
};

trait Stickers
{

    /**
     * @return returnedMessage
     */

    /**
     * @return returnedFile
     */
    public function uploadStickerFile($user_id, $sticker, $sticker_format, array $options = []): returnedFile
    {

        $data = compact('user_id', 'sticker', 'sticker_format') + $options;

        return returnedFile::create($this->call('uploadStickerFile', $data));
    }

    /**
     * @return returned
     */
    public function createNewStickerSet($user_id, $name, $title, $stickers, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'title', 'stickers') + $options;

        return returned::create($this->call('createNewStickerSet', $data));
    }

    /**
     * @return returned
     */
    public function addStickerToSet($user_id, $name, $title, $sticker, array $options = []): returned
    {

        $data = compact('user_id', 'name', 'sticker') + $options;

        return returned::create($this->call('addStickerToSet', $data));
    }

}
