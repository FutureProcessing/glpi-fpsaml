<?php

use Fp\Saml\Response;
use Fp\Saml\Sp\MetadataProvider;

require_once('./../vendor/autoload.php');
require_once('./../_bootstrap.php');

header('Content-type: application/xml; charset="utf-8"');

$metadata = new MetadataProvider();
echo $metadata->getXml();
