<?php

/*
   ------------------------------------------------------------------------
   fpsaml - Basic Template Plugin
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

/**
 * It is in these functions that you need to put your SQL queries used for creating your specific tables.
 *
 * Here, you can now see your plugin in the list of plugins.
 *
 * @return boolean Needs to return true if success
 */

function plugin_fpsaml_install() {

	return true;
}

/**
 * Because we've created a table, do not forget to destroy if the plugin is uninstalled.
 *
 * @return boolean Needs to return true if success
 */
function plugin_fpsaml_uninstall() {

	return true;
}
