<?php

namespace Fp\Saml\ResponseHandler;

class Logout extends aResponse
{
    /**
     * @return void
     */
    public function handle()
    {
        $this->getContainer()->getSsoStateStore()->destroy();
        $this->getContainer()->getRequestStateStore()->destroy();
    }

    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
