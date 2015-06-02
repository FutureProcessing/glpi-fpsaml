<?php

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Meta\AuthnRequestBuilder;
use Fp\Saml\Store\EntityDescriptionStore;

class AuthnRequest extends aMessage
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\AuthnRequest
     */
    protected $message;

    /**
     * @return $this
     */
    public function build()
    {
        $this->message = $this->getBuilder()->build();

        return $this;
    }

    /**
     * @return AuthnRequestBuilder
     */
    private function getBuilder()
    {
        $config = $this->getContainer()->getConfig();
        $store = new EntityDescriptionStore();

        return new AuthnRequestBuilder(
            $store->get($config->getSpConfig()->getSpMetadataUrl()),
            $store->get($config->getIdpConfig()->getIdpMetadataUrl()),
            $this->getSpMeta()
        );
    }
}
