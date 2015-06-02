<?php
/**
 * Created by PhpStorm.
 * User: agorski
 * Date: 12/19/14
 * Time: 10:26 AM
 */

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Model\Protocol\Message;

abstract class aValidator
{
    /**
     * @var Message
     */
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    abstract public function validate();
}
