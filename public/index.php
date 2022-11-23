<?php
declare(strict_types=1);
session_start();

try{
    $app = require_once __DIR__ ."/../core/bootstrap.php";
    $app->run();
}catch (Throwable $ex){
    echo "<pre>";
    print_r($ex->getMessage());
    echo "<pre>";
    print_r($ex);
    echo "<pre>";
}
