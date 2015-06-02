<?php

namespace Fp\Saml\Config;

use AerialShip\LightSaml\Security\KeyHelper;
use AerialShip\LightSaml\Security\X509Certificate;
use Assert\Assertion;

class Sp
{
    /**
     * @var string
     */
    private $spMetadataUrl;
    /**
     * @var X509Certificate
     */
    private $spCertificate;
    /**
     * @var \XMLSecurityKey
     */
    private $spPrivateKey;
    /**
     * @var string
     */
    private $spSingleLogoutUrl;
    /**
     * @var string
     */
    private $spAssertionConsumerUrl;

    /**
     * @return string
     */
    public function getSpSingleLogoutUrl()
    {
        return $this->spSingleLogoutUrl;
    }

    /**
     * @param  string $spSingleLogoutUrl
     * @return $this
     */
    public function setSpSingleLogoutUrl($spSingleLogoutUrl)
    {
        Assertion::url($spSingleLogoutUrl);
        $this->spSingleLogoutUrl = $spSingleLogoutUrl;

        return $this;
    }

    /**
     * @return X509Certificate
     */
    public function getSpCertificate()
    {
        return $this->spCertificate;
    }

    /**
     * @param  string $spCertificate
     * @return $this
     */
    public function setSpCertificate($spCertificate)
    {
        Assertion::notEmpty($spCertificate);

        try {
            Assertion::file($spCertificate);
            $spCertificate = file_get_contents($spCertificate);
        } catch (\Exception $e) {
        }

        $this->spCertificate = new X509Certificate();
        $this->spCertificate->loadPem($spCertificate);

        return $this;
    }

    /**
     * @return string
     */
    public function getSpMetadataUrl()
    {
        return $this->spMetadataUrl;
    }

    /**
     * @param  string $spMetadataUrl
     * @return $this
     */
    public function setSpMetadataUrl($spMetadataUrl)
    {
        Assertion::url($spMetadataUrl);
        $this->spMetadataUrl = $spMetadataUrl;

        return $this;
    }

    /**
     * @return \XMLSecurityKey
     */
    public function getSpPrivateKey()
    {
        return $this->spPrivateKey;
    }

    /**
     * @param $spPrivateKey
     * @param  string $passphrase
     * @return $this
     */
    public function setSpPrivateKey($spPrivateKey, $passphrase = null)
    {
        Assertion::notEmpty($spPrivateKey);

        try {
            Assertion::file($spPrivateKey);
            $spPrivateKey = file_get_contents($spPrivateKey);
        } catch (\Exception $e) {
        }

        $this->spPrivateKey = KeyHelper::createPrivateKey($spPrivateKey, $passphrase, false);

        return $this;
    }

    /**
     * @return string
     */
    public function getSpAssertionConsumerUrl()
    {
        return $this->spAssertionConsumerUrl;
    }

    /**
     * @param  string $spAssertionConsumerUrl
     * @return $this
     */
    public function setSpAssertionConsumerUrl($spAssertionConsumerUrl)
    {
        Assertion::url($spAssertionConsumerUrl);
        $this->spAssertionConsumerUrl = $spAssertionConsumerUrl;

        return $this;
    }
}
