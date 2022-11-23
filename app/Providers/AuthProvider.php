<?php

namespace Providers;

use Src\Provider\AbstractProvider;

class AuthProvider extends AbstractProvider
{

    function register(): void
    {
        // TODO: Implement register() method.
    }

    function boot(): void
    {
        $authClass = $this->app->settings->getAuthClassName();
        $identityClass = $this->app->settings->getIdentityClassName();

        $authClass::init(new $identityClass);
        $this->app->bind('auth', new $authClass);
    }
}