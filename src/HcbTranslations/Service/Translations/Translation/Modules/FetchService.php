<?php
namespace HcbTranslations\Service\Translations\Translation\Modules;

use HcbTranslations\Options\TranslationsOptions;
use HcbTranslations\Service\FetchCollectionServiceInterface;
use HcbTranslations\Service\Filtration\Collection\FiltrationServiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Parameters;

class FetchService implements FetchCollectionServiceInterface
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
     * @var TranslationsOptions
     */
    protected $options;

    /**
     * @param EntityManager $entityManager
     * @param FiltrationServiceInterface $filtrationService
     * @param TranslationsOptions $options
     */
    public function __construct(EntityManager $entityManager,
                                FiltrationServiceInterface $filtrationService,
                                TranslationsOptions $options)
    {
        $this->entityManager = $entityManager;
        $this->filtration = $filtrationService;
        $this->options = $options;
    }

    /**
     * @param Parameters $params
     * @return ArrayCollection
     */
    public function fetch(Parameters $params = null)
    {
        $collection = new ArrayCollection($this->options->getAvailableModules());

        if (is_null($params)) return $collection;
        return $this->filtration->apply($params, $collection);
    }
}
