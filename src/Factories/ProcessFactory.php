<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo\Factories;

use Symfony\Component\Process\Process;

class ProcessFactory
{
    /**
     * @param \SplFileInfo $file
     *
     * @return Process
     */
    public function createProcess(\SplFileInfo $file): Process
    {
        $tempDir = storage_path('tempdir' . DIRECTORY_SEPARATOR . 'media-info');
        if (!is_dir($tempDir) && !mkdir($tempDir, 0777, true)) {
            throw new \RuntimeException(sprintf('Unable to create temp dir at "%s"', $tempDir));
        }

        $pathToBinary = config('media-info.path-to-binary');
        $process = new Process(sprintf('%s %s --fullscan', $pathToBinary, $file->getRealPath()));

        $process->setWorkingDirectory($tempDir);
        $process->setTimeout(10);

        return $process;
    }
}
