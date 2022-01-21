# glpi-fpsaml
GLPI plugin that allows you to use SAML to authenticate and authorize users.
## Requirements
* GLPI 0.85.x, 0.90.x, up to 9.5.x
* php >= 5.4
* composer

## Installation instruction:

1. Clone project into GLPI plugins directory
2. Rename the plugin directory name from glpi-fpsaml to fpsaml
3. Enter into plugin directory and run composer install
4. Copy `cfg.tpl.php` and rename it to `cfg.php`

## Plugin configuration:

1. Edit cfg.php file, each parameter is described in file comments
2. To configure plugin you need:
    * certificate, that is used to sign SAML messages returned by ADFS
    * certificate and private key for singing SAML requests
    * directory for caching ADFS metadata information

## ADFS configuration
* sample tutorial about how to configure ADFS for SAML 2.0 could be find here: https://docs.microsoft.com/pl-pl/powerapps/maker/portals/configure/configure-saml2-settings
* ensure that in **Transform an Incoming Claim** rule **Incoming claim type** points to the property that corresponds with GLPI username
