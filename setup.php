<?php

const PLUGIN_FPSAML_VERSION = '2.0.0';

/*
   ------------------------------------------------------------------------
   fpsaml - Sso SAML plugin
   Copyright (C) 2014 by Future Processing
   ------------------------------------------------------------------------

   LICENSE

   This file is part of fpsaml project.

   FP Basic Template Plugin is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   fpsaml is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with fpsaml. If not, see <http://www.gnu.org/licenses/>.

   ------------------------------------------------------------------------

   @package   fpsaml
   @author    Future Processing
   @co-author
   @copyright Copyright (c) 2014 by Future Processing
   @license   AGPL License 3.0 or (at your option) any later version
              http://www.gnu.org/licenses/agpl-3.0-standalone.html
   @since     2014

   ------------------------------------------------------------------------
 */

use Fp\Saml\ServiceContainer;

/**
 * Definition of the plugin version and its compatibility with the version of core
 *
 * @return array
 */
function plugin_version_fpsaml()
{
   return [
      'name' => 'FP SAML',
      'version' => PLUGIN_FPSAML_VERSION,
      'author' => '<a href="https://www.future-processing.com">Future Processing</a>',
      'license' => 'AGPLv3+',
      'homepage' => 'https://www.future-processing.com',
      'requirements' => [
         'glpi' => [
            'min' => '10.0',
            'max' => '10.1',
         ]
      ]
   ];
}

/**
 * Blocking a specific version of GLPI.
 * GLPI constantly evolving in terms of functions of the heart, it is advisable
 * to create a plugin blocking the current version, quite to modify the function
 * to a later version of GLPI. In this example, the plugin will be operational
 * with the 0.84 and 0.85 versions of GLPI.
 *
 * @return boolean
 */
function plugin_fpsaml_check_prerequisites()
{
    return true;
}

/**
 * Control of the configuration
 *
 * @param boolean $verbose
 * @return boolean
 */
function plugin_fpsaml_check_config($verbose = false)
{
    if (true) { // Your configuration check
        return true;
    }

    if ($verbose) {
        echo 'Installed / not configured';
    }

    return false;
}

/**
 * Initialization of the plugin
 *
 * @global array $PLUGIN_HOOKS
 */
function plugin_init_fpsaml()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['post_init']['fpsaml'] = 'plugin_post_init_fpsaml';
    $PLUGIN_HOOKS['csrf_compliant']['fpsaml'] = true;
}

function plugin_post_init_fpsaml()
{
    global $CFG_GLPI;

    if (php_sapi_name() === 'cli') {
        return;
    }

    $pluginBaseUrl = '/plugins/fpsaml/front/';

    if (strpos($_SERVER['PHP_SELF'], $pluginBaseUrl) !== false) {
        return;
    }

    $isAuth = PluginFpsamlMain::isUserAuthenticated();

    foreach (ServiceContainer::getInstance()->getConfig()->getUrisIgnored() as $uri) {
        if (strpos($_SERVER['PHP_SELF'], $uri) !== false) {
            return;
        }
    }

    if (!$isAuth) {
        if (ServiceContainer::getInstance()->getSsoStateStore()->get()) {
            PluginFpsamlMain::tryLogin(isset($_GET['redirect']) ? $_GET['redirect'] : null);
        } else {
            if (ServiceContainer::getInstance()->getConfig()->isForceRedirectToSignInPage()) {
                $redirectUrl = $_SERVER['REQUEST_URI'] !== '/' ? $CFG_GLPI['url_base'] . $_SERVER['REQUEST_URI'] : null;
                PluginFpsamlMain::ssoRequest($redirectUrl);
            }
        }
    } else {
        if (strpos($_SERVER['PHP_SELF'], '/logout.php') !== false && ServiceContainer::getInstance()->getSsoStateStore()->get()) {
            PluginFpsamlMain::sloRequest();
        } elseif ($_SERVER['REQUEST_URI'] === '/') {
            PluginFpsamlMain::redirectToMainPage();
        }
    }
}
