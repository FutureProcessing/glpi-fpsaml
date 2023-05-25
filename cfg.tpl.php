<?php

require_once __DIR__.'/vendor/autoload.php';

return array(
    /**
     * @var string identity provider metadata url
     * i.e. https://adfs.domain.com/FederationMetadata/2007-06/FederationMetadata.xml
     */
    'idpMetadataUrl'                 => '',

    /**
     * @var string issuer url
     *
     */
    'issuerUrl' => '',

    /**
     * @var string absolute path to service provider certificate (local)
     */
    'spCertificate'                     => __DIR__.'/cert/domain.com.crt',

    /**
     * @var string absolute path to service provider private key (local)
     */
    'spPrivateKey'                      => __DIR__.'/cert/domain.com.pem',

    /**
     * @var string absolute path to identity provider certificate (remote)
     */
    'idpCertificate'                    => __DIR__.'/cert/remote.crt',

    /**
     * @var string
     */
    'nameIdFormat'                      => 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',

    /**
     * @var boolean indicates if cache for entity descriptions should be enabled (recommended)
     */
    'entityDescriptionCache'            => true,

    /**
     * @var int cache lifetime in seconds
     */
    'entityDescriptionCacheLifetime' => 7200,

    /**
     * @var string absolute path to cache directory (make sure that www daemon has permissions to write in this directory)
     */
    'entityDescriptionCacheDir'         => __DIR__.'/.cache',

    /**
     * @var boolean indicates if user that is unauthenticated should be automatically redirect to ADFS sign-in page
     */
    'forceRedirectToSignInPage'         => false,

    /**
     * @var string[] a list of URIs for which this plugin should be disabled for; use without domain part; checks are greedy
     */
    'urisIgnored' => ['apirest.php'],
);
