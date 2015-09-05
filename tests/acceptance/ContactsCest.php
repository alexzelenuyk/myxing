<?php
use \AcceptanceTester;

class ContactsCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(IndexPage::$URL);
        $I->canSee('Login');
        $I->click(IndexPage::$loginButton);
        $I->canSee('Einloggen');
        $I->fillField(XingPage::$userNameField, '******');
        $I->fillField(XingPage::$passwordNameField, '******');
        $I->click(XingPage::$loginButton);
    }

    public function _after(AcceptanceTester $I)
    {
        $I->click(ContactsPage::$logoutButton);
    }

    public function tryToTestContactsList(AcceptanceTester $I)
    {
        $I->amOnPage('/contacts');
        $I->canSee('My contacts');
    }
}