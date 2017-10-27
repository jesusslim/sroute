# sroute
simple route

## usage

	$routes = new \sroute\src\Routes();
	$routes->post('/test',[YourController::class,'action']);
	$routes->get('/closure',function(){ echo "sroute";});
	$route = $routes->match('GET','/closure');
	$handler = $routes->handler('GET','/closure');