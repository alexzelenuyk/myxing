<?php
namespace MyXing\Service;

use Monolog\Logger;
use MyXing\Entity\Contact;

class XingContacts
{
    const MY_CONTACTS_URL = 'users/me/contact_ids';
    const CONTACTS_DETAILS_URL = 'users/%s';
    /** @var \OAuth1Client */
    private $oauthClient;
    /** @var Logger */
    private $logger;
    /** @var array */
    private $contactFields = array(
        'display_name',
        'photo_urls.medium_thumb',
        'professional_experience.primary_company.name',
    );

    /**
     * @param \OAuth1Client $oauthClient
     * @param Logger $logger
     */
    public function __construct(\OAuth1Client $oauthClient, Logger $logger)
    {
        $this->oauthClient = $oauthClient;
        $this->logger = $logger;
    }

    /**
     * @param array $contactFields
     * @return Contact[]
     */
    public function getMyContacts($contactFields = array())
    {
        $contactIds = $this->getContactIds();

        $contacts = array();
        foreach ($contactIds as $contactId) {
            $contactDetails = $this->getContactDetails($contactId, $contactFields);
            if($contactDetails) {
                $contacts[] = new Contact($contactDetails);
            }
        }

        return $contacts;
    }

    /**
     * @param $contactId
     * @param array $contactFields
     * @return \stdClass|null
     */
    private function getContactDetails($contactId, $contactFields = array())
    {
        $fieldsToFetch = empty($contactFields) ? $this->contactFields : $contactFields;
        $contactDetails = $this->oauthClient->get(
            sprintf(self::CONTACTS_DETAILS_URL, $contactId),
            array(
                'fields' => array(
                    implode(',', $fieldsToFetch)
                )
            )
        );
        if(isset($contactDetails->users[0])) {
            return $contactDetails->users[0];
        }

        $error = 'Can\'t get contact. For id: ' . $contactId . ' Error:' . $contactDetails->message;
        $this->logger->addError($error);

        return null;
    }
    /**
     * @throws \RuntimeException
     * @return array
     */
    private function getContactIds()
    {
        $contacts = $this->oauthClient->get(self::MY_CONTACTS_URL);
        if (isset($contacts->contact_ids)) {
            return (array)$contacts->contact_ids->items;
        }

        $error = 'Can\'t get contacts. Error:' . $contacts->message;
        $this->logger->addError($error);

        throw new \RuntimeException($error);
    }
}
