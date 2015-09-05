<?php
namespace MyXing\Controller\Provider;

use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;
use \Silex\ControllerCollection;
use \Symfony\Component\HttpFoundation\Request;

class Contacts implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @return ControllerCollection
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app["controllers_factory"];

        $controllers->get("/", "MyXing\\Controller\\ContactsController::index")
            ->before(function (Request $request, Application $app) {
                /** @var \Hybrid_Auth $hybridauth */
                $hybridauth = $app['hybrid_auth'];
                if (!$hybridauth->isConnectedWith('XING')) {
                    return $app->redirect('login');
                }
            })
            ->bind('contacts');

        return $controllers;
    }
}