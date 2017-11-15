<?php

/**
 * Environment Settings plugin for Craft CMS
 *
 * Override CMS settings with configuration files.
 *
 * @author    Ziad Hilal
 * @copyright Copyright (c) 2017 Firstborn
 * @link      https://www.firstborn.com
 * @package   EnvironmentSettings
 * @since     1.0.0
 */

namespace Craft;

class EnvironmentSettingsPlugin extends BasePlugin
{

	/**
	 * @return string
	 */
	public function getName()
	{
		return "Environment Settings";
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return "Override CMS settings with configuration files.";
	}

	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return "Firstborn";
	}

	/**
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'https://www.firstborn.com';
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '1.0.1';
	}

	/**
	 * @return bool
	 */
	public function hasCpSection()
	{
		return false;
	}

	/**
	 * Override Craft CMS Settings with Config values
	 */
	function init()
	{
		if (craft()->request->isCpRequest() && craft()->userSession->isLoggedIn()) {

		    //add warning message
            $pattern = '@admin\/settings\/(email|assets\/sources)@i';
            if (preg_match($pattern, craft()->request->getUrl()))
            {
                craft()->templates->includeJsResource('environmentsettings/js/EnvironmentSettingsWarning.js');
                craft()->templates->includeJs("new Craft.EnvironmentSettingsWarning();");
            }
		}
		craft()->environmentSettings->overrideSettings();
	}

}
