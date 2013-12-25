<?php
namespace HcbTranslations\Stdlib\Service\Response\Translations;

use Zend\I18n\Translator\Translator;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UploadResponse extends Response
{
    /**
     * @var \Zend\I18n\Translator\Translator
     */
    protected $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function couldNotProcessFile()
    {
        $this->error($this->translator
                          ->translate('Uploading language file, could not be processed, please try another one, or contact support.'));
    }
}
