<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('I want to login to the website');
$I->amOnPage('/login');
$I->see('Login');
$I->fillField('_username','glaserpower@gmail.com');
$I->fillField('_password','password');
$I->click('login');
$I->canSeeInCurrentUrl('/admin/dashboard');
