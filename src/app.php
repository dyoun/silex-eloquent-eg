<?php
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

date_default_timezone_set('America/New_York');

$app = new Silex\Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
));

$app->register(
    new \JG\Silex\Provider\CapsuleServiceProvider(),
    [
        'capsule.connections' => [
            'cities' => [
                'driver'    => 'mysql',
                'host'      => getenv('DB001_HOST'),
                'port'      => 3306,
                'database'  => getenv('DB001_DB'),
                'username'  => getenv('DB001_USER'),
                'password'  => getenv('DB001_PASS'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
                'engine'    => null,
            ],
            'neighborhoods' => [
                'driver'    => 'mysql',
                'host'      => getenv('DB002_HOST'),
                'port'      => 3306,
                'database'  => getenv('DB002_DB'),
                'username'  => getenv('DB002_USER'),
                'password'  => getenv('DB002_PASS'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
                'engine'    => null,
            ],
        ],
        'capsule.options' => [
            'setAsGlobal'    => true,
            'bootEloquent'   => true,
            'enableQueryLog' => true,
        ],
    ]
);

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});

return $app;
