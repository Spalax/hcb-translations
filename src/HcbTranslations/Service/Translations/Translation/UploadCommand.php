<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcbTranslations\Data\Translations\Translation\UploadInterface;
use HcBackend\Entity\EntityInterface;
use HcBackend\Service\ResourceCommandInterface;
use HcbTranslations\Entity\Translation;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UploadCommand implements ResourceCommandInterface
{
    /**
     * @var UploadInterface
     */
    protected $data;

    /**
     * @var UploadService
     */
    protected $service;

    public function __construct(UploadInterface $data,
                                UploadService $service)
    {
        $this->data = $data;
        $this->service = $service;
    }

    /**
     * @param Translation $entity
     * @return Response
     */
    public function execute(EntityInterface $entity)
    {
        return $this->service->upload($entity, $this->data);
    }
}
