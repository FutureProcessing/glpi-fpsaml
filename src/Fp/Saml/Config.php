<?php

namespace Fp\Saml;

use Assert\Assertion;
use Fp\Saml\Config\Idp;
use Fp\Saml\Config\Sp;

class Config
{
    /**
     * @var Idp
     */
    private $idpConfig;
    /**
     * @var string
     */
    private $nameIdFormat;
    /**
     * @var Sp
     */
    private $spConfig;

    /**
     * @var string absolute path tu cache directory
     */
    private $cacheDir;

    /**
     * @var bool
     */
    private $entityDescriptionCacheEnabled = true;

    /**
     * @var int
     */
    private $cacheLifetime = 3600;

    /**
     * @var bool
     */
    private $forceRedirectToSignInPage;

    /**
     * @var string[]
     */
    private $urisIgnored;

    /**
     * @return int
     */
    public function getCacheLifetime()
    {
        return $this->cacheLifetime;
    }

    /**
     * @param  int $cacheLifetime
     * @return $this
     */
    public function setCacheLifetime($cacheLifetime)
    {
        Assertion::digit($cacheLifetime);
        $this->cacheLifetime = (int)$cacheLifetime;

        return $this;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * @param  string $cacheDir
     * @return $this
     */
    public function setCacheDir($cacheDir)
    {
        Assertion::directory($cacheDir);
        $this->cacheDir = $cacheDir;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isEntityDescriptionCacheEnabled()
    {
        return $this->entityDescriptionCacheEnabled;
    }

    /**
     * @param  boolean $entityDescriptionCacheEnabled
     * @return $this
     */
    public function setEntityDescriptionCacheEnabled($entityDescriptionCacheEnabled)
    {
        $this->entityDescriptionCacheEnabled = $entityDescriptionCacheEnabled;

        return $this;
    }

    /**
     * @return \Fp\Saml\Config\Sp
     */
    public function getSpConfig()
    {
        return $this->spConfig;
    }

    /**
     * @param  \Fp\Saml\Config\Sp $spConfig
     * @return $this
     */
    public function setSpConfig($spConfig)
    {
        $this->spConfig = $spConfig;

        return $this;
    }

    /**
     * @return \Fp\Saml\Config\Idp
     */
    public function getIdpConfig()
    {
        return $this->idpConfig;
    }

    /**
     * @param  \Fp\Saml\Config\Idp $idpConfig
     * @return $this
     */
    public function setIdpConfig($idpConfig)
    {
        $this->idpConfig = $idpConfig;

        return $this;
    }

    /**
     * @return string
     */
    public function getNameIdFormat()
    {
        return $this->nameIdFormat;
    }

    /**
     * @param  string $nameIdFormat
     * @return $this
     */
    public function setNameIdFormat($nameIdFormat)
    {
        Assertion::notEmpty($nameIdFormat);
        $this->nameIdFormat = $nameIdFormat;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isForceRedirectToSignInPage()
    {
        return $this->forceRedirectToSignInPage;
    }

    /**
     * @param boolean $forceRedirectToSignInPage
     * @return $this
     */
    public function setForceRedirectToSignInPage($forceRedirectToSignInPage)
    {
        $this->forceRedirectToSignInPage = (bool)$forceRedirectToSignInPage;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getUrisIgnored(): array
    {
        return $this->urisIgnored;
    }

    /**
     * @param  string[]  $urisIgnored
     *
     * @return Config
     */
    public function setUrisIgnored(array $urisIgnored): Config
    {
        $this->urisIgnored = $urisIgnored;
        return $this;
    }
}
