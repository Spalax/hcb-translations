<?php
namespace HcbTranslations\Service\Translations\Translation;

use HcBackend\Service\FetchServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class FetchService implements FetchServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
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
