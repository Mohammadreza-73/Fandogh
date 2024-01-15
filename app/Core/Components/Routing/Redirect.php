<?php

namespace App\Core\Components\Routing;

/**
 * Request Class
 * @package App\Core\Components\Routing
 */
class Redirect
{
    /**
     * @var string $url
     */
    private ?string $url = null;

    /**
     * @var string $query
     */
    private ?string $query = null;

    /**
     * @var string $fragment
     */
    private ?string $fragment = null;

    /**
     * @var bool
     */
    private bool $is_required_header = true;

    private function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function withQuery(array $query): self
    {
        $this->query = http_build_query($query);

        return $this;
    }

    public function withFragment(string $fragment): self
    {
        $this->fragment = '#' . $fragment;

        return $this;
    }

    public function url(string $url): self
    {
        return $this->setUrl($url);
    }

    public function getUrl()
    {
        $this->is_required_header = false;

        if (!$this->fragment) {
            return $this->url . ($this->query ? "?$this->query" : null);
        }

        return $this->url . ($this->query ? "?$this->query" : null) . $this->fragment;
    }

    public function back()
    {
        return $this->setUrl($_SERVER['HTTP_REFERER']);
    }

    public function header()
    {
        if (!headers_sent()) {
            if (!$this->fragment) {
                return header('location:' . $this->url . ($this->query ? "?$this->query" : null));
            }

            return header('location:' . $this->url . ($this->query ? "?$this->query" : null) . $this->fragment);
        }

        return null;
    }
}
