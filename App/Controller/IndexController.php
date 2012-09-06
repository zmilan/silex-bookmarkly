<?php
namespace App\Controller{

	use Silex\ControllerProviderInterface;
	use Silex\Application;

	class IndexController implements ControllerProviderInterface{
		function connect(Application $app){
			$index = $app['controllers_factory'];
			$index->get('/','App\Controller\IndexController::index');
			$index->get('/info','App\Controller\IndexController::info');
			$index->get('/log','App\Controller\IndexController::log');
			$index->get('/{name}','App\Controller\IndexController::helloName');
			return $index;
		}

		function index(Application $app){
			    return 'home : .'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}

		function helloName(Application $app,$name){
			return "Hello $name !";
		}

		function info(Application $app){
			return phpinfo();
		}

		function log(Application $app){
			$log = file_get_contents(ROOT.'/log/application.log');
			$app['response']->headers->set('Content-Type','text/plain');
			return $log;
		}
	}
}