<?php

namespace Fp\Saml\Sp;

use AerialShip\LightSaml\Meta\SerializationContext;
use AerialShip\LightSaml\Model\Metadata\EntitiesDescriptor;
use AerialShip\LightSaml\Model\Metadata\EntityDescriptor;
use Fp\Saml\aServiceContainerAware;
use Fp\Saml\iMetadataProvider;

class MetadataProvider extends aServiceContainerAware implements iMetadataProvider
{
    /**
     * @var EntitiesDescriptor
     */
    private $entityDescriptor;

    public function __construct()
    {
        parent::__construct();
        $this->entityDescriptor = new EntityDescriptor();
        $this->entityDescriptor->setEntityID($this->getContainer()->getConfig()->getSpConfig()->getSpMetadataUrl());
        $this->configureSpSsoDescriptor();
    }

    /**
     * @return $this
     */
    private function configureSpSsoDescriptor()
    {
        $config = $this->getContainer()->getConfig();
        $descriptor = new SsoDescriptor();
        $descriptor->setCertificate($config->getSpConfig()->getSpCertificate());
        $descriptor->configureSingleLogoutService($config->getSpConfig()->getSpSingleLogoutUrl());
        $descriptor->configureAssertionConsumerService($config->getSpConfig()->getSpAssertionConsumerUrl());
        $this->entityDescriptor->addItem($descriptor->getDescriptor());

        return $this;
    }

    /**
     * @return string
     */
    public function getXml()
    {
        $context = new SerializationContext();
        $this->entityDescriptor->getXml($context->getDocument(), $context);

        return $context->getDocument()->saveXML();
    }
}
