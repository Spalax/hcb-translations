<?php
namespace HcbTranslations\Service\Translations;

use HcBackend\Service\Fetch\Paginator\QueryBuilder\DataServiceInterface;
use HcBackend\Service\Sorting\SortingServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Zend\Stdlib\Parameters;

class FetchQbBuilderService implements DataServiceInterface
{
    /**
     * @var SortingServiceInterface
     */
    protected $sortingService;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager,
                                SortingServiceInterface $sortingService)
    {
        $this->entityManager = $entityManager;
        $this->sortingService = $sortingService;
    }

    /**
     * @param Parameters $params
     * @return QueryBuilder
     */
    public function fetch(Parameters $params = null)
    {
        $qb = $this->entityManager
                   ->getRepository('HcbTranslations\Entity\Translation')
                   ->createQueryBuilder('t');

        if (is_null($params)) return $qb;
        return $this->sortingService->apply($params, $qb, 't');
    }
}
