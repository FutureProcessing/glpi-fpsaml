<?php

namespace Fp\Saml\ResponseHandler;

use Fp\Saml\aServiceContainerAware;
use Fp\Saml\IdpMessageReceiver;

abstract class aResponse extends aServiceContainerAware
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\Message
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
        $response = new IdpMessageReceiver();
        $this->message = $response->getMessage();
    }

    /**
     * @return void
     */
    abstract public function handle();

    /**
     * @param \AerialShip\LightSaml\Model\Protocol\Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
