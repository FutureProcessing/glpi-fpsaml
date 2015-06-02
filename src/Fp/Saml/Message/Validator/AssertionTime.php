<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 08:47
 */

namespace Fp\Saml\Message\Validator;

class AssertionTime extends aValidator
{
    /**
     * @throws \RuntimeException
     * @throws Exception
     * @return void
     */
    public function validate()
    {
        $assertions = $this->message->getAllAssertions();
        $assertion = reset($assertions);

        if ($assertion->getNotBefore() && $assertion->getNotBefore() > time() + 60) {
            throw new Exception('Received an assertion that is valid in the future. Check clock synchronization on IdP and SP');
        }
        if ($assertion->getNotOnOrAfter() && $assertion->getNotOnOrAfter() <= time() - 60) {
            throw new Exception('Received an assertion that has expired. Check clock synchronization on IdP and SP');
        }
    }
}
