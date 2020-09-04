<?php

namespace Gissilali\DiscordLogger\Commands;

use Illuminate\Console\Command;

class DiscordLoggerCommand extends Command
{
    public $signature = 'discord-logger';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
