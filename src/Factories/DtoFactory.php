<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo\Factories;

use Spiechu\MediaInfo\Dto\MediaInfoDto;

class DtoFactory
{
    public function createFromString(string $data): MediaInfoDto
    {
        $splitted = explode("\n", $data);

        $output = [];

        foreach ($splitted as $line) {
            $exploded = explode(':', $line, 2);

            $param = trim($exploded[0]);
            if (!isset($output[$param])) {
                $output[$param] = [];
            }

            $output[$param][] = empty($exploded[1]) ? '' : trim($exploded[1]);
        }

        return new MediaInfoDto($output);
    }
}
