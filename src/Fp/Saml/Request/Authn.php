<?php

namespace Fp\Saml\Request;

use AerialShip\LightSaml\Binding\HttpRedirect;
use Fp\Saml\Message\AuthnRequest;

class Authn extends aRequest
{
    /**
     * @var AuthnRequest
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new AuthnRequest();
        $this->message->build();
    }

    /**
     * @return void
     */
    public function send()
    {
        $this->saveRequestState($this->getContainer()->getConfig()->getSpConfig()->getSpAssertionConsumerUrl());

        $binding = new HttpRedirect();
        $bindingResponse = $binding->send($this->message->getMessage());
        $bindingResponse->render();
    }
}
