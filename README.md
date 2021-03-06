# wordpress-onelogin. OneLogin SAML plugin for Wordpress. #

Uses the new Onelogin PHP-SAML Toolkit. Review its [dependences](https://github.com/onelogin/php-saml#dependences)

In order to install it, move the onelogin-saml-sso inside the wp-content/plugins folder.
Once moved, activate the plugin and configure it.

### Using the SAML Plugin with multiple identity providers

To use multiple identity providers, first specify the IdP values you wish to check for at line 15 of the `functions.php` file. For example:

```define("IDENTITY_PROVIDERS", ["idp1", "idp2"]);```

Then for each IdP value you have set, create a file named `settings_<IdP value>.php` by duplicating `settings_template.php` and renaming the file. Eg: `settings_idp1.php`

In your newly created `settings_<IdP value>.php` file, each SAML configuration variable can be explicitly set. The provided settings file template defaults to taking the values provided through the administrator interface (besides those listed below), however it is recommended that you define all configuration options within each setting file to avoid implicitly loading configuration options that were unintentionally defined within the administrator interface. The following are the settings that should be provided, and can be edited at the top of the file:
-   `$sp_entity_id` - Service provider entity ID,
-   `$idp_x509_cert` - IdP x509 certificate,
-   `$sp_x509_cert` - Service provider x509 certificate, and
-   `$sp_private_key` - Private key.

Finally, in your app when you link to your SAML login service, pass your IdP value in as an argument. For example:

```
<a href="' . network_site_url() . '/wp-login.php?saml_sso&idp=idp1&returnTo=' . home_url(add_query_arg(array(), $wp->request)) . '">Login</a>
```

### Using the SAML Plugin with accepted user roles

You may restrict user authentication to only accepted user roles by specifying the accepted roles at line 16 of the `functions.php` file. For example:

```
define("ACCEPTED ROLES, ["administrator", "author", "editor"]);
```

You may then store use these roles within your WordPress application as options by specifying options keys at line 17 and 18 of the `functions.php` file. For Example:

```
define("ROLE_GROUP_OPTIONS_NAME", "custom_authenticated_user_roles");
define("ROLE_GROUP_META_KEY", "custom_authenticated_user_role");
```

### Using the SAML Plugin in WPengine or similar ###

This kind of WP hosting used to cache plugins and protect the wp-login.php view.
You will need to contact them in order to disable the cache for this SAML plugin and also allow external HTTP POST to
wp-login.php

### Security Improvements on 3.0.0 ###

Version 3.0.0 includes a security patch that will prevent DDOS by expansion of internally defined entities (XEE)
That version also includes the use of php-saml 3.X so will be compatible with PHP 5.X and 7.X

### Security Improvements on 2.4.3 ###

Version 2.4.3 includes a security patch that contains extra validations that will prevent some kind of elaborated signature wrapping attacks and other security improvements. Previous versions are vulnerable so we highly recommended to upgrade to >= 2.4.3.


### If you used this plugin before 2.2.0 with just-in-time provision active ###
Read: https://wpvulndb.com/vulnerabilities/8508

To mitigate that, place the script at the root of WordPress and execute it (later remove it)
https://gist.github.com/pitbulk/a8223c90a3534e9a7d5e0a93009a094f
