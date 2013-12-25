<?php
namespace HcbTranslations\Controller\Translations;

use HcBackend\Controller\Collection\AbstractCommonResourceController;
use HcbTranslations\Options\TranslationsOptions;
use HcbTranslations\Service\FetchServiceInterface;
use HcbTranslations\Service\Translations\Translation\CompressionService;
use HcbTranslations\Stdlib\Service\Response\Translations\CompressionResponse;
use Zend\Mvc\MvcEvent;
use Zf2Libs\View\Model\Json\Specific\StatusMessageDataModelFactoryInterface;

class DownloadController extends AbstractCommonResourceController
{
    /**
     * @var StatusMessageDataModelFactoryInterface
     */
    protected $jsonResponseModelFactory;

    /**
     * @var CompressionService
     */
    protected $compressionService;

    /**
     * @var TranslationsOptions
     */
    protected $options;

    /**
     * @param FetchServiceInterface $fetchService
     * @param CompressionService $compressionService
     * @param StatusMessageDataModelFactoryInterface $jsonResponseModelFactory
     * @param TranslationsOptions $options
     */
    public function __construct(FetchServiceInterface $fetchService,
                                CompressionService $compressionService,
                                StatusMessageDataModelFactoryInterface $jsonResponseModelFactory,
                                TranslationsOptions $options)
    {
        parent::__construct($fetchService);

        $this->options = $options;
        $this->compressionService = $compressionService;
        $this->jsonResponseModelFactory = $jsonResponseModelFactory;
    }

    /**
     * @param MvcEvent $e
     * @return mixed|void
     */
    public function onDispatch(MvcEvent $e)
    {
        /* @var $response CompressionResponse */
        $response = $this->compressionService->compress($this->resourceEntity);

        if ($response->isFailed()) {
            return $e->setResult($this->jsonResponseModelFactory->getFailed($response));
        }

        $successResponse = $this->jsonResponseModelFactory->getSuccess();
        $successResponse->setData(array('archive'=>$response->getCompressedFile()));

        return $e->setResult($successResponse);
    }
}
