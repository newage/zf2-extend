<?php 
$I = new AcceptanceTester($scenario);
$I->am('a guest');
$I->wantTo('authorization');
$I->amOnPage('/');
$I->click('Login');
$I->seeCurrentUrlEquals('/login');

$I->submitForm('#login', []);

$I->see('Value is required and can\'t be empty', '#field-identifier');
$I->see('Value is required and can\'t be empty', '#field-password');

$I->submitForm('#login', [
    'identifier' => 'test'
]);

$I->see('The input is not a valid email address', '#field-identifier');

$I->submitForm('#login', [
    'identifier' => 'test@test.no',
    'password' => '123456'
]);

$I->see('A user account not be found or disable');