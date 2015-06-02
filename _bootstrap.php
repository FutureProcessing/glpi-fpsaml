<?php

if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', '../../..');
}

require_once(__DIR__ . '/vendor/autoload.php');
require_once(GLPI_ROOT . "/inc/autoload.function.php");
require_once(GLPI_ROOT . "/inc/db.function.php");
require_once(GLPI_ROOT . "/config/config.php");

$baseUrl = $CFG_GLPI['url_base'] . '/plugins/fpsaml/front/';

use Fp\Saml\Config\Idp;
use Fp\Saml\Config\Sp;
use Fp\Saml\Config;
use Fp\Saml\ServiceContainer;
use Fp\Saml\Store\RequestStateStore;
use Fp\Saml\Store\GlpiSsoState;

$config = require_once __DIR__ . '/cfg.php';

$idpConfig = new Idp();
$idpConfig->setIdpCertificate($config['idpCertificate'])
    ->setIdpMetadataUrl($config['idpMetadataUrl'])
    ->setIssuerUrl($config['issuerUrl']);

$spConfig = new Sp();
$spConfig->setSpCertificate($config['spCertificate'])
    ->setSpPrivateKey($config['spPrivateKey'])
    ->setSpMetadataUrl($baseUrl . 'meta.php')
    ->setSpSingleLogoutUrl($baseUrl . 'slo.php')
    ->setSpAssertionConsumerUrl($baseUrl . 'acs.php');

$serviceConfiguration = new Config();
$serviceConfiguration->setSpConfig($spConfig)
    ->setEntityDescriptionCacheEnabled($config['entityDescriptionCache'])
    ->setCacheDir($config['entityDescriptionCacheDir'])
    ->setCacheLifetime($config['entityDescriptionCacheLifetime'])
    ->setNameIdFormat($config['nameIdFormat'])
    ->setForceRedirectToSignInPage($config['forceRedirectToSignInPage'])
    ->setIdpConfig($idpConfig);

$serviceContainer = ServiceContainer::getInstance();
$serviceContainer->setConfig($serviceConfiguration)
    ->setSsoStateStore(new GlpiSsoState())
    ->setRequestStateStore(new RequestStateStore());
