<?php

namespace App\Core\Components\Http;

/**
 * Request Class
 * @package App\Core\Components\Http\Request
 */
class Request
{
    private array $request_data = [];

    /**
     * Initialize `request_data` Property.
     *
     * @return void
     */
    public function __construct()
    {
        $this->request_data['method'] = strtolower($_SERVER['REQUEST_METHOD']);
        $this->request_data['agent']  = $_SERVER['HTTP_USER_AGENT'];
        $this->request_data['ip']     = $_SERVER['REMOTE_ADDR'];
        $this->request_data['uri']    = strtok($_SERVER['REQUEST_URI'], '?');
        $this->request_data['params'] = $_REQUEST;
    }

    /**
     * Return Request Parameters
     *
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->request_data;
    }

    /**
     * Return index of `request_data` Property.
     * include GET & POST parameters
     *
     * @param  string $key
     * @param  string $params_key GET & POST parameters
     * @return array|string|null
     */
    public function getRequestParams(string $key = 'params', string $params_key = null)
    {
        if (isset($params_key)) {
            return $this->request_data[$key][$params_key] ?? null;
        }

        return $this->request_data[$key] ?? null;
    }

    /**
     * Determind Parameters existance
     *
     * @param  string $key
     * @return boolean
     */
    public function isset(string $key = 'params', string $params_key = null): bool
    {
        if (isset($params_key)) {
            return $this->request_data[$key][$params_key] ?? false;
        }

        return isset($this->request_data[$key]);
    }

    /**
     * Redirect to a route
     *
     * NOTE: this is not for redirecting to url
     *
     * @param  string $route
     * @return void
     */
    public function redirect(string $route): void
    {
        header('Location: ' . app_url($route));
        die();
    }

    /**
     * Get Inaccessible Property
     *
     * @param  string $name
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->getRequestParams($key);
    }
}
