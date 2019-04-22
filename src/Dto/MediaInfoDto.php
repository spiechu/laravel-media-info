<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo\Dto;

class MediaInfoDto
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getDuration(): ?\DateInterval
    {
        if (!isset($this->data['Duration']) || !is_array($this->data['Duration'])) {
            return null;
        }

        foreach ($this->data['Duration'] as $duration) {
            if (ctype_digit($duration)) {
                return \DateInterval::createFromDateString(sprintf('%d seconds', $duration / 1000));
            }
        }

        return null;
    }
}
