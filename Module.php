<?php
namespace HcbTranslations;

use Zend\Mvc\MvcEvent;
use HcbTranslations\Options\ModuleOptions;

class Module
{

    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        /* @var $sm \Zend\ServiceManager\ServiceManager */
        $sm = $e->getApplication()->getServiceManager();

        /* @var $di \Zend\Di\Di */
        $di = $sm->get('di');

        $config = $sm->get('config');

        if (!array_key_exists('hcb_translations', $config)) {
            throw new \HcBackend\Options\Exception\DomainException("hcb_translations key must be defined in configuration");
        }

        $options = new ModuleOptions($config['hcb_translations']);
        $di->instanceManager()->addSharedInstance($options, 'HcbTranslations\Options\ModuleOptions');
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                )
            )
        );
    }
}
