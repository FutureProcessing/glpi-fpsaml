<?php

namespace Fp\Saml\Request;

use AerialShip\LightSaml\Binding\HttpRedirect;
use Fp\Saml\Message\LogoutSpRequest;

class LogoutSp extends aRequest
{
    /**
     * @var \Fp\Saml\Message\LogoutSpRequest
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new LogoutSpRequest();
        $this->message->build()->signMessage();
    }

    /**
     * @return void
     */
    public function send()
    {
        $this->saveRequestState($this->getContainer()->getConfig()->getSpConfig()->getSpSingleLogoutUrl());

        $binding = new HttpRedirect();
        $bindingResponse = $binding->send($this->message->getMessage());
        $bindingResponse->render();
    }
}
