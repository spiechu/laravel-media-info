<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo\Test\Providers;

use Orchestra\Testbench\TestCase;
use Spiechu\MediaInfo\Facades\MediaInfo;
use Spiechu\MediaInfo\Providers\VideoInfoProvider;
use Spiechu\MediaInfo\ServiceProvider;

class VideoInfoProviderTest extends TestCase
{

    /**
     * @dataProvider durationProvider
     */
    public function testExtractedDuration(\SplFileInfo $video, \DateInterval $interval)
    {
        $provider = $this->app->get(VideoInfoProvider::class);

        $mediaInfoDto = $provider->getMediaInfoForFile($video);

        $duration = $mediaInfoDto->getDuration();

        self::assertSame(5, (int) $duration->format('%s'));
    }

    public function durationProvider()
    {
        return [
            [
                new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'test-video' . DIRECTORY_SEPARATOR . 'SampleVideo_1280x720_1mb.mp4'),
                \DateInterval::createFromDateString('5 seconds'),
            ],
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'MediaInfo' => MediaInfo::class,
        ];
    }
}

