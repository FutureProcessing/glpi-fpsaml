<?php

namespace Fp\Saml;

interface iMetadataProvider
{
    /**
     * @return string
     */
    public function getXml();
}
