<?php
namespace MyXing\Controller\Provider;

use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;
use \Silex\ControllerCollection;
use \Symfony\Component\HttpFoundation\Request;

class Auth implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app["controllers_factory"];

        $controllers->get("/login", "MyXing\\Controller\\AuthController::login")
            ->before(function (Request $request, Application $app) {
                /** @var \Hybrid_Auth $hybridauth */
                $hybridauth = $app['hybrid_auth'];
                if ($hybridauth->isConnectedWith('XING')) {
                    return $app->redirect('/contacts');
                }
            })
            ->bind('login');
        $controllers->get("/logout", "MyXing\\Controller\\AuthController::logout")
            ->bind('logout');
        $controllers->get("/endpoint", "MyXing\\Controller\\AuthController::endpoint")
            ->bind('endpoint');

        return $controllers;
    }
}