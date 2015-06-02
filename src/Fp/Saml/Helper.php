<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 30.12.14
 * Time: 07:50
 */

namespace Fp\Saml;

use AerialShip\LightSaml\Model\Metadata\EntityDescriptor;

class Helper
{
    /**
     * @param $xmlUrl
     * @return EntityDescriptor
     */
    public static function getEntityDescriptionFromXmlDocument($xmlUrl)
    {
        $doc = new \DOMDocument();
        $doc->load($xmlUrl);

        $entityDescriptor = new EntityDescriptor();
        $entityDescriptor->loadFromXml($doc->firstChild);

        return $entityDescriptor;
    }
}
