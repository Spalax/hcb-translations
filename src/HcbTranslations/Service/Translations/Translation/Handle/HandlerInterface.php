<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Entity\Translation;

interface HandlerInterface
{
    /**
     * @param Translation $translationEntity
     * @return boolean
     */
    public function handle(Translation $translationEntity);
}
