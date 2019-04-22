<?php

declare(strict_types=1);

namespace Spiechu\MediaInfo;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Spiechu\MediaInfo\Providers\VideoInfoProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $configPath = __DIR__ . '/../config/media-info.php';
        $this->publishes([$configPath => config_path('media-info.php')], 'config');
    }

    public function register()
    {
        $configPath = __DIR__ . '/../config/media-info.php';
        $this->mergeConfigFrom($configPath, 'media-info');
    }

    public function provides()
    {
        return [
            VideoInfoProvider::class,
        ];
    }
}
