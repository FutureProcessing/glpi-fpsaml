<?php

namespace Fp\Saml\Store;

use Fp\Saml\Model\SsoState as SsoStateModel;

interface iSsoState
{
    /**
     * @param  SsoStateModel $state
     * @return void
     */
    public function save(SsoStateModel $state);

    /**
     * @return SsoStateModel|null
     */
    public function get();

    /**
     * @return void
     */
    public function destroy();
}
