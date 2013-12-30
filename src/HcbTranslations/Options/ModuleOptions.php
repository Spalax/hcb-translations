<?php
namespace HcbTranslations\Options;

use HcbTranslations\Options\Module\Package;
use HcbTranslations\Options\Module\Packages;
use HcBackend\Options\Exception;
use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
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
     * @throws Exception\InvalidArgumentException
     */
    public function setLangTemporaryHttpPath($langTemporaryHttpPath)
    {
        if (empty($langTemporaryHttpPath)) {
                throw new Exception\InvalidArgumentException("Translations lang_temporary_path must be defined");
        }

        $this->langTemporaryHttpPath = $langTemporaryHttpPath;
    }

    /**
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    public function getLangTemporaryHttpPath()
    {
        if (empty($this->langTemporaryPath)) {
            throw new Exception\InvalidArgumentException("Translations lang_temporary_http_path must be defined and must be readable");
        }
        return $this->langTemporaryHttpPath;
    }

    /**
     * @param string $langTemporaryPath
     * @throws Exception\InvalidArgumentException
     */
    public function setLangTemporaryPath($langTemporaryPath)
    {
        if (empty($langTemporaryPath) || !is_dir($langTemporaryPath) || !is_writable($langTemporaryPath)) {
            throw new Exception\InvalidArgumentException("Translations lang_temporary_path must be existing writable directory");
        }

        $this->langTemporaryPath = $langTemporaryPath;
    }

    /**
     * @return string
     * @throws Exception\InvalidArgumentException
     */
    public function getLangTemporaryPath()
    {
        if (empty($this->langTemporaryPath)) {
            throw new Exception\InvalidArgumentException("Translations lang_temporary_path must be defined");
        }
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
