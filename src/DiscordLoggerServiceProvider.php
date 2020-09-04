<?php

namespace Gissilali\DiscordLogger;

use Illuminate\Support\ServiceProvider;
use Gissilali\DiscordLogger\Commands\DiscordLoggerCommand;

class DiscordLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/discord-logger.php' => config_path('discord-logger.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/discord-logger'),
            ], 'views');

            $migrationFileName = 'create_discord_logger_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                DiscordLoggerCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'discord-logger');
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
