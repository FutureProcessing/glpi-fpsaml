<?php

require_once('./../vendor/autoload.php');
require_once('./../_bootstrap.php');

PluginFpsamlMain::ssoRequest($_GET['redirect']);
