<?php

use Fp\Saml\Message\Validator\aValidator;
use Fp\Saml\Message\Validator\isSuccessful;
use Fp\Saml\Message\Validator\Issuer;
use Fp\Saml\Message\Validator\RequestState;
use Fp\Saml\Message\Validator\Signature;
use Fp\Saml\RequestHandler\LogoutIdp;

require_once('./../vendor/autoload.php');
require_once('./../_bootstrap.php');

if (isset($_GET['SAMLRequest'])) {
    $request = new LogoutIdp();

    /** @var aValidator[] $validators */
    $validators = array(
        new Signature($request->getRequestMessage()),
        new Issuer($request->getRequestMessage()),
    );

    try {
        foreach ($validators as $validator) {
            $validator->validate();
        }
    } catch (\Exception $e) {
        Toolbox::logInFile("php-errors", $e . "\n\n", true);
        session_destroy();
        exit('SAML response error');
    }

    $request->handle();

    session_destroy();

    header("Location: /");
} else {
    $response = new \Fp\Saml\ResponseHandler\Logout();

    /** @var aValidator[] $validators */
    $validators = array(
        new isSuccessful($response->getMessage()),
        new Signature($response->getMessage()),
        new Issuer($response->getMessage()),
    );

    try {
        foreach ($validators as $validator) {
            $validator->validate();
        }
    } catch (\Exception $e) {
        Toolbox::logInFile("php-errors", $e . "\n", true);
        session_destroy();
        exit('SAML response error');
    }

    $response->handle();

    session_destroy();

    header("Location: /");
}
