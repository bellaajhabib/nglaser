<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Login Failure');
$I->amOnPage('/login');
$I->see('Login');
$I->fillField('_username','glaserpower@gmail.com');
$I->fillField('_password','passwords');
$I->click('login');
$I->canSeeInCurrentUrl('/login');
$I->canSee("Invalid credentials");