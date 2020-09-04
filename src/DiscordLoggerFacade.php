<?php

namespace Gissilali\DiscordLogger;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gissilali\DiscordLogger\DiscordLogger
 */
class DiscordLoggerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'discord-logger';
    }
}
