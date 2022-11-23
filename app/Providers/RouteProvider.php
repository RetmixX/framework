<?php

namespace Providers;

use Src\Provider\AbstractProvider;
use Src\Route;

class RouteProvider extends AbstractProvider
{

    function register(): void
    {
        // TODO: Implement register() method.
    }

    function boot(): void
    {
        $this->app->bind('route', Route::single()->setPrefix($this->app->settings->getBasePath()));

        if ($this->checkPrefix('/api')){
            $this->app->settings->removeAppMiddleware('csrf');
            $this->app->settings->removeAppMiddleware('specialChars');

            Route::group('/api', function (){
                require_once __DIR__."/../..".$this->app->settings->getRoutePath().'/api.php';
            });

            return;
        }

        $this->app->settings->removeAppMiddleware('json');
        require_once __DIR__."/../..".$this->app->settings->getRoutePath().'/web.php';
    }

    private function getUti(): string{
        return substr($_SERVER["REQUEST_URI"], strlen($this->app->settings->getBasePath()));
    }

    private function checkPrefix(string $prefix): bool{
        $uri = $this->getUti();

        return strpos($uri, $prefix)===0;
    }
}