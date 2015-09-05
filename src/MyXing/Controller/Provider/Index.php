<?php
namespace MyXing\Controller\Provider;

use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;
use \Silex\ControllerCollection;
use \Symfony\Component\HttpFoundation\Request;

class Index implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app["controllers_factory"];

        $controllers
            ->get("/", "MyXing\\Controller\\IndexController::index")
            ->before(function (Request $request, Application $app) {
                /** @var \Hybrid_Auth $hybridauth */
                $hybridauth = $app['hybrid_auth'];
                if ($hybridauth->isConnectedWith('XING')) {
                    return $app->redirect('/contacts');
                }
            })
            ->bind('index');

        return $controllers;
    }
}