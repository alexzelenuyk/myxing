<?php
use \Codeception\Util\Stub as Stub;

class XingContactsTest extends \Codeception\TestCase\Test
{
    public function testGetContacts()
    {
        $oathAdapter = Stub::make('\OAuth1Client', [
            'get' => Stub::consecutive(
                json_decode(json_encode(array('contact_ids' => array('items' => array('1abc'))))),
                json_decode(json_encode(
                    array(
                        'users' => array(
                            array(
                                'display_name' => 'name',
                                'photo_urls' => array(
                                    'medium_thumb' => 'url'
                                ),
                                'professional_experience' => array(
                                    'primary_company' => array(
                                        'name' => 'company_name'
                                    )
                                )
                            )
                        )
                    )
                ))
            )
        ]);
        $service = new \MyXing\Service\XingContacts($oathAdapter, Stub::make('Monolog\Logger'));
        $contacts = $service->getMyContacts();
        $this->assertEquals('name', $contacts[0]->getDisplayName());
        $this->assertEquals('url', $contacts[0]->getImage());
        $this->assertEquals('company_name', $contacts[0]->getOrganization());
    }

    public function testOnErrorWithContactsApi()
    {
        $oathAdapter = Stub::make('\OAuth1Client', [
            'get' => json_decode(json_encode(array('message' => 'Error')))
        ]);
        $loggerStub = Stub::make('Monolog\Logger', ['addError' => true]);
        $service = new \MyXing\Service\XingContacts($oathAdapter, $loggerStub);
        $this->setExpectedException('\RuntimeException');
        $service->getMyContacts();
    }

    public function testOnErrorRequestingContactDetails()
    {
        $oathAdapter = Stub::make('\OAuth1Client', [
            'get' => Stub::consecutive(
                json_decode(json_encode(array('contact_ids' => array('items' => array('1abc'))))),
                json_decode(json_encode(array('message' => 'Error')))
            )
        ]);
        $loggerStub = Stub::make('Monolog\Logger', ['addError' => true]);
        $service = new \MyXing\Service\XingContacts($oathAdapter, $loggerStub);
        $contacts = $service->getMyContacts();
        $this->assertEmpty($contacts);
    }
}