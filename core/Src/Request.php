<?php

namespace Src;

use http\Message\Body;

class Request
{
    protected array $body;
    public string $method;
    public array $headers;

    public function __construct(){
        $this->body = $this->clearBody();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders() ?? [];
    }

    public function all(): array{
        return $this->body + $this->files();
    }

    public function set($field, $value): void{
        $this->body[$field] = $value;
    }

    public function get($field){
        return $this->body[$field];
    }

    public function files(): array {
        return $_FILES;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->body))
            return $this->body[$key];

        throw new \Error("Accessing a non-existent property");
    }

    private function clearBody(): array{
        if (array_key_exists("route", $_REQUEST))
            unset($_REQUEST["route"]);

        if (array_key_exists("PHPSESSID", $_REQUEST))
            unset($_REQUEST["PHPSESSID"]);

        return $_REQUEST;
    }
}