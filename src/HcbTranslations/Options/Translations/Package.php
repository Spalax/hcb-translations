<?php
namespace HcbTranslations\Options\Translations;

use HcBackend\Options\Exception;

class Package
{
    /**
     * @var array
     */
    protected $package;

    /**
     * @param array $package
     * @throws \HcbTranslations\Options\Exception\DomainException
     * @throws \HcbTranslations\Options\Exception\InvalidArgumentException
     */
    public function __construct(array $package)
    {
        if (!array_key_exists('gettext', $package) || !array_key_exists('js', $package)) {
            throw new Exception\InvalidArgumentException('Package must contains js and gettext keys');
        }

        if (!array_key_exists('mo', $package['gettext'])) {
            $package['gettext']['mo'] = '%s.mo';
        }

        if (!is_dir($package['js']) || !is_writable($package['js'])) {
            throw new Exception\DomainException("Directory ".$package['js']." must be writable directory");
        }

        if (!array_key_exists('path', $package['gettext'])) {
            throw new Exception\DomainException("Path key must be in gettext array");
        }

        if (!is_dir($package['gettext']['path']) || !is_writable($package['gettext']['path'])) {
            throw new Exception\DomainException("Directory ".$package['gettext']['path']." must be writable directory");
        }

        if (!array_key_exists('pot', $package['gettext']) ||
            !is_readable($package['gettext']['pot'])) {
            throw new Exception\DomainException("POT file must be defined for gettext in current package");
        }

        $this->package = $package;
    }

    /**
     * @return string
     */
    public function getPOTFilePath()
    {
        return $this->package['gettext']['pot'];
    }

    /**
     * @return string
     */
    public function getMoPattern()
    {
        return $this->package['gettext']['mo'];
    }

    /**
     * @return string
     */
    public function getPathToJsLangDir()
    {
        return $this->package['js'];
    }

    /**
     * @return string
     */
    public function getJsTemplateFilePath()
    {
        return sprintf('%s/dojo_ROOT.js.uncompressed.js', $this->package['js']);
    }

    /**
     * @param string $langCode
     * @return string
     */
    public function getJsFilePath($langCode)
    {
        return sprintf('%s/dojo_%s.js', $this->package['js'], $langCode);
    }

    /**
     * @param string $langCode
     * @return string
     */
    public function getPoFilePath($langCode)
    {
        return sprintf('%s/%s.po', $this->package['gettext']['path'], $langCode);
    }

    /**
     * @param string $langCode
     * @return string
     */
    public function getMoFilePath($langCode)
    {
        return sprintf('%s/'.$this->getMoPattern(),
                       $this->package['gettext']['path'], $langCode);
    }

    /**
     * @return string
     */
    public function getPathToGettextLangDir()
    {
        return $this->package['gettext']['path'];
    }
}
