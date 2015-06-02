<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 30.12.14
 * Time: 07:14
 */

namespace Fp\Saml\RequestHandler;

use AerialShip\LightSaml\Binding\HttpRedirect;
use AerialShip\LightSaml\Model\Protocol\Status;
use Fp\Saml\Helper;
use Fp\Saml\Message\LogoutResponse;

class Logout extends aRequestHandler
{
    public function handle()
    {
        $message = $this->buildMessage();
        $message->signMessage();

        $binding = new HttpRedirect();
        $bindingResponse = $binding->send($message->getMessage());
        $bindingResponse->render();

        $this->getContainer()->getSsoStateStore()->destroy();
    }

    /**
     * @return LogoutResponse
     */
    private function buildMessage()
    {
        $message = new LogoutResponse(
            $this->getDestination(),
            $this->message,
            $this->getStatus()
        );

        $message->build();

        return $message;
    }

    private function getStatus()
    {
        $status = new Status();
        $status->setSuccess();
        return $status;
    }


    private function getDestination()
    {
        $idpMetadataUrl = $this->getContainer()->getConfig()->getIdpMetadataUrl();

        $sloServices = Helper::getEntityDescriptionFromXmlDocument($idpMetadataUrl)
            ->getFirstIdpSsoDescriptor()
            ->findSingleLogoutServices();

        $slo = reset($sloServices);
        return $slo->getLocation();
    }
}
