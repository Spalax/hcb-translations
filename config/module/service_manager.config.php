<?php
use Zend\ServiceManager\ServiceManager;

return array(
    'factories' => array(
        'HcbTranslations\Options\TranslationsOptions' => function ($sm) {
            $config = $sm->get('Config');

            if (!array_key_exists('translations', $config)) {
                throw new \HcBackend\Options\Exception\DomainException("translations key must be defined in configuration");
            }

           return new \HcbTranslations\Options\TranslationsOptions($config['translations']);
        }
    )
);
