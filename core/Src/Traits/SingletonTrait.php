<?php
namespace Src\Traits;

trait SingletonTrait
{
    private static self $instance;

    public function __construct(){}

    public static function single(): self{
        if (empty(self::$instance))
            self::$instance = new static();

        return self::$instance;
    }
}