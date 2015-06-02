<?php

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Meta\LogoutRequestBuilder;
use Fp\Saml\Helper;

class LogoutRequest extends aMessage
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

        return new LogoutRequestBuilder(
            Helper::getEntityDescriptionFromXmlDocument($config->getSpMetadataUrl()),
            Helper::getEntityDescriptionFromXmlDocument($config->getIdpMetadataUrl()),
            $this->getSpMeta()
        );
    }
}
