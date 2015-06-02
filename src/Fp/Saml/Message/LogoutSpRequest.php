<?php

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Meta\LogoutRequestBuilder;
use Fp\Saml\Store\EntityDescriptionStore;

class LogoutSpRequest extends aMessage
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\LogoutRequest
     */
    protected $message;

    /**
     * @return $this;
     */
    public function build()
    {
        $state = $this->getState();
        $this->message = $this->getBuilder()->build($state->getNameId(), $state->getNameIdFormat(), $state->getSessionId());

        return $this;
    }

    /**
     * @return LogoutRequestBuilder
     */
    private function getBuilder()
    {
        $config = $this->getContainer()->getConfig();
        $store = new EntityDescriptionStore();

        return new LogoutRequestBuilder(
            $store->get($config->getSpConfig()->getSpMetadataUrl()),
            $store->get($config->getIdpConfig()->getIdpMetadataUrl()),
            $this->getSpMeta()
        );
    }
}
