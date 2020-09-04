<?php

namespace Gissilali\DiscordLogger;

use Illuminate\Support\Facades\Facade;

class DiscordLoggerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'discord-logger';
    }
}
