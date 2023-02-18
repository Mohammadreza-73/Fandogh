<?php

namespace App\Core\Components\Http;

/**
 * Url Class
 * @package App\Core\Components\Http
 */
class Url
{
    /**
     * @var array
     */
    private array $server;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function getScheme(): string
    {
        return isset($this->server['REQUEST_SCHEME'])
            ? $this->server['REQUEST_SCHEME']
            : strtolower(substr($this->server['SERVER_PROTOCOL'], 0, strpos($this->server['SERVER_PROTOCOL'], '/')));
    }

    public function base(): string
    {
        $base = sprintf('%s%s', $this->getScheme() . '://', $this->server['SERVER_NAME']);
        $port = $this->port();

        if (isset($port)) {
            $base = rtrim($base, '/');

            return "$base:$port";
        }

        return $base;
    }

    public function port(): string
    {
        return $this->server['SERVER_PORT'];
    }

    public function full(): string
    {
        return sprintf('%s%s', $this->base(), $this->server['REQUEST_URI'], '/');
    }

    public function parse()
    {
        return parse_url($this->full());
    }

    public function withoutQueries(): string
    {
        return sprintf('%s%s', $this->base(), rtrim($this->path(), '/'));
    }

    public function query(): array
    {
        parse_str($this->parse()['query'] ?? '', $array);

        return $array;
    }

    public function except(...$except): ?array
    {
        $array = [];
        foreach ($this->query() as $key => $value) {
            if (! in_array($key, $except, true)) {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    public function path(): string
    {
        return $this->parse()['path'];
    }

    public function pathWithTrim(string $char = '/'): string
    {
        return trim($this->path(), $char);
    }
}