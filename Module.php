<?php
namespace HcbTranslations;

use Zend\Mvc\MvcEvent;

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
        $options = new ModuleOptions(isset($config['zf2fileuploader']) ?
            $config['zf2fileuploader'] :
            array());

        $entityManager = $sm->get('Doctrine\ORM\EntityManager');
        $di->instanceManager()->addSharedInstance($options, 'Zf2FileUploader\Options\ModuleOptions');
        $di->instanceManager()->addSharedInstance($entityManager, 'Doctrine\ORM\EntityManager');

        $di->instanceManager()->setTypePreference('Zf2FileUploader\Entity\ImageInterface',
            array($options->getImageEntityClass()));

        $translator = $options->getTranslator();
        if (!is_null($translator) && class_exists($translator)) {
            $di->instanceManager()->setParameters('Zf2FileUploader\I18n\Translator\Translator',
                array('translator' => $translator));
        }
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
