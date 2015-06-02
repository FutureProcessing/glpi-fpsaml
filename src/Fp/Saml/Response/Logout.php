<?php
/**
 * Created by PhpStorm.
 * User: agorski
 * Date: 12/22/14
 * Time: 10:21 AM
 */

namespace Fp\Saml\Response;

class Logout extends aResponse
{
    /**
     * @return void
     */
    public function handle()
    {
        $this->getContainer()->getSsoStateStore()->destroy();
    }


    /**
     * @return \AerialShip\LightSaml\Model\Protocol\Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
