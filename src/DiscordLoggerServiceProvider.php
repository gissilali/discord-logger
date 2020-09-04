<?php

namespace Gissilali\DiscordLogger;

use Illuminate\Support\ServiceProvider;

class DiscordLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/discord-logger.php', 'discord-logger');
        $this->app->bind('discord-logger', function () {
            return new DiscordLogger();
        });
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
