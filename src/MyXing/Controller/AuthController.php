<?php
namespace MyXing\Controller;

use Silex\Application;

class AuthController
{
    /**
     * @param Application $app
     * @return string
     */
    public function login(Application $app)
    {
        /** @var \Hybrid_Auth $hybridAuth */
        $hybridAuth = $app['hybrid_auth'];
        $hybridAuth->authenticate('XING', array("hauth_return_to" => "/contacts"));
    }

    /**
     * @param Application $app
     * @return string
     */
    public function logout(Application $app)
    {
        /** @var \Hybrid_Auth $hybridAuth */
        $hybridAuth = $app['hybrid_auth'];
        $hybridAuth->logoutAllProviders();

        return $app->redirect('/');
    }

    /**
     * @param Application $app
     */
    public function endpoint(Application $app)
    {
        \Hybrid_Endpoint::process();
    }
}