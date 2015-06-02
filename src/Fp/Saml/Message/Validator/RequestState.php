<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 12:15
 */

namespace Fp\Saml\Message\Validator;

use AerialShip\LightSaml\Model\Protocol\Response;

class RequestState extends aValidator
{
    /**
     * @var Response
     */
    protected $message;

    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    public function validate()
    {
        $id = $this->message->getInResponseTo();
        $relayState = $this->message->getRelayState();
        $destination = $this->message->getDestination();
        $store = $this->serviceContainer->getRequestStateStore();

        if ($id) {
            $state = $store->getById($id);
            if ($state === null ||
                $state->getRelayState() !== $relayState ||
                $state->getDestination() !== $destination
            ) {
                throw new Exception('Got response to a request that was not made');
            }
        }
    }
}
