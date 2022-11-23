<?php

return [
    'auth'=>\Src\Auth\Auth::class,
    'identity'=>\Models\User::class,

    'providers'=>[
        'kernel' => \Providers\KernelProvider::class,
        'route' => \Providers\RouteProvider::class,
        'db' => \Providers\DBProvider::class,
        'auth' => \Providers\AuthProvider::class,
    ],

    'routeMiddleware'=>[
        'auth'=>\Middlewares\AuthMiddleware::class,
    ],

    'routeAppMiddleware'=>[
        'trim'=>\Middlewares\TrimMiddlewares::class,
        'specialChars'=>\Middlewares\SpecialCharsMiddleware::class,
        "csrf"=>\Middlewares\CSRFMiddleware::class,
        "json"=>\Middlewares\JSONMiddleware::class,
    ],

    'validators'=>[
      'required'=> \Validators\RequireValidator::class,
      'unique'=>\Validators\UniqueValidator::class
    ],
];