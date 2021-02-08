<?php
namespace App\Controller;

require __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

use App\Kernel;
$kernel = new Kernel();
$kernel->run();
