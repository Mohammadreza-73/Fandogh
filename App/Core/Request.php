<?php

namespace App\Core;
class Request
{
    private array $reguest_data = [];

    public function __construct()
    {
        $this->reguest_data['method'] = strtolower($_SERVER['REQUEST_METHOD']);
        $this->reguest_data['agent']  = $_SERVER['HTTP_USER_AGENT'];
        $this->reguest_data['ip']     = $_SERVER['REMOTE_ADDR'];
        $this->reguest_data['uri']    = strtok($_SERVER['REQUEST_URI'], '?');
        $this->reguest_data['params'] = $_REQUEST;
    }

    /**
     * Return Request Parameters
     *
     * @return array
     */
    public function getRequestData(): array
    {
        return $this->reguest_data;
    }

    /**
     * Return every index of Property. include GET & POST parameters
     *
     * @param string $key
     * @param string $params_key GET & POST parameters
     * @return string
     */
    public function getRequestInput(string $key, string $params_key = null): string
    {
        if ( isset($params_key) )
            return $this->reguest_data['params'][$params_key] ?? null;

        return $this->reguest_data[$key] ?? null;
    }

    /**
     * check parameter is set
     *
     * @param string $key
     * @return boolean
     */
    public function isset(string $key): bool
    {
        return isset($this->reguest_data[$key]);
    }

    /**
     * Redirect to a route
     * 
     * NOTE: this is not for redirecting to url
     *
     * @param string $route
     * @return void
     */
    public function redirect(string $route): void
    {
        header('Location: ' . siteUrl($route));
        die();
    }

    /**
     * Get Inaccessible Property
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->getRequestInput('', $name);
    }
}