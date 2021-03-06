<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcbTranslations\Data\Translations\Translation\UploadInterface;
use HcbTranslations\Entity\Translation;
use HcbTranslations\Service\Translations\Translation\Handle\HandlerFactory;
use HcbTranslations\Stdlib\Service\Response\Translations\SaveResponse;
use HcbTranslations\Stdlib\Service\Response\Translations\UploadResponse;
use Doctrine\ORM\EntityManagerInterface;

class UploadService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var UploadResponse
     */
    protected $uploadResponse;

    /**
     * @var HandlerFactory
     */
    protected $handlerFactory;

    /**
     * @param EntityManagerInterface $entityManager
     * @param UploadResponse $uploadResponse
     * @param Handle\HandlerFactory $handlerFactory
     */
    public function __construct(EntityManagerInterface $entityManager,
                                UploadResponse $uploadResponse,
                                HandlerFactory $handlerFactory)
    {
        $this->entityManager = $entityManager;
        $this->uploadResponse = $uploadResponse;
        $this->handlerFactory = $handlerFactory;
    }

    /**
     * @param Translation $translationEntity
     * @param \HcbTranslations\Data\Translations\Translation\UploadInterface $uploadData
     * @internal param \HcbTranslations\Data\Translations\Translation\UploadInterface $updateData
     * @return SaveResponse
     */
    public function upload(Translation $translationEntity, UploadInterface $uploadData)
    {
        try {
            $this->entityManager->beginTransaction();

            $handler = $this->handlerFactory->createHandler($uploadData);

            if (!$handler->handle($translationEntity)) {
                $this->entityManager->rollback();
                $this->uploadResponse->couldNotProcessFile();
                return $this->uploadResponse;
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->uploadResponse->error($e->getMessage())->failed();
            return $this->uploadResponse;
        }

        $this->uploadResponse->success();
        return $this->uploadResponse;
    }
}
