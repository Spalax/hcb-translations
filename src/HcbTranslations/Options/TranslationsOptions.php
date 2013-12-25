<?php
namespace HcbTranslations\Options;

use HcbTranslations\Options\Translations\Package;
use HcbTranslations\Options\Translations\Packages;
use Zend\Stdlib\AbstractOptions;

class TranslationsOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $langTemporaryPath = '';

    /**
     * @var string
     */
    protected $langTemporaryHttpPath = '';

    /**
     * @var Packages
     */
    protected $packages = null;

    /**
     * @param string $langTemporaryHttpPath
     */
    public function setLangTemporaryHttpPath($langTemporaryHttpPath)
    {
        $this->langTemporaryHttpPath = $langTemporaryHttpPath;
    }

    /**
     * @return string
     */
    public function getLangTemporaryHttpPath()
    {
        return $this->langTemporaryHttpPath;
    }

    /**
     * @param string $langTemporaryPath
     */
    public function setLangTemporaryPath($langTemporaryPath)
    {
        $this->langTemporaryPath = $langTemporaryPath;
    }

    /**
     * @return string
     */
    public function getLangTemporaryPath()
    {
        return $this->langTemporaryPath;
    }

    /**
     * @return array
     */
    public function getAvailableModules()
    {
        return $this->packages->getPackageNames();
    }

    /**
     * @param array $packageLangDirs
     * @throws Exception\InvalidArgumentException
     */
    public function setPackageLangDirs(array $packageLangDirs)
    {
        $this->packages = new Packages();
        foreach ($packageLangDirs as $module=>$package) {
            $this->packages->addPackage($module, new Package($package));
        }
    }

    /**
     * @return Packages
     */
    public function getPackages()
    {
        return $this->packages;
    }
}
