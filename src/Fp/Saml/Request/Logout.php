<?php
/**
 * Created by PhpStorm.
 * User: agorski
 * Date: 12/22/14
 * Time: 9:40 AM
 */

namespace Fp\Saml\Request;

use AerialShip\LightSaml\Binding\HttpRedirect;
use Fp\Saml\Message\LogoutRequest;

class Logout extends aRequest
{
    public function send()
    {
        $message = new LogoutRequest();
        $message->build()->signMessage();
        $binding = new HttpRedirect();
        $bindingResponse = $binding->send($message->getMessage());
        $bindingResponse->render();
    }
}
