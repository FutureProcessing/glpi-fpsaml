<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 30.12.14
 * Time: 07:20
 */

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Helper;
use AerialShip\LightSaml\Model\Protocol\LogoutResponse as Response;
use AerialShip\LightSaml\Model\Protocol\Status;
use AerialShip\LightSaml\Model\Protocol\Message;

class LogoutIdpResponse extends aMessage
{
    /**
     * @var string
     */
    private $destination;

    /**
     * @var string
     */
    private $inResponseTo;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var \AerialShip\LightSaml\Model\Protocol\LogoutResponse
     */
    protected $message;

    /**
     * @param string                                      $destination
     * @param Message                                     $inResponseTo
     * @param \AerialShip\LightSaml\Model\Protocol\Status $status
     */
    public function __construct($destination, Message $inResponseTo, Status $status)
    {
        parent::__construct();
        $this->destination = $destination;
        $this->inResponseTo = $inResponseTo;
        $this->status = $status;
    }

    /**
     * @return $this;
     */
    public function build()
    {
        $this->message = new Response();

        $this->message->setID(Helper::generateID());
        $this->message->setIssuer($this->getContainer()->getConfig()->getSpConfig()->getSpMetadataUrl());
        $this->message->setInResponseTo($this->inResponseTo->getID());
        $this->message->setDestination($this->destination);
        $this->message->setStatus($this->status);

        return $this;
    }
}
