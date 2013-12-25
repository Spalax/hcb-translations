<?php
namespace HcbTranslations\Stdlib\Extractor\Translations\Translation;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbTranslations\Entity\Translation as TranslationEntity;

class Extractor implements ExtractorInterface
{
    /**
     * Extract values from an object
     *
     * @param  object $translation
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($translation)
    {
        if (!$translation instanceof TranslationEntity) {
            throw new InvalidArgumentException("Expected HcbTranslations\\Entity\\Translation object, invalid object given");
        }

        $jsUpdatedTimestamp = $translation->getJsUpdatedTimestamp();
        $poUpdatedTimestamp = $translation->getPoUpdatedTimestamp();
        $createdTimestamp = $translation->getCreatedTimestamp();

        if ($jsUpdatedTimestamp) {
            $jsUpdatedTimestamp = $jsUpdatedTimestamp->format('Y-m-d H:i:s');
        }

        if ($poUpdatedTimestamp) {
            $poUpdatedTimestamp = $poUpdatedTimestamp->format('Y-m-d H:i:s');
        }
        if ($createdTimestamp) {
            $createdTimestamp = $createdTimestamp->format('Y-m-d H:i:s');
        }

        return array('id'=>$translation->getId(),
                     'code'=>$translation->getCode(),
                     'module'=>$translation->getModule(),
                     'jsUpdatedTimestamp'=>$jsUpdatedTimestamp,
                     'poUpdatedTimestamp'=>$poUpdatedTimestamp,
                     'createdTimestamp'=>$createdTimestamp);
    }
}
