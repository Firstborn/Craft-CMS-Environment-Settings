# Environment Settings for [Craft CMS](https://craftcms.com/)

Craft CMS allows you to configure a lot of settings via config files. Unfortunately there are a few settings that can not, including email and asset settings.

The Environment Settings plugin allow you to create a config file that you can use to configure Email and Asset settings. This is especially useful for Asset sources like Amazon S3 that require keys and secrets. By using a config file you can set those values in Craft using server environment variables instead of needing to manually enter them into the CMS.  

## Installation
1. Move the `environmentsettings` directory into your `craft/plugins` directory.
2. Go to Settings &gt; Plugins in your Craft control panel and enable the `Environment Settings` plugin

## Use
Make a copy of the environmentsettings/config.php file, rename it to environmentsettings.php and store it in the craft/config directory.

It follows the standard Craft config setup, you can declare all the values under the wildcard '*' domain and/or declare config values for specific domains.

## Configurable settings
### Email
- emailAddress
- senderName
- template
- protocol
- host
- port
- smtpKeepAlive
- smtpAuth
- username
- password
- smtpSecureTransportType
- timeout

### Assets
The 'assetSources' value contains are array of named asset sources. The key/name for each asset source matches the corresponding asset source handle in Craft. **Note:**  the named source must exist in Craft for the config values to be applied. 
- name
- type
- path
- url
- keyId
- secret
- bucket
- location
- subfolder
- publicURLs
- urlPrefix
- expires

##### Credits
The entire dev team at [Firstborn](https://www.firstborn.com/)
