<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => __DIR__ . '/../src/MyXing/View',
    )
);
$hybridAuthConfig = require __DIR__ . '/../config/hybridauth.php';
$app->register(new \MyXing\Provider\HybridAuth($hybridAuthConfig));
$app->register(new \Silex\Provider\RoutingServiceProvider());
$app->register(new \Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => sys_get_temp_dir() . '/myxing_main.log',
));
$app['xing_contacts'] = function () use ($app){
    return new \MyXing\Service\XingContacts($app['hybrid_auth']->getAdapter('XING')->api(), $app['monolog']);
};
$app->mount("/contacts", new \MyXing\Controller\Provider\Contacts());
$app->mount("/auth", new \MyXing\Controller\Provider\Auth());
$app->mount("/", new \MyXing\Controller\Provider\Index());

//$app['debug'] = true;

$app->run();