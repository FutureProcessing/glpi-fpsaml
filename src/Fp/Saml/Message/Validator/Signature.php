<?php

namespace Fp\Saml\Message\Validator;

use AerialShip\LightSaml\Model\Protocol\Response;
use AerialShip\LightSaml\Security\KeyHelper;

class Signature extends aValidator
{
    /**
     * @throws \RuntimeException
     * @throws Exception
     * @return void
     */
    public function validate()
    {
        if ($this->message instanceof Response) {
            $assertions = $this->message->getAllAssertions();
            $assertion = reset($assertions);
            $message = $assertion;
        } else {
            $message = $this->message;
        }

        $signature = $message->getSignature();

        if (!$signature) {
            throw new \RuntimeException('Message must be signed');
        }

        $key = KeyHelper::createPublicKey($this->getContainer()->getConfig()->getIdpConfig()->getIdpCertificate());

        try {
            $signature->validate($key);
        } catch (\Exception $e) {
            throw new Exception("Message has invalid signature: ".$e->getMessage().".");
        }
    }
}
