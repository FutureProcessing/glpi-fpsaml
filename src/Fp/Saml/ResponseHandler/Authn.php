<?php

namespace Fp\Saml\ResponseHandler;

use AerialShip\LightSaml\Model\Assertion\Assertion;
use Fp\Saml\Model\SsoState;

class Authn extends aResponse
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\Response
     */
    protected $message;

    /**
     * @return void
     */
    public function handle()
    {
        $assertions = $this->message->getAllAssertions();
        $assertion = reset($assertions);
        $this->saveSsoState($assertion);
    }

    /**
     * @param  Assertion $assertion
     * @return $this
     */
    private function saveSsoState(Assertion $assertion)
    {
        $state = new SsoState();
        $attributes = array();

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
