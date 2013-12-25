<?php
namespace HcbTranslations\Stdlib\Extractor\Translations\Translation\Modules;

use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

class Extractor implements ExtractorInterface
{
    /**
     * @param object $module
     * @return array
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     */
    public function extract($module)
    {
        if (!is_string($module)) {
            throw new InvalidArgumentException("Expected string as translationModule");
        }

        return array('id'=>$module, 'name'=>$module);
    }
}
