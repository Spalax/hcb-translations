<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;


use HcbTranslations\Data\Translations\UploadInterface;
use HcbTranslations\Entity\Translation;
use HcbTranslations\Options\ModuleOptions;
use MsgFmt\Generate;
use Zend\Filter\File\Rename;
use Zend\Serializer\Adapter\MsgPack;

class PoHandler extends AbstractHandler implements HandlerInterface
{
    /**
     * @var string
     */
    protected $fileName = '';

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var Generate
     */
    protected $moGenerator;

    /**
     * @param UploadInterface $uploadData
     * @param \HcbTranslations\Options\ModuleOptions $options
     * @param \MsgFmt\Generate $moGenerator
     */
    public function __construct(UploadInterface $uploadData,
                                ModuleOptions $options,
                                Generate $moGenerator)
    {
        parent::__construct($options);
        $this->fileName = $uploadData->getPoFile();
        $this->moGenerator = $moGenerator;
    }

    /**
     * @param Translation $translationEntity
     * @return bool
     */
    public function handle(Translation $translationEntity)
    {
        $modulePackage = $this->getModulePackage($translationEntity->getModule());

        $moFilePath = $modulePackage->getMoFilePath($translationEntity->getCode());
        $poFilePath = $modulePackage->getPoFilePath($translationEntity->getCode());

        $this->moGenerator->convert($this->fileName, $moFilePath);

        $rename = new Rename(array('target'=>$poFilePath,
                                   'overwrite'=>true));

        $rename->filter($this->fileName);

        $translationEntity->setPoUpdatedTimestamp(new \DateTime());
        
        return true;
    }
}
