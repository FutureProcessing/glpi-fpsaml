<?php

namespace Fp\Saml\Message\Validator;

use AerialShip\LightSaml\Model\Protocol\Message;
use Fp\Saml\aServiceContainerAware;

abstract class aValidator extends aServiceContainerAware
{
    /**
     * @var Message
     */
    protected $message;

    public function __construct(Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    abstract public function validate();
}
