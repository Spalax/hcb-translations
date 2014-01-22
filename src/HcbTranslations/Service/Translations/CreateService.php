<?php
namespace HcbTranslations\Service\Translations;

use HcbTranslations\Entity\Translation;
use HcbTranslations\Data\Translations\CreateInterface;
use HcbTranslations\Options\ModuleOptions;
use HcbTranslations\Stdlib\Service\Response\Translations\SaveResponse;
use Doctrine\ORM\EntityManagerInterface;

class CreateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var SaveResponse
     */
    protected $createResponse;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param EntityManagerInterface $entityManager
     * @param \HcbTranslations\Stdlib\Service\Response\Translations\SaveResponse $createResponse
     * @param \HcbTranslations\Options\ModuleOptions $options
     */
    public function __construct(EntityManagerInterface $entityManager,
                                SaveResponse $createResponse,
                                ModuleOptions $options)
    {
        $this->entityManager = $entityManager;
        $this->createResponse = $createResponse;
        $this->options = $options;
    }

    /**
     * @param string $module
     * @param string $langCode
     * @throws Exception\DomainException
     */
    protected function createDefaultTranslationFiles($module, $langCode)
    {
        $packages = $this->options->getPackages();
        $package = $packages->getPackage($module);

        if (!copy($package->getPOTFilePath(), $package->getPoFilePath($langCode))) {
            throw new Exception\DomainException("Could not copy GETTEXT file[".$package->getPOTFilePath()."]
                                                 to the [".$package->getPoFilePath($langCode)."]");
        }

        if (!copy($package->getJsTemplateFilePath(), $package->getJsFilePath($langCode))) {
            throw new Exception\DomainException("Could not copy JS file[".$package->getJsTemplateFilePath()."]
                                                 to the [".$package->getJsFilePath($langCode)."]");
        }
    }

    /**
     * @param CreateInterface $createData
     * @return SaveResponse
     */
    public function create(CreateInterface $createData)
    {
        try {
            $this->entityManager->beginTransaction();

            $translationRepository = $this->entityManager->getRepository('HcbTranslations\Entity\Translation');

            $foundEntity = $translationRepository->findOneBy(array('code'=>$createData->getCode(),
                                                                   'module'=>$createData->getModule()));

            if (!is_null($foundEntity)) {
                $this->createResponse->duplicateLanguageCode();
                return $this->createResponse;
            }

            $this->createDefaultTranslationFiles($createData->getModule(),
                                                 $createData->getCode());

            $newEntity = new Translation();

            $newEntity->setCode($createData->getCode());
            $newEntity->setModule($createData->getModule());

            $this->entityManager->persist($newEntity);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->createResponse->error($e->getMessage())->failed();
            return $this->createResponse;
        }

        $this->createResponse->success();
        return $this->createResponse;
    }
}
