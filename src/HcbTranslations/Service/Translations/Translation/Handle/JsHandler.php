<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Data\Translations\UploadInterface;
use HcbTranslations\Entity\Translation;
use HcbTranslations\Options\ModuleOptions;
use Zend\Filter\File\Rename;

class JsHandler extends AbstractHandler implements HandlerInterface
{
    /**
     * @var string
     */
    protected $fileName = '';

    /**
     * @param UploadInterface $uploadData
     * @param ModuleOptions $options
     */
    public function __construct(UploadInterface $uploadData, ModuleOptions $options)
    {
        parent::__construct($options);

        $this->fileName = $uploadData->getJsFile();
    }

    /**
     * @param Translation $translationEntity
     * @return bool
     */
    public function handle(Translation $translationEntity)
    {
        $package = $this->getModulePackage($translationEntity->getModule());

        $targetFileName = $package->getJsFilePath($translationEntity->getCode());

        $rename = new Rename(array('target'=> $targetFileName,
                                   'overwrite'=>true));

        $rename->filter($this->fileName);
        $translationEntity->setJsUpdatedTimestamp(new \DateTime());

        return true;
    }
}
