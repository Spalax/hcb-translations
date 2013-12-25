<?php
namespace HcbTranslations\Stdlib\Service\Response\Translations;

use Zend\I18n\Translator\Translator;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class SaveResponse extends Response
{
    /**
     * @var \Zend\I18n\Translator\Translator
     */
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function duplicateLanguageCode()
    {
        $this->error($this->translator
                          ->translate('Language code in defined module, already exists, try to use another one. '));
    }
}
