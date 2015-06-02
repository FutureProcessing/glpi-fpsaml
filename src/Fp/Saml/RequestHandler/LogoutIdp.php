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
use Fp\Saml\Message\LogoutIdpResponse;
use Fp\Saml\Store\EntityDescriptionStore;

class LogoutIdp extends aRequestHandler
{
    public function handle()
    {
        $response = $this->buildResponseMessage();
        $response->signMessage();

        $binding = new HttpRedirect();
        $bindingResponse = $binding->send($response->getMessage());
        $bindingResponse->render();

        $this->getContainer()->getSsoStateStore()->destroy();
    }

    /**
     * @return LogoutIdpResponse
     */
    private function buildResponseMessage()
    {
        $message = new LogoutIdpResponse(
            $this->getDestination(),
            $this->requestMessage,
            $this->getStatus()
        );

        $message->build();

        return $message;
    }

    /**
     * @return Status
     */
    private function getStatus()
    {
        $status = new Status();
        $status->setSuccess();

        return $status;
    }

    /**
     * @return string
     */
    private function getDestination()
    {
        $idpMetadataUrl = $this->getContainer()->getConfig()->getIdpConfig()->getIdpMetadataUrl();
        $store = new EntityDescriptionStore();

        $sloServices = $store->get($idpMetadataUrl)
            ->getFirstIdpSsoDescriptor()
            ->findSingleLogoutServices();

        $slo = reset($sloServices);

        return $slo->getLocation();
    }
}
