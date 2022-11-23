<?php

namespace Src;

use Error;

/**
 * @property array-key $path
 * @property array-key $app
 */
class Settings
{
    private array $_settings;

    public function __construct(array $setting)
    {
        $this->_settings = $setting;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->_settings)) return $this->_settings[$key];

        throw new Error("Accessing a non-existent property");
    }

    public function getRootPath(): string
    {
        return $this->path["root"] ? "/" . $this->path["root"] : '';
    }

    public function getViewsPath(): string
    {
        return "/" . $this->path["views"] ?? '';
    }

    public function getDBSettings(): array
    {
        return $this->db ?? [];
    }

    public function getRoutePath(): string
    {
        return '/' . $this->path['routes'] ?? "";
    }

    public function getAuthClassname(): string
    {
        return $this->app["auth"] ?? "";
    }

    public function getIdentityClassName(): string
    {
        return $this->app["identity"] ?? "";
    }

    public function removeAppMiddleware(string $key): void{
        unset($this->_settings["app"]["routeAppMiddleware"][$key]);
    }

    public function getBasePath(): string
    {
        return $this->path['baseUrl'] ? '/' . $this->path['baseUrl'] : '';
    }
}