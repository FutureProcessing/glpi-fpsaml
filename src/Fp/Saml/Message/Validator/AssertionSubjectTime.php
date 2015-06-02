<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 08:56
 */

namespace Fp\Saml\Message\Validator;

class AssertionSubjectTime extends aValidator
{
    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    public function validate()
    {
        $assertions = $this->message->getAllAssertions();
        $assertion = reset($assertions);

        $subjectConfirmations = $assertion->getSubject()->getSubjectConfirmations();

        if ($subjectConfirmations) {
            foreach ($subjectConfirmations as $subjectConfirmation) {
                if ($data = $subjectConfirmation->getData()) {
                    if ($data->getNotBefore() && $data->getNotBefore() > time() - 60) {
                        throw new Exception('Received an assertion with a session valid in future. Check clock synchronization on IdP and SP');
                    }
                    if ($data->getNotOnOrAfter() && $data->getNotOnOrAfter() <= time() + 60) {
                        throw new Exception('Received an assertion with a session that has expired. Check clock synchronization on IdP and SP');
                    }
                }
            }
        }
    }
}
