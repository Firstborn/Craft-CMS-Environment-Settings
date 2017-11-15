<?php

return array(

	'*' => array(
		'email' => array(
			'emailAddress' => null,		// System Email Address
			'senderName' => null,		// Sender Name
			'template' => null,			// HTML Email Template
			'protocol' => null,			// Protocol
			'host' => null,				// Host Name
			'port' => null,				// Port
			'smtpKeepAlive' => null,	// Use SMTP Keep Alive
			'smtpAuth' => null,			// Use SMTP authentication
			'username' => null,			// Username
			'password' => null,			// Password
			'smtpSecureTransportType' => null,	// SMTP Secure Transport Type
			'timeout' => null,			// Timeout
		),

        'assetSources' => array(
            'handle' =>  array(         // Asset source handle
                'name' => null,			// Name
                'type' => null,			// Type: S3, GoogleCloud, Local, Rackspace
                'path' => null,			// Local Folder: File System Path
                'url' => null,			// Local Folder: URL
                'keyId' => null,		// AWS: Access Key ID
                'secret' => null,		// AWS: Secret Access Key
                'bucket' => null,		// AWS: Bucket
                'location' => 'US',		// AWS: Location (unsure what this is, but it's mandatory for AWS type)
                'subfolder' => null,	// Subfolder
                'publicURLs' => null,	// Assets in this source have public URLs (enter "1" for yes, "0" for no)
                'urlPrefix' => null,	// URL Prefix (mandatory)
                'expires' => null,		// Cache Duration, e.g. "1years"
            )
        )
	)

);
