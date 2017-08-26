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
use Composer\Repository\InstalledRepositoryInterface;

class TemplateInstaller extends LibraryInstaller
{
	const REGULAR_TEMPLATE = '(.*)/template-(.*)';

	/**
	 * {@inheritdoc}
	 */
	public function getInstallPath(PackageInterface $package)
	{
		if ($prefix = preg_match(self::REGULAR_TEMPLATE, $package->getPrettyName())) {
			return 'app/templates/' . preg_replace(self::REGULAR_TEMPLATE, "$2", $package->getPrettyName());
		} else {
			throw new \InvalidArgumentException(
				'Unable to install NeCMS plugin.';
			);
		}

		/*$prefix = substr($package->getPrettyName(), 0, 15);

		if ('necms/template-' !== $prefix) {
			throw new \InvalidArgumentException(
				'Unable to install template, NeCMS templates '
				.'should always start their package name with '
				.'"necms/template-"'
			);
		}
		return 'app/templates/' . substr($package->getPrettyName(), 15);
		*/
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


	/**
	 * @inheritdoc
	 */
	public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
	{
		parent::install($repo, $package);
		$path = $this->getInstallPath($package);

		if (is_dir($path . '/js')) {
			copy($path . '/js', $this->getInstallPath($package) . '/js');
		}
	}

}