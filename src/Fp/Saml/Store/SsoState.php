<?php

namespace Fp\Saml\Store;

use Fp\Saml\Model\SsoState as SsoStateModel;

class SsoState implements iSsoState
{
    const SSO_STATE_ACCESSOR = '__SsoState__';

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
        $_SESSION[self::SSO_STATE_ACCESSOR] = $state;
    }

    /**
     * @return SsoStateModel|null
     */
    public function get()
    {
        return isset($_SESSION[self::SSO_STATE_ACCESSOR]) ? $_SESSION[self::SSO_STATE_ACCESSOR] : null;
    }

    /**
     * @return void
     */
    public function destroy()
    {
        unset($_SESSION[self::SSO_STATE_ACCESSOR]);
    }
}
