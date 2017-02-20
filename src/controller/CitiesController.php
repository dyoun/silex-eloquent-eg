<?php
namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Model\City as City;

class CitiesController
{
    public function indexAction(Request $request, Application $app)
    {
        $city = City::orderBy('name')->get();
	    return $app->json($city->toArray());
    }

    public function find(Request $request, Application $app, $id)
    {
	    $city = City::with('neighborhoods')->find([$id]);
	    return $app->json($city->toArray());
    }

	public function postAction(Request $request, Application $app)
    {
		$city = new City();
	    $city->create([
	        'name' => $request->get('name'),
	    ]);

	    return $app->json([
	        'status' => 'created',
	        'data' => $city->toArray(),
	    ]);
	}
}
