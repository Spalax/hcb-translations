<?php
namespace HcbTranslations\Data\Translations;

use HcbTranslations\Data\Exception\DomainException;

interface UploadInterface
{
    /**
     * @return string
     * @throws DomainException
     */
    public function getJsFile();

    /**
     * @return string
     * @throws DomainException
     */
    public function getPoFile();

    /**
     * @return boolean
     */
    public function hasJsFile();

    /**
     * @return boolean
     */
    public function hasPoFile();
}
