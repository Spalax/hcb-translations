<?php
namespace HcbTranslations\Service\Translations\Translation\Modules;

use HcBackend\Service\Fetch\Paginator\ArrayCollection\DataServiceInterface;
use HcbTranslations\Options\ModuleOptions;
use HcBackend\Service\Filtration\Collection\FiltrationServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Parameters;

class FetchService implements DataServiceInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var FiltrationServiceInterface
     */
    protected $filtration;

    /**
     * @var ModuleOptions
     */
    protected $options;

    /**
     * @param EntityManager $entityManager
     * @param FiltrationServiceInterface $filtrationService
     * @param ModuleOptions $options
     */
    public function __construct(EntityManager $entityManager,
                                FiltrationServiceInterface $filtrationService,
                                ModuleOptions $options)
    {
        $this->entityManager = $entityManager;
        $this->filtration = $filtrationService;
        $this->options = $options;
    }

    /**
     * @param Parameters $params [OPTIONAL]
     * @return ArrayCollection
     */
    public function fetch(Parameters $params = null)
    {
        $collection = new ArrayCollection($this->options->getAvailableModules());

        if (is_null($params)) return $collection;
        return $this->filtration->apply($params, $collection);
    }
}
