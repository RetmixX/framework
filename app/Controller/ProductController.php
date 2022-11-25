<?php

namespace Controller;
use Models\Task\ProductTask;
use Src\View;

class ProductController
{
    public function showProducts(): void{
        $products = ProductTask::all()->toArray();
        (new View())->toJSON($products);
    }
}