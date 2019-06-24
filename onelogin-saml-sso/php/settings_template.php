<?php

$sp_entity_id = 'your:sp:urn';
$idp_x509_cert = 'your_idp_x509_cert';
$sp_x509_cert = 'your_sp_x509_cert';
$sp_private_key = 'your_sp_private_key';

$settings = array (

    'strict' => $opt['strict'] == 'on'? true : false,
    'debug' => $opt['debug'] == 'on'? true : false,

    'sp' => array (
        'entityId' => $sp_entity_id,
        'assertionConsumerService' => array (
            'url' => $acs_endpoint
        ),
        'singleLogoutService' => array (
            'url' => get_site_url().'/wp-login.php?saml_sls'
        ),
        'NameIDFormat' => $opt['NameIDFormat'],
        'x509cert' => $sp_x509_cert,
        'privateKey' => $sp_private_key,
    ),

    'idp' => array (
        'entityId' => get_option('onelogin_saml_idp_entityid'),
        'singleSignOnService' => array (
            'url' => get_option('onelogin_saml_idp_sso'),
        ),
        'singleLogoutService' => array (
            'url' => get_option('onelogin_saml_idp_slo'),
        ),
        'x509cert' => $idp_x509_cert,
    ),

    'security' => array (
        'signMetadata' => false,
        'nameIdEncrypted' => $opt['nameIdEncrypted'] == 'on'? true: false,
        'authnRequestsSigned' => $opt['authnRequestsSigned'] == 'on'? true: false,
        'logoutRequestSigned' => $opt['logoutRequestSigned'] == 'on'? true: false,
        'logoutResponseSigned' => $opt['logoutResponseSigned'] == 'on'? true: false,
        'wantMessagesSigned' => $opt['wantMessagesSigned'] == 'on'? true: false,
        'wantAssertionsSigned' => $opt['wantAssertionsSigned'] == 'on'? true: false,
        'wantAssertionsEncrypted' => $opt['wantAssertionsEncrypted'] == 'on'? true: false,
        'wantNameId' => false,
        'requestedAuthnContext' => $opt['requestedAuthnContext'],
        'relaxDestinationValidation' => true,
        'lowercaseUrlencoding' => get_option('
            onelogin_saml_advanced_idp_lowercase_url_encoding', false),
        'signatureAlgorithm' => get_option('onelogin_saml_advanced_signaturealgorithm', 'http://www.w3.org/2000/09/xmldsig#rsa-sha1'),
        'digestAlgorithm' => get_option('onelogin_saml_advanced_digestalgorithm', 'http://www.w3.org/2000/09/xmldsig#sha1'),
    )
);
