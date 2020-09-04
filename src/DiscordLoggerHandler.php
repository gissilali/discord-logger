<?php


namespace Gissilali\DiscordLogger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class DiscordLoggerHandler extends AbstractProcessingHandler
{
    protected function write(array $record): void
    {
        $level = strtolower(Logger::getLevelName($record['level']));

        DiscordLogger::log($record['message'], $level)
            ->setEvent('log-event')
            ->setChannel('log-channel')
            ->setInterests(['log-interest'])
            ->send();
    }
}
