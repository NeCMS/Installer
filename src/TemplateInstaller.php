<?php
/**
 * Created by PhpStorm.
 * User: WarfaceZ
 * Date: 16.08.2017
 * Time: 21:20
 */

namespace NeCMS\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class TemplateInstaller extends LibraryInstaller
{
	/**
	 * {@inheritdoc}
	 */
	public function getInstallPath(PackageInterface $package)
	{
		$prefix = substr($package->getPrettyName(), 0, 23);

		if ('necms-template-' !== $prefix) {
			throw new \InvalidArgumentException(
				'Unable to install template, NeCMS templates '
				.'should always start their package name with '
				.'"necms/template-"'
			);
		}
		return 'app/templates/' . substr($package->getPrettyName(), 23);
	}


	/**
	 * {@inheritdoc}
	 */
	public function supports($packageType)
	{
		switch ($packageType) {
			case 'necms-template':
				return true;
				break;
			default:
				return false;
				break;
		}
	}

}