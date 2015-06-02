<?php

namespace Fp\Saml\Store;

use Fp\Saml\Model\SsoState;
use Fp\Saml\Model\SsoState as SsoStateModel;

class GlpiSsoState implements iSsoState
{
    const SSO_STATE_NAME_ID_FORMAT_ACCESSOR = '__SsoStateNameIdFormat__';
    const SSO_STATE_NAME_ID_ACCESSOR = '__SsoStateNameId__';
    const SSO_STATE_SESSION_ID_ACCESSOR = '__SsoStateSessionId__';
    const SSO_STATE_ATTRIBUTES_ACCESSOR = '__SsoStateAttributes__';

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param  \Fp\Saml\Model\SsoState $state
     * @return void
     */
    public function save(SsoStateModel $state)
    {
        $_SESSION[self::SSO_STATE_SESSION_ID_ACCESSOR] = $state->getSessionId();
        $_SESSION[self::SSO_STATE_NAME_ID_ACCESSOR] = $state->getNameId();
        $_SESSION[self::SSO_STATE_NAME_ID_FORMAT_ACCESSOR] = $state->getNameIdFormat();
        $_SESSION[self::SSO_STATE_ATTRIBUTES_ACCESSOR] = $state->getAttributes();
    }

    /**
     * Returns information about sso state if exist
     * @return SsoStateModel|null
     */
    public function get()
    {
        if (isset($_SESSION[self::SSO_STATE_SESSION_ID_ACCESSOR]) &&
            isset($_SESSION[self::SSO_STATE_NAME_ID_ACCESSOR]) &&
            isset($_SESSION[self::SSO_STATE_NAME_ID_FORMAT_ACCESSOR])
        ) {
            $state = new SsoState();
            $state->setNameIdFormat($_SESSION[self::SSO_STATE_NAME_ID_FORMAT_ACCESSOR]);
            $state->setNameId($_SESSION[self::SSO_STATE_NAME_ID_ACCESSOR]);
            $state->setSessionId($_SESSION[self::SSO_STATE_SESSION_ID_ACCESSOR]);
            $state->setAttributes($_SESSION[self::SSO_STATE_ATTRIBUTES_ACCESSOR]);

            return $state;
        }

        return;
    }

    /**
     * Clears session data
     * @return void
     */
    public function destroy()
    {
        unset($_SESSION[self::SSO_STATE_SESSION_ID_ACCESSOR]);
        unset($_SESSION[self::SSO_STATE_NAME_ID_ACCESSOR]);
        unset($_SESSION[self::SSO_STATE_NAME_ID_FORMAT_ACCESSOR]);
        unset($_SESSION[self::SSO_STATE_ATTRIBUTES_ACCESSOR]);
    }
}
