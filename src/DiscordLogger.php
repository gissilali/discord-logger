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

    /**
     * Sets the Pusher channel.
     *
     * @param  string $channel
     * @return self
     */
    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Sets the event name.
     *
     * @param  string $event
     * @return self
     */
    public function setEvent(string $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Set the interests for Push notifications.
     *
     * @param  array $interests
     * @return self
     */
    public function setInterests(array $interests): self
    {
        $this->interests = $interests;

        return $this;
    }

    public static function log(string $message, string $level): self
    {
        return app('pusher-logger')
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
        $response = Http::post(config('discord-logger.webhook_url'), [
            'username' => 'Discord Logger',
            'content' => $this->message,
            'avatar_url' => 'https://appslab.co.ke/img/icons/apple-touch-icon-57x57.png'
        ]);
        return true;
    }
}
