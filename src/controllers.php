<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Model\City as City;
use Model\Neighborhood as Neighborhood;

// add support for JSON in POST requests
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

// cities
$app->get(
    '/',
    'Controller\\CitiesController::indexAction'
);$app->get(
    '/cities',
    'Controller\\CitiesController::indexAction'
);
$app->get(
    '/cities/{id}',
    'Controller\\CitiesController::find'
);
$app->post(
    '/cities',
    'Controller\\CitiesController::postAction'
);
// neighborhoods
$app->get(
    '/neighborhoods',
    'Controller\\NeighborhoodsController::indexAction'
);
$app->get(
    '/neighborhoods/{id}',
    'Controller\\NeighborhoodsController::find'
);
$app->post(
    '/neighborhoods',
    'Controller\\NeighborhoodsController::postAction'
);
// filter neighborhoods by city
$app->get(
    '/cities/{id}/neighborhoods',
    'Controller\\NeighborhoodsController::findByCity'
);

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
