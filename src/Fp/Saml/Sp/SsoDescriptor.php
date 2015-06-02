<?php
namespace Fp\Saml\Sp;

use AerialShip\LightSaml\Bindings;
use AerialShip\LightSaml\Model\Metadata\KeyDescriptor;
use AerialShip\LightSaml\Model\Metadata\Service\AssertionConsumerService;
use AerialShip\LightSaml\Model\Metadata\Service\SingleLogoutService;
use AerialShip\LightSaml\Model\Metadata\SpSsoDescriptor;
use AerialShip\LightSaml\Security\X509Certificate;

class SsoDescriptor
{
    /**
     * @var SpSsoDescriptor
     */
    private $descriptor;

    public function __construct()
    {
        $this->descriptor = new SpSsoDescriptor();
    }

    /**
     * @param  X509Certificate $certificate
     * @return $this
     */
    public function setCertificate(X509Certificate $certificate)
    {
        $keyDescriptor = new KeyDescriptor('signing', $certificate);
        $this->descriptor->addKeyDescriptor($keyDescriptor);

        return $this;
    }

    /**
     * @param $serviceUrl
     * @return $this
     */
    public function configureSingleLogoutService($serviceUrl)
    {
        $singleLogoutService = new SingleLogoutService();
        $singleLogoutService->setLocation($serviceUrl);
        $singleLogoutService->setBinding(Bindings::SAML2_HTTP_REDIRECT);
        $this->descriptor->addService(($singleLogoutService));

        return $this;
    }

    /**
     * @param  string $serviceUrl
     * @param  int    $index
     * @return $this
     */
    public function configureAssertionConsumerService($serviceUrl, $index = 0)
    {
        $assertionConsumerService = new AssertionConsumerService(Bindings::SAML2_HTTP_POST, $serviceUrl, $index);
        $this->descriptor->addService($assertionConsumerService);

        return $this;
    }

    /**
     * @return SpSsoDescriptor
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }
}
