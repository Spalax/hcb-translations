<?php
namespace HcbTranslations\Stdlib\Service\Response\Translations;

use Zend\I18n\Translator\Translator;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CompressionResponse extends Response
{
    /**
     * @var \Zend\I18n\Translator\Translator
     */
    protected $translator;

    /**
     * @var string
     */
    protected $compressedFile;

    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param string $destinationFolder
     * @return $this
     */
    public function couldNotCopyFilesToCompressionFolder($destinationFolder)
    {
        $this->error($this->translator
                          ->translate('Could not copy files for compression, to the destination folder['.$destinationFolder.']'));
        return $this;
    }

    /**
     * @return $this
     */
    public function couldNotCompressPackage()
    {
        $this->error($this->translator->translate('Could not compress package'));
        return $this;
    }

    /**
     * @param string $filePath
     * @return $this
     */
    public function setCompressedFile($filePath)
    {
        $this->compressedFile = $filePath;
        $this->success();
        return $this;
    }

    /**
     * @return string
     */
    public function getCompressedFile()
    {
        return $this->compressedFile;
    }
}
