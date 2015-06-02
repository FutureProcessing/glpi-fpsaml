<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 30.12.14
 * Time: 07:15
 */

namespace Fp\Saml\RequestHandler;

use Fp\Saml\aServiceContainerAware;
use Fp\Saml\IdpMessageReceiver;

abstract class aRequestHandler extends aServiceContainerAware
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\Message
     */
    protected $requestMessage;

    public function __construct()
    {
        parent::__construct();
        $request = new IdpMessageReceiver();
        $this->requestMessage = $request->getMessage();
    }

    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     */
    public function getRequestMessage()
    {
        return $this->requestMessage;
    }

    abstract public function handle();
}
