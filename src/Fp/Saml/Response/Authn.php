<?php

namespace Fp\Saml\Response;

use AerialShip\LightSaml\Model\Protocol\Response;
use Fp\Saml\Model\SsoState;

class Authn extends aResponse
{
    /**
     * @return void
     */
    public function handle()
    {
        $assertions = $this->getMessage()->getAllAssertions();
        $assertion = reset($assertions);
        $this->saveSsoState($assertion);
        //$signature = $assertion->getSignature();
        //var_dump($id, $assertions, $session, $signature);
        //$key = KeyHelper::createPublicKey(\Fp\Saml\ServiceContainer::getInstance()->getConfig()->getIdpCertificate());
        //$signature->validateMulti([$key]);
    }

    /**
     * @return  Response
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param \AerialShip\LightSaml\Model\Assertion\Assertion $assertion
     * @return $this
     */
    private function saveSsoState(\AerialShip\LightSaml\Model\Assertion\Assertion $assertion)
    {
        $state = new SsoState();
        $attributes = array();

        var_dump($assertion->getAllAttributes());

        foreach ($assertion->getAllAttributes() as $attribute) {
            $attributes[$attribute->getName()] = $attribute->getValues();
        }

        $state->setNameId($assertion->getSubject()->getNameID()->getValue())
            ->setSessionId($assertion->getAuthnStatement()->getSessionIndex())
            ->setAttributes($attributes)
            ->setNameIdFormat($assertion->getSubject()->getNameID()->getFormat());

        $this->getContainer()->getSsoStateStore()->save($state);

        return $this;
    }
}
