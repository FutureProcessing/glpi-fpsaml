<?php

use Fp\Saml\Message\Validator\aValidator;
use Fp\Saml\ResponseHandler\Authn;
use Fp\Saml\Message\Validator\AssertionSubjectTime;
use Fp\Saml\Message\Validator\AssertionTime;
use Fp\Saml\Message\Validator\isSuccessful;
use Fp\Saml\Message\Validator\Issuer;
use Fp\Saml\Message\Validator\RequestState;
use Fp\Saml\Message\Validator\Signature;
use Fp\Saml\Message\Validator\SubjectConfirmationRecipient;
use Fp\Saml\ServiceContainer;

require_once('./../vendor/autoload.php');
require_once('./../_bootstrap.php');
require_once('./../inc/main.class.php');

$response = new Authn();

/** @var aValidator[] $validators */
$validators = array(
    new isSuccessful($response->getMessage()),
    new Signature($response->getMessage()),
    new Issuer($response->getMessage()),
    new AssertionTime($response->getMessage()),
    new AssertionSubjectTime($response->getMessage()),
    new SubjectConfirmationRecipient($response->getMessage()),
    new RequestState($response->getMessage())
);
try {
    foreach ($validators as $validator) {
        $validator->validate();
    }
} catch (\Exception $e) {
    Toolbox::logInFile("php-errors", $e . "\n", true);
    exit('SAML response error');
}

$response->handle();

$_SESSION['ssoNameId'] = ServiceContainer::getInstance()->getSsoStateStore()->get()->getNameId();

PluginFpsamlMain::redirectToMainPage($response->getMessage()->getRelayState());
