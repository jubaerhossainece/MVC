<?php 
namespace app\core;
/**
 * 
 */
class Application
{
	public Request $request;
	public Router $router;

	function __construct()
	{
		$this->request = new Request;
		$this->router = new Router($this->request);
	}

	public function run(){
		$this->router->resolve();
	}
}
?>