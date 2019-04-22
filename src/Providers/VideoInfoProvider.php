<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo\Providers;

use Spiechu\MediaInfo\Dto\MediaInfoDto;
use Spiechu\MediaInfo\Factories\DtoFactory;
use Spiechu\MediaInfo\Factories\ProcessFactory;

class VideoInfoProvider
{
    /**
     * @var ProcessFactory
     */
    private $processFactory;

    /**
     * @var DtoFactory
     */
    private $dtoFactory;

    public function __construct(ProcessFactory $processFactory, DtoFactory $dtoFactory)
    {
        $this->processFactory = $processFactory;
        $this->dtoFactory = $dtoFactory;
    }

    public function getMediaInfoForFile(\SplFileInfo $fileInfo): MediaInfoDto
    {
        $process = $this->processFactory->createProcess($fileInfo);

        $process->run();

        return $this->dtoFactory->createFromString($process->getOutput());
    }
}
