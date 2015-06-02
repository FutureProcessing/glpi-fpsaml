<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 02.01.15
 * Time: 15:05
 */

namespace Fp\Saml\Message\Validator;

class Issuer extends  aValidator
{
    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    public function validate()
    {
        if ($this->message->getIssuer() !==  $this->getContainer()->getConfig()->getIdpConfig()->getIssuerUrl()) {
            throw new Exception('Returned requestMessage has invalid issuer: "' . $this->message->getIssuer() . '"');
        }
    }
}
