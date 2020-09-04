<?php

namespace Gissilali\DiscordLogger;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class DiscordLogger extends Facade
{
    protected string $message;
    protected string $level;
    protected string $channel;
    protected string $event;
    protected array $interests;

    protected static function getFacadeAccessor()
    {
        return 'discord-logger';
    }

    /**
     * Sets the log message.
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Sets the log level.
     *
     * @param  string $level
     * @return self
     */
    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public static function log(string $message, string $level): self
    {
        return app('discord-logger')
            ->setMessage($message)
            ->setLevel($level);
    }

    /**
     * Dispatch a log message.
     *
     * @return bool
     */
    public function send(): bool
    {
        $config = config('logging.channels.discord');
        $response = Http::post($config['url'], [
            'username' => $config['username'],
            'content' => $this->message,
            'avatar_url' => $config['avatar_url'],
        ]);
        
        return true;
    }
}
