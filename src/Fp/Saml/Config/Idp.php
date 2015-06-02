<?php

namespace Fp\Saml\Config;

use AerialShip\LightSaml\Security\X509Certificate;
use Assert\Assertion;

class Idp
{
    /**
     * @var X509Certificate
     */
    private $idpCertificate;

    /**
     * @var string
     */
    private $idpMetadataUrl;

    /**
     * @var string
     */
    private $issuerUrl;

    /**
     * @return X509Certificate
     */
    public function getIdpCertificate()
    {
        return $this->idpCertificate;
    }

    /**
     * @param  string $idpCertificate
     * @return $this
     */
    public function setIdpCertificate($idpCertificate)
    {
        Assertion::notEmpty($idpCertificate);
        try {
            Assertion::file($idpCertificate);
            $idpCertificate = file_get_contents($idpCertificate);
        } catch (\Exception $e) {
        }

        $this->idpCertificate = new X509Certificate();
        $this->idpCertificate->loadPem($idpCertificate);

        return $this;
    }

    /**
     * @return string
     */
    public function getIdpMetadataUrl()
    {
        return $this->idpMetadataUrl;
    }

    /**
     * @param  string $idpMetadataUrl
     * @return $this
     */
    public function setIdpMetadataUrl($idpMetadataUrl)
    {
        Assertion::url($idpMetadataUrl);
        $this->idpMetadataUrl = $idpMetadataUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getIssuerUrl()
    {
        return $this->issuerUrl;
    }

    /**
     * @param string $issuerUrl
     *
     * return $this;
     */
    public function setIssuerUrl($issuerUrl)
    {
        Assertion::url($issuerUrl);
        $this->issuerUrl = $issuerUrl;
    }
}
