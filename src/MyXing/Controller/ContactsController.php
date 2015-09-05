<?php
namespace MyXing\Controller;

use MyXing\Service\XingContacts;
use Silex\Application;

class ContactsController
{
    /**
     * @param Application $app
     * @return string
     */
    public function index(Application $app)
    {
        /** @var XingContacts $xingContactService */
        $xingContactService = $app['xing_contacts'];
        $contacts = $xingContactService->getMyContacts();
        /** @var \Twig_Environment $twig */
        $twig = $app['twig'];

        return $twig->render('/contacts/index.twig', array('contacts' => $contacts));
    }

}