<?php
use Zend\ServiceManager\ServiceManager;

return array(
    'factories' => array(
        'backend-main-menu' => function (ServiceManager $sm) {
            $conf = __DIR__ . '/../../navigation/main_menu.xml';
            $factory = new \Zend\Navigation\Service\ConstructedNavigationFactory($conf);
            return $factory->createService($sm);
        },

        'Zend\Mvc\Router\Http\TreeRouteStack' => function ($sm) {
            return $sm->get('router');
        },

        'HcbTranslations\Options\TranslationsOptions' => function ($sm) {
            $config = $sm->get('Config');

            if (!array_key_exists('translations', $config)) {
                throw new \HcbTranslations\Options\Exception\DomainException("translations key must be defined in configuration");
            }

           return new \HcbTranslations\Options\TranslationsOptions($config['translations']);
        }
    )
);
