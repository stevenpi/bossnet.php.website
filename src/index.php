<?php
require __DIR__.'/vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader);

$actual_link = $_SERVER['REQUEST_URI'];

if ("/services" == $actual_link) {
    echo $twig->render('services.html');
}
else {
    echo $twig->render('index.html');
}
