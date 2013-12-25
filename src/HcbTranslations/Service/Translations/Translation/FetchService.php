<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcBackend\Service\FetchServiceInterface;
use Doctrine\ORM\EntityManager;

class FetchService implements FetchServiceInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $id
     * @return object
     */
    public function fetch($id)
    {
        return $this->entityManager->find('HcbTranslations\Entity\Translation', $id);
    }
}
