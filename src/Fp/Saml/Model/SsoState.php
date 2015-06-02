<?php

namespace Fp\Saml\Model;

class SsoState implements \Serializable
{
    private $sessionId;
    private $nameId;
    private $nameIdFormat;
    private $attributes;

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param  mixed $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameId()
    {
        return $this->nameId;
    }

    /**
     * @param  mixed $nameId
     * @return $this
     */
    public function setNameId($nameId)
    {
        $this->nameId = $nameId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNameIdFormat()
    {
        return $this->nameIdFormat;
    }

    /**
     * @param  mixed $nameIdFormat
     * @return $this
     */
    public function setNameIdFormat($nameIdFormat)
    {
        $this->nameIdFormat = $nameIdFormat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param  mixed $sessionId
     * @return $this
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(
            array(
                $this->sessionId,
                $this->nameId,
                $this->nameIdFormat,
                $this->attributes,
            )
        );
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param  string $serialized <p>
     *                            The string representation of the object.
     *                            </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list(
            $this->sessionId,
            $this->nameId,
            $this->nameIdFormat,
            $this->attributes,
            ) = unserialize($serialized);
    }
}
