<?php

namespace Fp\Saml;

use Fp\Saml\Store\iSsoState;
use Fp\Saml\Store\RequestStateStore;

final class ServiceContainer
{
    /**
     * @var ServiceContainer
     */
    private static $instance = null;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var iSsoState
     */
    private $ssoStateStore;

    /**
     * @var RequestStateStore
     */
    private $requestStateStore;

    private function __construct()
    {
    }

    /**
     * @return ServiceContainer
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param  Config $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return iSsoState
     */
    public function getSsoStateStore()
    {
        return $this->ssoStateStore;
    }

    /**
     * @param  iSsoState $ssoStateStore
     * @return $this
     */
    public function setSsoStateStore(iSsoState $ssoStateStore)
    {
        $this->ssoStateStore = $ssoStateStore;

        return $this;
    }

    /**
     * @param  \Fp\Saml\Store\RequestStateStore $requestStateStore
     * @return $this
     */
    public function setRequestStateStore($requestStateStore)
    {
        $this->requestStateStore = $requestStateStore;

        return $this;
    }

    /**
     * @return \Fp\Saml\Store\RequestStateStore
     */
    public function getRequestStateStore()
    {
        return $this->requestStateStore;
    }
}
