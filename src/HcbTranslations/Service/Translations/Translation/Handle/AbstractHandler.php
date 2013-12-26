<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Options\Module\Package;
use HcbTranslations\Options\ModuleOptions;

abstract class AbstractHandler
{
    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param ModuleOptions $options
     */
    public function __construct(ModuleOptions $options)
    {
        $this->options = $options;
    }

    /**
     * @param string $name
     * @return Package | null
     * @throws Exception\DomainException
     */
    protected function getModulePackage($name)
    {
        $packages = $this->options->getPackages();

        if (is_null($package = $packages->getPackage($name))) {
            throw new Exception\DomainException("Could not found module and its package");
        }

        return $package;
    }
}
