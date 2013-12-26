<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcbTranslations\Entity\Translation;
use HcbTranslations\Options\ModuleOptions;
use HcbTranslations\Stdlib\Service\Response\Translations\CompressionResponse;
use Doctrine\ORM\EntityManager;
use Zend\Filter\Compress;

class CompressionService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @var CompressionResponse
     */
    protected $response;

    /**
     * @param EntityManager $entityManager
     * @param \HcbTranslations\Options\ModuleOptions $options
     * @param \HcbTranslations\Stdlib\Service\Response\Translations\CompressionResponse $response
     */
    public function __construct(EntityManager $entityManager,
                                ModuleOptions $options,
                                CompressionResponse $response)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
        $this->response = $response;
    }

    /**
     * @param Translation $translationEntity
     * @return string Compressed content
     * @return CompressionResponse
     */
    public function compress(Translation $translationEntity)
    {
        $packages = $this->options->getPackages();
        $package = $packages->getPackage($translationEntity->getModule());

        $packageDir = $this->options->getLangTemporaryPath();

        $poFilePath = $package->getPoFilePath($translationEntity->getCode());
        $jsFilePath = $package->getJsFilePath($translationEntity->getCode());

        $zipArchiveFile = new \ezcArchiveCharacterFile($packageDir.'/'.uniqid('package').'.zip', true);
        $zipArchive = new \ezcArchiveZip($zipArchiveFile);

        $zipArchive->append($poFilePath, dirname($poFilePath));
        $zipArchive->append($jsFilePath, dirname($jsFilePath));

        $zipArchive->close();

        $this->response
             ->setCompressedFile($this->options->getLangTemporaryHttpPath().'/'.
                                 basename($zipArchiveFile->getFileName()));

        return $this->response;
    }
}
