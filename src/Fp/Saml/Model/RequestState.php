<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 10:43
 */

namespace Fp\Saml\Model;

class RequestState
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $destination;
    /**
     * @var string
     */
    private $relayState;

    /**
     * @param  string $destination
     * @return $this
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param  string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string $relayState
     * @return $this
     */
    public function setRelayState($relayState)
    {
        $this->relayState = $relayState;

        return $this;
    }

    /**
     * @return string
     */
    public function getRelayState()
    {
        return $this->relayState;
    }
}
