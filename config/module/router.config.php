<?php
return array(
    'routes' => array(
        'backend' => array(
            'type' => 'literal',
            'priority' =>5000,
            'options' => array(
                'route' => '/superman',
                'defaults' => array(
                    'controller' => 'HcbTranslations\Controller\MainController'
                )
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'main' => array(
                    'type' => 'regex',
                    'priority' => -5,
                    'options' => array(
                        'regex' => '(?<segment>.+)?',
                        'defaults' => array(
                            'controller' => 'HcbTranslations\Controller\MainController'
                        ),
                        'spec'=>''
                    ),
                ),
                'user' => include __DIR__ . '/router/user.config.php',
                'translations' => include __DIR__ . '/router/translations.config.php',
                'clients' => include __DIR__ . '/router/clients.config.php',
                'dashboard' => include __DIR__ . '/router/dashboard.config.php'
            )
        )
    )
);
