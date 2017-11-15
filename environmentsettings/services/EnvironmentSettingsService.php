<?php

namespace Craft;

use \PDO;
use \Exception;

class EnvironmentSettingsService extends BaseApplicationComponent
{
	private $dbh = null;

	/**
	 * Override CMS Settings
	 */
	public function overrideSettings()
	{
		$this->updateAssetSourceSettings();
		$this->updateEmailSettings();
	}

	/**
	 * Update Asset Source Settings
	 */
	private function updateAssetSourceSettings()
	{
		try {
			// look for both 'assetSource' and 'assetSources'
			$assetSourceConfig = $this->getConfig('assetSource');

			if (array_key_exists('handle', $assetSourceConfig)) {
				$handle = $assetSourceConfig['handle'];
			} else {
				throw new Exception('Asset source handle missing from environmentsettings.php');
			}
			$this->updateAssetSource($handle, $assetSourceConfig);

            $assetSourcesConfig = $this->getConfig('assetSources');
            foreach($assetSourcesConfig as $key => $assetSourceConfig){
                $this->updateAssetSource($key, $assetSourceConfig);
            }
		} catch (Exception $e) {
			EnvironmentSettingsPlugin::log($e->getMessage(), LogLevel::Error);
		}
	}

	private function updateAssetSource($handle, $config) {
    // get settings from db
        $source = $this->getAssetSourceByHandle($handle);
        if ($source) {

            $source->name = $config['name'];
            $source->type = $config['type'];
            $settings = array_merge($source->settings, $config);
            $source->settings = $settings;

            if (craft()->assetSources->saveSource($source)){

            } else {
                EnvironmentSettingsPlugin::log(json_encode($source->getErrors()), LogLevel::Error);
                EnvironmentSettingsPlugin::log(json_encode($source->getSettingErrors()), LogLevel::Error);
                throw new Exception('Could not update asset source handle ' . $handle);
            }
        } else {
            throw new Exception('Could not find asset source handle ' . $handle);
        }
    }

	/**
	 * Update Email Settings
	 */
	private function updateEmailSettings()
	{
		try {
            $settings = craft()->systemSettings->getSettings('email');
            $settings = array_merge($settings, $this->getConfig('email'));

            if (craft()->systemSettings->saveSettings('email', $settings)){

            } else {
                EnvironmentSettingsPlugin::log(json_encode($settings->getErrors()), LogLevel::Error);
                throw new Exception('Could not update email settings');
            }
 		} catch (Exception $e) {
			EnvironmentSettingsPlugin::log($e->getMessage(), LogLevel::Error);
		}
	}

	/**
	 * @param $item
	 * @return null
	 * @throws Exception
	 */
	private function getConfig($item)
	{
		$item = craft()->config->get($item, 'environmentsettings');

		if (empty($item)) {
			throw new Exception('Could not find config item: ' . $item);
		}

		return $item;
	}

    private function getAssetSourceByHandle($handle)
    {
        $sources = craft()->assetSources->getAllSources();
        foreach($sources as $source)
        {
            if ($source->handle == $handle)
            {
                return $source;
            }
        }
        return false;
    }
}