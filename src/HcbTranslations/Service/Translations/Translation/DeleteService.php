<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcbTranslations\Entity\Translation;
use HcbTranslations\Options\ModuleOptions;
use Doctrine\ORM\EntityManager;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class DeleteService
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
     * @var Response
     */
    protected $response;

    /**
     * @param EntityManager $entityManager
     * @param ModuleOptions $options
     * @param \Zf2Libs\Stdlib\Service\Response\Messages\Response $response
     */
    public function __construct(EntityManager $entityManager,
                                ModuleOptions $options,
                                Response $response)
    {
        $this->entityManager = $entityManager;
        $this->options = $options;
        $this->response = $response;
    }

    /**
     * @param Translation $translationEntity
     * @return mixed
     */
    public function delete(Translation $translationEntity)
    {
        try {
            $this->entityManager->beginTransaction();

            $this->entityManager->remove($translationEntity);

            $package = $this->options
                            ->getPackages()
                            ->getPackage($translationEntity->getModule());

            @unlink($package->getPoFilePath($translationEntity->getCode()));
            @unlink($package->getMoFilePath($translationEntity->getCode()));
            @unlink($package->getJsFilePath($translationEntity->getCode()));

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            return $this->response->error($e->getMessage())->failed();
        }

        return $this->response->success();
    }
}
