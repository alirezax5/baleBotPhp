<?php

declare(strict_types=1);

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{returnedFile};

trait Files
{

    /**
     * @return returned
     */

    public function getFile($file_id, array $options = [])
    {
        $data = compact('file_id') + $options;

        return returnedFile::create($this->call('getFile', $data));
    }

}
