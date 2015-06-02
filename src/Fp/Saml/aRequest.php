<?php

namespace Fp\Saml;

use AerialShip\LightSaml\Meta\SpMeta;
use AerialShip\LightSaml\Model\Metadata\EntityDescriptor;

abstract class aRequest extends aServiceContainerAware
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEntityDescriptionFromXmlDocument($xmlUrl)
    {
        $doc = new \DOMDocument();
        $doc->load($xmlUrl);

        $entityDescriptor = new EntityDescriptor();
        $entityDescriptor->loadFromXml($doc->firstChild);

        return $entityDescriptor;
    }

    abstract public function send();

    protected function getSpMeta()
    {
        $spMeta = new SpMeta();
        var_dump($this->getContainer()->getConfig()->getNameIdFormat());
        $spMeta->setNameIdFormat($this->getContainer()->getConfig()->getNameIdFormat());
        return $spMeta;
    }
}
