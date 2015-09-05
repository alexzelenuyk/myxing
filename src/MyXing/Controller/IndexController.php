<?php
namespace MyXing\Controller;

use Silex\Application;

class IndexController
{
    /**
     * @param Application $app
     * @return string
     */
    public function index(Application $app)
    {
        /** @var \Twig_Environment $twig */
        $twig = $app['twig'];

        return $twig->render('/auth/login.twig');
    }
}