<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcBackend\Entity\EntityInterface;
use HcBackend\Service\ResourceCommandInterface;
use HcbTranslations\Entity\Translation;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class DeleteCommand implements ResourceCommandInterface
{
    /**
     * @var DeleteService
     */
    protected $service;

    /**
     * @param DeleteService $service
     */
    public function __construct(DeleteService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Translation $entity
     * @return Response
     */
    public function execute(EntityInterface $entity)
    {
        return $this->service->delete($entity);
    }
}
