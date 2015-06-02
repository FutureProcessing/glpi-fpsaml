<?php
/**
 * Created by PhpStorm.
 * User: agorski
 * Date: 12/22/14
 * Time: 7:46 AM
 */

namespace Fp\Saml;

use Fp\Saml\Response;

abstract class aResponse extends aServiceContainerAware
{
    /**
     * @var \AerialShip\LightSaml\Model\Protocol\Message
     */
    protected $message;

    public function __construct()
    {
        parent::__construct();
        $response = new Response();
        $this->message = $response->getMessage();
    }

    /**
     * @return void
     */
    abstract public function handle();
}
