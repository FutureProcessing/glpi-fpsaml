<?php

use Fp\Saml\Request\Authn;
use Fp\Saml\Request\LogoutSp;
use Fp\Saml\ServiceContainer;

$baseDir = dirname(__FILE__);

require_once($baseDir . '/../vendor/autoload.php');
require_once($baseDir . './../_bootstrap.php');


class  PluginFpsamlMain
{

    const SESSION_GLPI_NAME_ACCESSOR = 'glpiname';
    const SESSION_VALID_ID_ACCESSOR = 'valid_id';

    /**
     * @return bool
     */
    static function isUserAuthenticated()
    {
        if (version_compare(GLPI_VERSION, '0.85', 'lt') && version_compare(GLPI_VERSION, '0.84', 'gt')) {
            return isset($_SESSION[self::SESSION_GLPI_NAME_ACCESSOR]);
        } else {
            return isset($_SESSION[self::SESSION_GLPI_NAME_ACCESSOR])
            && isset($_SESSION[self::SESSION_VALID_ID_ACCESSOR])
            && $_SESSION[self::SESSION_VALID_ID_ACCESSOR] === session_id();
        }
    }

    static function getSsoState()
    {
        return ServiceContainer::getInstance()->getSsoStateStore()->get();
    }

   static function ssoRequest($relayState = null)
   {
      $request = new Authn();
      if ($relayState) {
         $request->getMessage()->getMessage()->setRelayState($relayState);
      }
      $request->send();

      exit;
   }

    static function sloRequest()
    {
        $request = new LogoutSp();
        $request->send();
    }

    static function tryLogin($relayState = null)
    {
        $auth = new PluginFpsamlAuth();
        $state = ServiceContainer::getInstance()->getSsoStateStore()->get();
        $auth->loadUserData($state->getNameId())
            ->checkUserData();

        Session::init($auth);

        ServiceContainer::getInstance()->getSsoStateStore()->save($state);

        self::redirectToMainPage($relayState);
    }

   static function redirectToMainPage($relayState = null)
   {
      global $CFG_GLPI;
      $redirect = self::getRedirect($relayState);
      $destination_url = $CFG_GLPI['url_base'];

      if (!isset($_SESSION["glpiactiveprofile"])) {
         header("Location: " . $destination_url . $redirect);

         exit;
      }

      if ($_SESSION['glpiactiveprofile']['interface'] == 'helpdesk') {
         if ($_SESSION['glpiactiveprofile']['create_ticket_on_login'] && empty($redirect)) {
            $destination_url .= $CFG_GLPI['root_doc'] . '/front/helpdesk.public.php?create_ticket=1';
         } else {
            $destination_url .= $CFG_GLPI['root_doc'] . '/front/helpdesk.public.php' . $redirect;
         }
      } else {
         if ($_SESSION['glpiactiveprofile']['create_ticket_on_login'] && empty($redirect)) {
            $destination_url .= $CFG_GLPI['root_doc'] . '/front/ticket.form.php';
         } else {
            $destination_url .= $CFG_GLPI['root_doc'] . '/front/central.php' . $redirect;
         }
      }

      header('Location: ' . $destination_url);

      exit;
   }

   private static function getRedirect($http_parameter = null): string
   {
      return empty($http_parameter) ? '' : '?redirect=' . rawurlencode($http_parameter);
   }

}
