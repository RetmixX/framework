
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Src\Application(require __DIR__ . '/../configs/app.php');

require_once __DIR__ .  '/../core/helpers.php';

return $app;
