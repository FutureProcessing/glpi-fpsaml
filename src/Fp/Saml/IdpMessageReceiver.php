<?php

namespace Fp\Saml;

use AerialShip\LightSaml\Binding\BindingDetector;
use AerialShip\LightSaml\Binding\Request;

class IdpMessageReceiver extends aServiceContainerAware
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     * @throws \AerialShip\LightSaml\Error\InvalidBindingException
     */
    public function getMessage()
    {
        $request = Request::fromGlobals();

        $detector = new BindingDetector();
        $binding = $detector->instantiate($detector->getBinding($request));

        return $binding->receive($request);
    }
}
