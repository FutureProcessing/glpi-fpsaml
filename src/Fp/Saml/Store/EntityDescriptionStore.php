<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 31.12.14
 * Time: 13:46
 */

namespace Fp\Saml\Store;

use Fp\Saml\aServiceContainerAware;
use Fp\Saml\Helper;
use Gregwar\Cache\Cache;

class EntityDescriptionStore extends aServiceContainerAware
{
    /**
     * @var \Gregwar\Cache\Cache
     */
    private $cache;

    /**
     * @var \Fp\Saml\Config
     */
    private $config;

    public function __construct()
    {
        parent::__construct();

        $this->config = $this->serviceContainer->getConfig();

        if ($this->config->isEntityDescriptionCacheEnabled()) {
            $this->cache = new Cache($this->config->getCacheDir());
        }
    }

    /**
     * @param $url
     * @return \AerialShip\LightSaml\Model\Metadata\EntityDescriptor
     */
    public function get($url)
    {
        if ($this->config->isEntityDescriptionCacheEnabled()) {
            $obj = $this->cache->getOrCreate(
                $this->getCacheKey($url),
                array(
                    'max-age' => $this->config->getCacheLifetime(),
                ),
                function () use ($url) {
                    return $this->getSerializedEntityDescription($url);
                });

            return unserialize($obj);
        }

        return Helper::getEntityDescriptionFromXmlDocument($url);
    }

    /**
     * @param $url
     * @return string
     */
    private function getSerializedEntityDescription($url)
    {
        return serialize(
            Helper::getEntityDescriptionFromXmlDocument($url)
        );
    }

    /**
     * @param $url
     * @return string
     */
    private function getCacheKey($url)
    {
        return md5($url);
    }
}
