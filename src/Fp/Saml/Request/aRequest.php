<?php

namespace Fp\Saml\Request;

use Fp\Saml\aServiceContainerAware;
use Fp\Saml\Message\aMessage;
use Fp\Saml\Model\RequestState;

abstract class aRequest extends aServiceContainerAware
{
    /**
     * @var aMessage
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Fp\Saml\Message\aMessage
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $destination
     */
    protected function saveRequestState($destination)
    {
        $message = $this->message->getMessage();
        $state = new RequestState();
        $store = $this->getContainer()->getRequestStateStore();

        $state->setDestination($destination)
            ->setId($message->getID())
            ->setRelayState($message->getRelayState());

        $store->save($state);
    }

    abstract public function send();
}
