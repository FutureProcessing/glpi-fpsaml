<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 30.12.14
 * Time: 06:33
 */

namespace Fp\Saml\Message;

use AerialShip\LightSaml\Meta\SpMeta;
use AerialShip\LightSaml\Model\Protocol\Message;
use Fp\Saml\aServiceContainerAware;

abstract class aMessage extends aServiceContainerAware
{
    /**
     * @var Message
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return $this
     */
    public function signMessage()
    {
        $this->message->sign(
            $this->getContainer()->getConfig()->getSpConfig()->getSpCertificate(),
            $this->getContainer()->getConfig()->getSpConfig()->getSpPrivateKey()
        );

        return $this;
    }

    /**
     * @return $this;
     */
    abstract public function build();

    /**
     * @return \Fp\Saml\Model\SsoState
     */
    protected function getState()
    {
        //TODO: throw an exception when sate is empty
        return $this->getContainer()->getSsoStateStore()->get();
    }

    /**
     * @return SpMeta
     */
    protected function getSpMeta()
    {
        $spMeta = new SpMeta();
        $spMeta->setNameIdFormat($this->getContainer()->getConfig()->getNameIdFormat());

        return $spMeta;
    }
}
