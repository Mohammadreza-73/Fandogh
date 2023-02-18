<?php

namespace Tests\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use App\Core\Components\Http\Url;

class UrlTest extends TestCase
{
    private ?Url $url;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        $this->url = new Url();

        parent::setUp();
    }

    /**
     * @inheritDoc
     */
    public function tearDown(): void
    {
        $this->url = null;
        // unset($_SERVER['REQUEST_URI']);

        parent::tearDown();
    }

    public function test_it_get_url_scheme()
    {
        $this->mockRequest('GET', 'http://example.com/');
        $url = new Url();

        $this->assertEquals($url->getScheme(), $_SERVER['REQUEST_SCHEME']);
    }

    public function test_get_base_url()
    {
        $this->mockRequest('GET', 'http://example.com/dummy/');

        $this->assertEquals($this->url->base(), 'http://example.com:80');
    }

    public function test_get_port()
    {
        $this->mockRequest('GET', 'http://example.com/');

        $this->assertEquals($this->url->port(), $_SERVER['SERVER_PORT']);
    }

    public function test_get_full_url()
    {
        $this->mockRequest('GET', 'http://example.com/dummy?name=john');

        $this->assertEquals($this->url->full(), 'http://example.com:80/dummy?name=john');
    }

    public function test_get_url_without_queries()
    {
        $this->mockRequest('GET', 'http://example.com/dummy?name=john');

        $this->assertEquals($this->url->withoutQueries(), 'http://example.com:80/dummy');
    }

    public function test_get_url_queries()
    {
        $this->mockRequest('GET', 'http://example.com?name=john');

        $this->assertIsArray($this->url->query());
        $this->assertEquals($this->url->query(), ['name' => 'john']);
    }

    /**
     * Manipulate the current request ($_SERVER)
     *
     * @param  string  $method
     * @param  string  $url
     * @return void
     */
    protected function mockRequest(string $method, string $url): void
    {
        $url_parts = parse_url($url);

        $_SERVER['SERVER_NAME'] = $url_parts['host'];
        $_SERVER['REQUEST_URI'] = ($url_parts['path'] ?? '') . '?' . ($url_parts['query'] ?? '');
        $_SERVER['REQUEST_SCHEME'] = $url_parts['scheme'];
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $_SERVER['SERVER_PORT'] = $url_parts['port'] ?? 80;
    }

    protected function urlGenerator(string $url, int $port, $query = null, $fragment = null): string
    {
        $query = is_array($query) ? $query : [$query];
        $query_params = http_build_query($query);

        return $url . ':' . $port . $query_params ?? '' . $fragment ?? '';
    }
}