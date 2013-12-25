<?php
namespace HcbTranslations\Options\Translations;

use HcBackend\Options\Exception;

class Packages
{
    /**
     * @var array
     */
    protected $packages;

    /**
     * @param string $name
     * @param Package $package
     * @throws \HcbTranslations\Options\Exception\InvalidArgumentException
     */
    public function addPackage($name, Package $package)
    {
        if (!is_string($name)) {
            throw new Exception\InvalidArgumentException('Package name must be a key and it is must be a string');
        }

        $this->packages[strtolower($name)] = $package;
    }

    /**
     * @return array
     */
    public function getPackageNames()
    {
        return array_keys($this->packages);
    }

    /**
     * @param string $name
     * @return null | Package
     */
    public function getPackage($name)
    {
        if (!array_key_exists(strtolower($name), $this->packages)) {
            return null;
        }
        return $this->packages[strtolower($name)];
    }
}
