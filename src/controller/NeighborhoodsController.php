<?php
namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use Model\Neighborhood as Neighborhood;

class NeighborhoodsController
{
    public function indexAction(Request $request, Application $app)
    {
        $neighborhood = Neighborhood::all();
	    return $app->json($neighborhood->toArray());
    }

    public function find(Request $request, Application $app, $id)
    {
	    $neighborhood = Neighborhood::find([$id]);
	    return $app->json($neighborhood->toArray());
    }

    public function findByCity(Request $request, Application $app, $id)
    {
	    $neighborhood = Neighborhood::where('city_id', '=', $id)->get();
	    return $app->json($neighborhood->toArray());
    }

	public function postAction(Request $request, Application $app)
    {
		$neighborhood = new Neighborhood();
	    $neighborhood->create([
	    	'city_id' => $request->get('city_id'),
	        'name' => $request->get('name'),
	    ]);

	    return $app->json([
	        'status' => 'created',
	        'data' => $neighborhood->toArray(),
	    ]);
	}
}
