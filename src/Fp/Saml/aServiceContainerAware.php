<?php

namespace Fp\Saml;

abstract class aServiceContainerAware
{
    /**
     * @var ServiceContainer
     */
    protected $serviceContainer;

    public function __construct()
    {
        $this->serviceContainer = ServiceContainer::getInstance();
    }

    /**
     * @return ServiceContainer
     */
    final protected function getContainer()
    {
        return $this->serviceContainer;
    }
}
