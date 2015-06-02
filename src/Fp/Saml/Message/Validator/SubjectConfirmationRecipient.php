<?php
/**
 * Created by PhpStorm.
 * User: artur_000
 * Date: 08.01.15
 * Time: 10:00
 */

namespace Fp\Saml\Message\Validator;

class SubjectConfirmationRecipient extends aValidator
{
    /**
     * @return void
     * @throws \Fp\Saml\Message\Validator\Exception
     */
    public function validate()
    {
        $acsUrl = $this->getContainer()->getConfig()->getSpConfig()->getSpAssertionConsumerUrl();
        $assertions = $this->message->getAllAssertions();
        $assertion = reset($assertions);

        foreach ($assertion->getSubject()->getSubjectConfirmations() as $subjectConfirmation) {
            if ($acsUrl !== $subjectConfirmation->getData()->getRecipient()) {
                throw new Exception(
                    sprintf('Invalid Assertion SubjectConfirmation Recipient %s',
                        $subjectConfirmation->getData()->getRecipient()
                    )
                );
            }
        }
    }
}
