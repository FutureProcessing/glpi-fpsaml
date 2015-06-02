<?php


namespace Fp\Saml\Message\Validator;

use AerialShip\LightSaml\Model\Protocol\StatusResponse;
use AerialShip\LightSaml\Protocol;

class isSuccessful extends aValidator
{
    /**
     * @var StatusResponse
     */
    protected $message;

    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    public function validate()
    {
        if ($this->message->getStatus()->getStatusCode()->getValue() !== Protocol::STATUS_SUCCESS) {
            $errorMessage = 'Returned requestMessage has invalid status: "%s"';
            throw new Exception(
                sprintf($errorMessage, $this->message->getStatus()->getStatusCode()->getValue())
            );
        }
    }
}
