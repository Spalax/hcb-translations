<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Options\Translations\Package;
use HcbTranslations\Options\TranslationsOptions;

abstract class AbstractHandler
{
    /**
     * @var TranslationsOptions
     */
    protected $options;

    /**
     * @param TranslationsOptions $options
     */
    public function __construct(TranslationsOptions $options)
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
