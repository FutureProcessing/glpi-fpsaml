<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 11:46
 */

namespace Fp\Saml\Store;

use Fp\Saml\Model\RequestState;

class RequestStateStore
{
    const REQUEST_STATE_ACCESSOR = '__requestState__';
    const REQUEST_STATE_ID_ACCESSOR = 'id';
    const REQUEST_STATE_RELAY_STATE_ACCESSOR = 'relayState';
    const REQUEST_STATE_DESTINATION_ACCESSOR = 'destination';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION[self::REQUEST_STATE_ACCESSOR])) {
            $_SESSION[self::REQUEST_STATE_ACCESSOR] = array();
        }
    }

    /**
     * @param  RequestState $state
     * @return $this
     */
    public function save(RequestState $state)
    {
        $_SESSION[self::REQUEST_STATE_ACCESSOR][$state->getId()] = array(
            self::REQUEST_STATE_ID_ACCESSOR          => $state->getId(),
            self::REQUEST_STATE_RELAY_STATE_ACCESSOR => $state->getRelayState(),
            self::REQUEST_STATE_DESTINATION_ACCESSOR => $state->getDestination(),
        );

        return $this;
    }

    /**
     * @param  string            $id
     * @return RequestState|null
     */
    public function getById($id)
    {
        if (isset($_SESSION[self::REQUEST_STATE_ACCESSOR][$id])) {
            $stateData = $_SESSION[self::REQUEST_STATE_ACCESSOR][$id];
            $state = new RequestState();
            $state->setId($stateData[self::REQUEST_STATE_ID_ACCESSOR])
                ->setRelayState($stateData[self::REQUEST_STATE_RELAY_STATE_ACCESSOR])
                ->setDestination($stateData[self::REQUEST_STATE_DESTINATION_ACCESSOR]);

            return $state;
        }

        return;
    }

    /**
     * @return void
     */
    public function destroy()
    {
        $_SESSION[self::REQUEST_STATE_ACCESSOR] = array();
    }
}
