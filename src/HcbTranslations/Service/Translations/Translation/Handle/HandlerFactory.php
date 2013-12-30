<?php
namespace HcbTranslations\Service\Translations\Translation\Handle;

use HcbTranslations\Data\Translations\Translation\UploadInterface;
use HcbTranslations\Options\ModuleOptions;
use Zend\Di\Di;
use Zend\ServiceManager\Di\DiServiceFactory;
use Zend\ServiceManager\ServiceManager;

class HandlerFactory
{
    /**
     * @var \Zend\Di\Di
     */
    protected $di;

    /**
     * @var \HcbTranslations\Options\ModuleOptions
     */
    protected $options;

    /**
     * @param \Zend\Di\Di|\Zend\ServiceManager\ServiceManager $di
     * @param \HcbTranslations\Options\ModuleOptions $options
     */
    public function __construct(Di $di, ModuleOptions $options)
    {
        $this->di = $di;
        $this->options = $options;
    }

    /**
     * @param UploadInterface $uploadData
     * @return HandlerAggregator | JsHandler | PoHandler | null
     */
    public function createHandler(UploadInterface $uploadData)
    {
        $params = array('uploadData'=>$uploadData,
                        'options'=>$this->options);

        if ($uploadData->hasJsFile() && $uploadData->hasPoFile()) {
            $aggregator = new HandlerAggregator();
            $aggregator->addHandler($this->di
                                         ->get('HcbTranslations\Service\Translations\Translation\Handle\JsHandler',
                                               $params));

            $aggregator->addHandler($this->di
                                         ->get('HcbTranslations\Service\Translations\Translation\Handle\PoHandler',
                                               $params));

            return $aggregator;
        } else if ($uploadData->hasJsFile()) {
            return $this->di->get('HcbTranslations\Service\Translations\Translation\Handle\JsHandler', $params);
        } else if ($uploadData->hasPoFile()) {
            return $this->di->get('HcbTranslations\Service\Translations\Translation\Handle\PoHandler', $params);
        } else {
            return null;
        }
    }
}
