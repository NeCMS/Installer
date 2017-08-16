<?php
/**
 * Created by PhpStorm.
 * User: WarfaceZ | Jan Galek
 * Date: 16.08.2017
 * Time: 21:12
 */

namespace NeCMS\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class TemplateInstallerPlugin implements PluginInterface
{

	/**
	 * Apply plugin modifications to Composer
	 *
	 * @param Composer $composer
	 * @param IOInterface $io
	 */
	public function activate(Composer $composer, IOInterface $io)
	{
		$installer = new TemplateInstaller($io, $composer);
		$composer->getInstallationManager()->addInstaller($installer);
	}
}