<?php 
$I = new AcceptanceTester($scenario);
$I->am('a guest');
$I->wantTo('registration as an new user');
$I->amOnPage('/');
$I->click('Registration');
$I->seeCurrentUrlEquals('/registration');

$I->submitForm('#registration', []);

$I->see('Value is required and can\'t be empty', '#field-identifier');
$I->see('Value is required and can\'t be empty', '#field-password');
$I->see('Value is required and can\'t be empty', '#field-identical');

$I->submitForm('#registration', [
    'identifier' => 'test',
    'password' => '123456',
    'identical' => '654321'
]);

$I->see('The input is not a valid email address', '#field-identifier');
$I->see('Passwords not match', '#field-identical');
